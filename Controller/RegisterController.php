<?php

namespace Controller;

class RegisterController
{

  public static $minNameLength = 3;
  public static $minPasswordLength = 6;

  private $view;

  public function __construct(\View\RegisterView $registerView)
  {
    $this->view = $registerView;
  }

  public function registration()
  {
    $password = '';
    if ($this->view->wantsToRegister()) {
      try{
        $this->view->getPostUserName();
      } catch (\UsernameToShort $e) {
        $this->view->setMessage('Username has too few characters, at least ' . self::$minNameLength . ' characters.<br>');
      }
      try{
        $password = $this->view->getPostPassword();
      } catch (\PasswordToShort $e) {
        $this->view->setMessage('Password has too few characters, at least ' . self::$minPasswordLength . ' characters.<br>');
      }
      try {
        $this->isPasswordsMatching($password, $this->view->getPostPasswordRepeat());
      } catch (\PasswordsNotMatching $e) {
        $this->view->setMessage("Passwords do not match.");
      }
    }
  }

  private function isPasswordsMatching(string $firstPassword, string $secondPassword){
    if ($firstPassword !== $secondPassword) {
      throw new \PasswordsNotMatching;
    }
  }
}
