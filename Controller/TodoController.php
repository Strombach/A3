<?php

namespace Controller;

class TodoController
{
  private $view;
  private $sessionHandler;
  private $userStorage;

  public function __construct(\View\TodoView $view, \Model\SessionHandler $session, \Model\UserStorage $storage)
  {
    $this->view = $view;
    $this->sessionHandler = $session;
    $this->userStorage = $storage;

    $this->presentLoggedInUser();
  }

  private function presentLoggedInUser()
  {
    $loggedInUser = $this->sessionHandler->getSessionValue('LoginController::isLoggedIn');
    $this->view->setName($loggedInUser);
  }
}
