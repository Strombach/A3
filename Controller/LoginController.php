<?php

namespace controller;

use Exception;

class LoginController
{

  private $view;
  private $userStorage;

  public function __construct($loginView, $userStorage)
  {
    $this->view = $loginView;
    $this->userStorage = $userStorage;
  }

  public function doTryLoginUser()
  {
    try {
      $input = $this->view->getRequestInput();
      if ($this->userStorage->authAUser($input)) {
        $_SESSION["loggedIn"] = true;
      } else {
        echo "Failed to login";
      };
    } catch (Exception $e) {
      var_dump($e);
    }
  }
}
