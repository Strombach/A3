<?php

namespace Model;

class RegistrationTester
{
  public function areUsernameLegalLength(string $username, $minLength)
  {
    if (!(strlen($username) >= $minLength)) {
      throw new \UsernameTooShort;
    }
  }

  public function areUsernameOccupied(string $username, \Model\UserStorage $userStorage)
  {
    try {
      $foundUser = $userStorage->findUserByUsername($username);
      if ($username === $foundUser->username) {
        throw new \UsernameOccupied;
      }
    } catch (\WrongCredentials $e) { }
  }

  public function arePasswordLegalLength($password, $minLength)
  {
    if (!(strlen($password) >= $minLength)) {
      throw new \PasswordTooShort;
    }
  }

  public function arePasswordsMatching(string $firstPassword, string $secondPassword)
  {
    if ($firstPassword != $secondPassword) {
      throw new \PasswordsNotMatching;
    }
  }
}
