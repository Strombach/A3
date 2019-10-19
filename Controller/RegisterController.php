<?php

namespace Controller;

class RegisterController
{
  private $view;

  public function __construct(\View\RegisterView $registerView)
  {
    $this->view = $registerView;
  }

  public function registration()
  {
    if ($this->view->wantsToRegister()) {
      try{
        $this->view->getPostUserName();
      } catch (\UsernameToShort $e) {
        $this->view->setMessage("Username has too few characters, at least 3 characters.<br>");
      }
      try{
        $this->view->getPostPassword();
      } catch (\PasswordToShort $e) {
        $this->view->setMessage("Password has too few characters, at least 6 characters.");
      }
    }
  }
}
