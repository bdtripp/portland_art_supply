<?php

declare(strict_types=1);

namespace PAS;

use PAS\Repositories\UserRepository;

class LoginService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function setUser(int $userID, string $username, string $returnToUrl): void
    {
        Utilities::setSessionValue(PageConstants::SESSION_USER_ID_KEY, $userID);
        Utilities::setSessionValue(PageConstants::SESSION_USERNAME_KEY, $username);
        header('Location: ' . $returnToUrl);
    }

    public function login(string $username, string $password, string $returnToUrl): \stdClass|string
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

        $user = $this->userRepository->findByUsername($username);

        if ($user === null) {
            $errorStatus->usernameError = LoginConstants::E_USERNAME_NOT_FOUND;
            return $errorStatus;
        }

        if (!password_verify($password, $user->passwordHash)) {
            $errorStatus->passwordError = LoginConstants::E_PASSWORD_INCORRECT;
            return $errorStatus;
        }

        $this->setUser($user->id, $username, $returnToUrl);
        Utilities::restoreSession();
        return '';
    }

    public function register(string $username, string $password, string $confirm, string $returnToUrl): ?\stdClass
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

        $user = $this->userRepository->findByUsername($username);

        if ($user !== null) {
            $errorStatus->usernameError = LoginConstants::E_ACCOUNT_EXISTS;
        }

        // if there are any errors, return without logging in
        if (!empty((array)$errorStatus)) {
            return $errorStatus;
        }

        $user = $this->userRepository->createUser($username, password_hash($password, PASSWORD_DEFAULT));

        $this->setUser($user->id, $username, $returnToUrl);
        Utilities::saveSession();
        return null;
    }

    public function showErrorSymbol(): string
    {
        return "⚠ ";
    }
}
