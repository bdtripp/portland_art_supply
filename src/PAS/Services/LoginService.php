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

    public function setUser(int $userId, string $username): void
    {
        $this->sessionService->setUser($userId, $username);
    }

    public function login(?string $username, ?string $password): \stdClass|string
    {
        $errorStatus = new \stdClass();

        if ($username === '') {
            $errorStatus->usernameError = LoginConstants::E_NO_USERNAME;
        }

        if ($password === '') {
            $errorStatus->passwordError = LoginConstants::E_NO_PASSWORD;
        }

        if (!empty((array)$errorStatus)) {
            return $errorStatus;
        }

        if ($username === null || $password === null) {
            return $errorStatus;
        }

        $user = $this->userRepository->findByUsername($username);

        if ($user === null) {
            $errorStatus->usernameError = LoginConstants::E_USERNAME_NOT_FOUND;
            return $errorStatus;
        }

        if (!password_verify($password, $user->passwordHash)) {
            $errorStatus->passwordError = LoginConstants::E_PASSWORD_INCORRECT;
            return $errorStatus;
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
        $errorStatus = new \stdClass();

        if (empty($username)) {
            $errorStatus->usernameError = LoginConstants::E_NO_USERNAME;
        }

        if (empty($password)) {
            $errorStatus->passwordError = LoginConstants::E_NO_PASSWORD;
        }

        if (empty($confirm)) {
            $errorStatus->confirmPassError = LoginConstants::E_NO_CONFIRM;
        }

        if ((!empty($confirm)) && ($password != $confirm)) {
            $errorStatus->confirmPassError = LoginConstants::E_CONFIRM_MISMATCH;
        }

        if ($username === null || $password === null || $confirm === null) {
            return $errorStatus;
        }

        $user = $this->userRepository->findByUsername($username);

        if ($user !== null) {
            $errorStatus->usernameError = LoginConstants::E_ACCOUNT_EXISTS;
        }

        // if there are any errors, return without logging in
        if (!empty((array)$errorStatus)) {
            return $errorStatus;
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
