<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Repositories\UserRepository;
use PAS\Config\LoginConstants;

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
        private SessionManager $sessionService,
        private CartService $cartService
    ) {
    }

    /**
     * Sets an error message if the username is missing.
     *
     * @param string|null $username
     * @param \stdClass   $errors
     */
    private function validateUsername(?string $username, \stdClass $errors): void
    {
        if ($username === null || $username === '') {
            $errors->usernameError = LoginConstants::E_NO_USERNAME;
        }
    }

    /**
     * Sets an error message if the password is missing.
     *
     * @param string|null $password
     * @param \stdClass   $errors
     */
    private function validatePassword(?string $password, \stdClass $errors): void
    {
        if ($password === null || $password === '') {
            $errors->passwordError = LoginConstants::E_NO_PASSWORD;
        }
    }

    /**
     * Sets an error message if the confirmation password is missing.
     *
     * @param string|null $confirmPassword
     * @param \stdClass   $errors
     */
    private function validateConfirmPassword(?string $confirmPassword, \stdClass $errors): void
    {
        if ($confirmPassword === null || $confirmPassword === '') {
            $errors->confirmPassError = LoginConstants::E_NO_CONFIRM;
        }
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

        $this->validateUsername($username, $errors);
        $this->validatePassword($password, $errors);

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

        $returnToUrl = $this->sessionService->resolveReturnToUrl();
        $this->sessionService->regenerate();
        $this->sessionService->setUser($user->id, $username);
        $this->sessionService->restore($this->cartService);
        $this->sessionService->redirect($returnToUrl);
        // Required fallback return to satisfy static analysis tools.
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
     * @param ?string $confirmPassword  Raw confirmation input from POST.
     * @return ?\stdClass Error object on failure, null on success.
     */
    public function register(?string $username, ?string $password, ?string $confirmPassword): ?\stdClass
    {
        $errors = new \stdClass();

        $this->validateUsername($username, $errors);
        $this->validatePassword($password, $errors);
        $this->validateConfirmPassword($confirmPassword, $errors);

        if (!empty((array)$errors)) {
            return $errors;
        }

        if ($password !== $confirmPassword) {
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
        $returnToUrl = $this->sessionService->resolveReturnToUrl();
        $this->sessionService->setUser($user->id, $username);
        $this->sessionService->save([
            'cart' => $this->cartService->getCartAsArray(),
        ]);
        $this->sessionService->redirect($returnToUrl);
        // Required fallback return to satisfy static analysis tools.
        return null;
    }

    /**
     * Returns the UI error symbol used in form validation messages.
     *
     * @return string The warning symbol followed by a space for visual separation from the message text.
     */
    public function getErrorSymbol(): string
    {
        return "⚠ ";
    }
}
