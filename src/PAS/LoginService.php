<?php
declare(strict_types=1);
namespace PAS;

class LoginService
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function setUser(int $userID, string $username, string $returnToUrl): void {
        Utilities::setSessionValue(PageConstants::SESSION_USER_ID_KEY, $userID);
        Utilities::setSessionValue(PageConstants::SESSION_USERNAME_KEY, $username);
        header('Location: ' . $returnToUrl);
    }

    public function login(string $username, string $password, string $returnToUrl): \stdClass|string {
        $errorStatus = new \stdClass();

        $user = $this->db->lookupUser($username);

        if (empty($username)) {
            $errorStatus->usernameError = LoginConstants::E_NO_USERNAME;
        } elseif (!$user) {
            $errorStatus->usernameError = LoginConstants::E_USERNAME_NOT_FOUND;
        } elseif (!password_verify($password, $user[DbConstants::USERS_HASH_FIELD])) {
            $errorStatus->passwordError = LoginConstants::E_PASSWORD_INCORRECT;
        }

        if (empty($password)) {
            $errorStatus->passwordError = LoginConstants::E_NO_PASSWORD;
        }

        // if there are any errors, return without loggin in
        if (!empty((array)$errorStatus)) {
            return $errorStatus;
        }

        $this->setUser($user[DbConstants::USER_ID_FIELD], $username, $returnToUrl);
        Utilities::restoreSession();
        return '';
    }

    public function register(string $username, string $password, string $confirm, string $returnToUrl): ?\stdClass {
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

        $user = $this->db->lookupUser($username);

        if (!empty($user)) {
            $errorStatus->usernameError = LoginConstants::E_ACCOUNT_EXISTS;
        }

        // if there are any errors, return without loggin in
        if (!empty((array)$errorStatus)) {
            return $errorStatus;
        }

        
        $this->db->addUser($username, password_hash($password, PASSWORD_DEFAULT));
        $user = $this->db->lookupUser($username);
        $this->setUser($user[DbConstants::USER_ID_FIELD], $username, $returnToUrl);
        return null;
    }

    public function showErrorSymbol(): string {
        return "⚠ ";
    }
}