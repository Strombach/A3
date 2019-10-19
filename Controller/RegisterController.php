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
      echo $this->view->getPostUserName();
    }
  }
}
