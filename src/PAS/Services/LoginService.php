<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Repositories\UserRepository;
use PAS\Services\SessionService;
use PAS\Config\LoginConstants;
use PAS\Config\PageConstants;
use PAS\Services\CartService;

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
     * @param ?string $username Raw username input from POST.
     * @param ?string $password Raw password input from POST.
     * @return \stdClass|string Error object on failure, empty string on success.
     */
    public function login(?string $username, ?string $password): \stdClass|string
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

        if ($returnToUrl === PageConstants::DOMAIN_NAME . PageConstants::CREATE_ACCOUNT_PAGE) {
            $returnToUrl = PageConstants::HOME_PAGE;
        }

        $this->sessionService->regenerate();
        $this->sessionService->setUser($user->id, $username);
        $this->sessionService->restore($this->cartService);
        $this->sessionService->redirect($returnToUrl);
        return '';
    }

    public function register(?string $username, ?string $password, ?string $confirm): ?\stdClass
    {
        $errors = new \stdClass();

        if (empty($username)) {
            $errors->usernameError = LoginConstants::E_NO_USERNAME;
        }

        if (empty($password)) {
            $errors->passwordError = LoginConstants::E_NO_PASSWORD;
        }

        if (empty($confirm)) {
            $errors->confirmPassError = LoginConstants::E_NO_CONFIRM;
        }

        if ((!empty($confirm)) && ($password != $confirm)) {
            $errors->confirmPassError = LoginConstants::E_CONFIRM_MISMATCH;
        }

        if ($username === null || $password === null || $confirm === null) {
            return $errors;
        }

        $user = $this->userRepository->findByUsername($username);

        if ($user !== null) {
            $errors->usernameError = LoginConstants::E_ACCOUNT_EXISTS;
        }

        // if there are any errors, return without logging in
        if (!empty((array)$errors)) {
            return $errors;
        }

        $user = $this->userRepository->createUser($username, password_hash($password, PASSWORD_DEFAULT));

        $returnToUrl = $this->sessionService->getReturnToUrl();

        if ($returnToUrl === PageConstants::DOMAIN_NAME . PageConstants::CREATE_ACCOUNT_PAGE) {
            $returnToUrl = PageConstants::HOME_PAGE;
        }

        $this->sessionService->setUser($user->id, $username);
        $this->sessionService->save([
            'cart' => $this->cartService->getCartAsArray(),
        ]);
        $this->sessionService->redirect($returnToUrl);
        return null;
    }

    public function showErrorSymbol(): string
    {
        return "⚠ ";
    }
}
