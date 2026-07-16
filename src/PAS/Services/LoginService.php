<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Repositories\UserRepository;
use PAS\Services\SessionService;
use PAS\Config\LoginConstants;
use PAS\Config\PageConstants;
use PAS\Services\CartService;

/**
 * Handles user authentication and registration workflows.
 *
 * Coordinates credential validation, session lifecycle management,
 * cart restoration, and redirect behavior for both login and account
 * creation flows.
 *
 * This service acts as the central point for all login-related
 * operations within PAS, delegating persistence to UserRepository
 * and session handling to SessionService.
 */
class LoginService
{
    public function __construct(
        private UserRepository $userRepository,
        private SessionService $sessionService,
        private CartService $cartService
    ) {
    }

    /**
     * Authenticates a user's credentials and initializes their active session.
     *
     * Performs a redirect on successful authentication.
     *
     * @param ?string $username Raw username input from POST.
     * @param ?string $password Raw password input from POST.
     * @return ?\stdClass Error object on failure, null on success.
     */
    public function login(?string $username, ?string $password): ?\stdClass
    {
        $errors = new \stdClass();

        if ($username === null || $username === '') {
            $errors->usernameError = LoginConstants::E_NO_USERNAME;
        }

        if ($password === null || $password === '') {
            $errors->passwordError = LoginConstants::E_NO_PASSWORD;
        }

        if (!empty((array)$errors)) {
            return $errors;
        }

        assert(is_string($username));
        assert(is_string($password));

        $user = $this->userRepository->findByUsername($username);

        if ($user === null) {
            $errors->usernameError = LoginConstants::E_USERNAME_NOT_FOUND;
            return $errors;
        }

        if (!password_verify($password, $user->passwordHash)) {
            $errors->passwordError = LoginConstants::E_PASSWORD_INCORRECT;
            return $errors;
        }

        $returnToUrl = $this->sessionService->getReturnToUrl();
        $returnToPath = parse_url((string) $returnToUrl, PHP_URL_PATH) ?? '';

        if ($returnToPath === PageConstants::CREATE_ACCOUNT_PAGE) {
            $returnToUrl = PageConstants::HOME_PAGE;
        }

        $this->sessionService->regenerate();
        $this->sessionService->setUser($user->id, $username);
        $this->sessionService->restore($this->cartService);
        $this->sessionService->redirect($returnToUrl);
        // This is dead code but is included so Intelephense does not complain that "Not all paths return a value."
        return null;
    }

    /**
     * Handles new account creation, including input validation, user persistence,
     * session updates, and redirect behavior.
     *
     * On successful registration, updates the user's session and performs a
     * redirect to the previous web page. Execution does not
     * continue after the redirect.
     *
     * @param ?string $username Raw username input from POST.
     * @param ?string $password Raw password input from POST.
     * @param ?string $confirm  Raw confirmation input from POST.
     * @return ?\stdClass Error object on failure, null on success.
     */
    public function register(?string $username, ?string $password, ?string $confirm): ?\stdClass
    {
        $errors = new \stdClass();

        if ($username === null || $username === '') {
            $errors->usernameError = LoginConstants::E_NO_USERNAME;
        }

        if ($password === null || $password === '') {
            $errors->passwordError = LoginConstants::E_NO_PASSWORD;
        }

        if ($confirm === null || $confirm === '') {
            $errors->confirmPassError = LoginConstants::E_NO_CONFIRM;
        }

        if (!empty((array)$errors)) {
            return $errors;
        }

        if ($password !== $confirm) {
            $errors->confirmPassError = LoginConstants::E_CONFIRM_MISMATCH;
            return $errors;
        }

        assert(is_string($username));
        assert(is_string($password));

        $user = $this->userRepository->findByUsername($username);

        // Check if account already exists
        if ($user !== null) {
            $errors->usernameError = LoginConstants::E_ACCOUNT_EXISTS;
            return $errors;
        }

        $user = $this->userRepository->createUser($username, password_hash($password, PASSWORD_DEFAULT));
        $returnToUrl = $this->sessionService->getReturnToUrl();
        $returnToPath = parse_url((string) $returnToUrl, PHP_URL_PATH) ?? '';

        if ($returnToPath === PageConstants::CREATE_ACCOUNT_PAGE) {
            $returnToUrl = PageConstants::HOME_PAGE;
        }

        $this->sessionService->setUser($user->id, $username);
        $this->sessionService->save([
            'cart' => $this->cartService->getCartAsArray(),
        ]);
        $this->sessionService->redirect($returnToUrl);
        // This is dead code but is included so Intelephense does not complain that "Not all paths return a value."
        return null;
    }

    public function showErrorSymbol(): string
    {
        return "⚠ ";
    }
}
