<?php

namespace controller;

class LoginController
{

  private $view;
  private $userStorage;

  public function __construct($loginView)
  {
    $this->view = $loginView;
    $this->userStorage = new \Model\UserStorage('users.json');
  }

  public function doTryLoginUser()
  {
    try {
      $username = $this->view->getRequestUserName();
      $password = $this->view->getRequestPassword();
      var_dump($username);
      var_dump($password);
      // if ($this->userStorage->authAUser($input)) {
      //   $_SESSION["loggedIn"] = true;
      // } else {
      //   echo "Failed to login";
      // };
    } catch (\Exception $e) {
      var_dump($e);
    }
  }
}
