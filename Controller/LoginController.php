<?php

namespace controller;

session_start();

class LoginController {

  private $loginView;
  private $userStorage;

  public function __construct ($loginView, $userStorage) {
    $this->loginView = $loginView;
    $this->userStorage = $userStorage;
  }
}