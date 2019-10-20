<?php

namespace Controller;

class TodoController
{
  private $view;
  private $sessionHandler;
  private $userStorage;

  private $loggedInMember;

  public function __construct(\View\TodoView $view, \Model\SessionHandler $session, \Model\UserStorage $storage)
  {
    $this->view = $view;
    $this->sessionHandler = $session;
    $this->userStorage = $storage;

    $this->loadMemberData();
    $this->presentLoggedInUser();
  }

  private function loadMemberData()
  {
    $loggedInUsername = $this->sessionHandler->getSessionValue(LoginController::$loginSession);
    $this->loggedInMember = $this->userStorage->findUserByUsername($loggedInUsername);
  }

  private function presentLoggedInUser()
  {
    $this->view->setName($this->loggedInMember->username);
    $this->presentCompleteTasks();
  }

  private function presentCompleteTasks()
  {
    $this->view->setCompleteTodos($this->loggedInMember->todos);
  }
}
