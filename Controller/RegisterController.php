<?php

namespace Controller;

class RegisterController
{

  private static $minNameLength = 3;
  private static $minPasswordLength = 6;

  private $view;

  public function __construct(\View\RegisterView $registerView)
  {
    $this->view = $registerView;
  }

  public function registration()
  {
    if ($this->view->wantsToRegister()) {
      $this->testUsernameInput();
      $this->testPasswordInput();
    }
  }

  private function testUsernameInput ()
  {
    try{
      $username = $this->view->applyTagFilter($this->view->getPostUserName());
      $this->areUsernameLegalLength($username);
    } catch (\InvalidCharacters $e) {
      $this->view->setMessage('Username contains invalid characters.<br>');
    } catch (\UsernameTooShort $e) {
      $this->view->setMessage('Username has too few characters, at least ' . self::$minNameLength . ' characters.<br>');
    }
  }

  private function testPasswordInput()
  {
    try{
      $password = $this->view->getPostPassword();
      $this->arePasswordLegalLength($password);
    } catch (\PasswordTooShort $e) {
      $this->view->setMessage('Password has too few characters, at least ' . self::$minPasswordLength . ' characters.<br>');
    }
    try {
         $this->arePasswordsMatching($password, $this->view->getPostPasswordRepeat());
    } catch (\PasswordsNotMatching $e) {
      $this->view->setMessage("Passwords do not match.");
    }
  }

  private function areUsernameLegalLength (string $username)
  {
    if(!(strlen($username) >= self::$minNameLength)) {
      throw new \UsernameTooShort;
    }
  }

  private function arePasswordLegalLength ($password): bool
  {
    if(!($password >= self::$minPasswordLength)) {
      throw new \PasswordTooShort;
    }
  }

  private function arePasswordsMatching(string $firstPassword, string $secondPassword)
  {
    if ($firstPassword !== $secondPassword) {
      throw new \PasswordsNotMatching;
    }
  }
}
