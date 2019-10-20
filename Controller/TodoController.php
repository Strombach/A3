<?php

namespace Controller;

class TodoController
{
  private $view;
  private $sessionHandler;
  private $userStorage;

  private $todoSorter;

  private $loggedInMember;

  public function __construct(\View\TodoView $view, \Model\SessionHandler $session, \Model\UserStorage $storage)
  {
    $this->view = $view;
    $this->sessionHandler = $session;
    $this->userStorage = $storage;

    $this->loadMemberData();

    $this->todoSorter = new \Model\TodoSorter($this->loggedInMember);

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
    $this->presentNonCompleteTasks();
  }

  private function presentCompleteTasks()
  {
    $this->view->setCompleteTodos($this->todoSorter->getCompleted());
  }

  private function presentNonCompleteTasks()
  {
    $this->view->setNonCompleteTodos($this->todoSorter->getNonCompleted());
  }
}
