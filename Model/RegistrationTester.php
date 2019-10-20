<?php

namespace Model;

class RegistrationTester
{
  public function areUsernameLegalLength(string $username, int $minLength): void
  {
    if (!(strlen($username) >= $minLength)) {
      throw new \UsernameTooShort;
    }
  }

  public function areUsernameOccupied(string $username, \Model\UserStorage $userStorage): void
  {
    try {
      $foundUser = $userStorage->findUserByUsername($username);
      if ($username === $foundUser->username) {
        throw new \UsernameOccupied;
      }
    } catch (\WrongCredentials $e) { }
  }

  public function arePasswordLegalLength(string $password, int $minLength): void
  {
    if (!(strlen($password) >= $minLength)) {
      throw new \PasswordTooShort;
    }
  }

  public function arePasswordsMatching(string $firstPassword, string $secondPassword): void
  {
    if ($firstPassword != $secondPassword) {
      throw new \PasswordsNotMatching;
    }
  }
}
