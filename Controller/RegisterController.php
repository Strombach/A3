<?php

namespace Controller;

class RegisterController
{

  private static $minNameLength = 3;
  private static $minPasswordLength = 6;

  private $view;

  private $registrationTester;

  public function __construct(\View\RegisterView $registerView, \Model\UserStorage $userStorage)
  {
    $this->view = $registerView;

    $this->userStorage = $userStorage;

    $this->registrationTester = new \Model\RegistrationTester();
  }

  public function tryRegistration(): void
  {
    if ($this->view->wantsToRegister()) {
      $this->testUsernameInput();
      $this->testPasswordInput();
    }
  }

  private function testUsernameInput()
  {
    try {
      $username = $this->view->applyTagFilter($this->view->getPostUserName());
      $this->registrationTester->areUsernameLegalLength($username, self::$minNameLength);
      $this->registrationTester->areUsernameOccupied($username, $this->userStorage);
    } catch (\InvalidCharacters $e) {
      $this->view->setMessage('Username contains invalid characters.<br>');
    } catch (\UsernameTooShort $e) {
      $this->view->setMessage('Username has too few characters, at least ' . self::$minNameLength . ' characters.<br>');
    } catch (\UsernameOccupied $e) {
      $this->view->setMessage('User exists, pick another username.<br>');
    }
  }

  private function testPasswordInput()
  {
    try {
      $password = $this->view->getPostPassword();
      $this->registrationTester->arePasswordLegalLength($password, self::$minPasswordLength);
      $this->registrationTester->arePasswordsMatching($password, $this->view->getPostPasswordRepeat());
    } catch (\PasswordTooShort $e) {
      $this->view->setMessage('Password has too few characters, at least ' . self::$minPasswordLength . ' characters.<br>');
    } catch (\PasswordsNotMatching $e) {
      $this->view->setMessage("Passwords do not match.");
    }
  }
}
