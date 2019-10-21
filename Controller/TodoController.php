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

    $this->updateView();
  }

  public function updateTodos()
  {
    if ($this->view->wantsToAddTodo()) {
      $this->addTodo();
    } else if ($this->view->wantsToDeleteTodo()) {
      $this->deleteTodo();
    } else if ($this->view->wantsToCompleteTodo()) {
      $this->completeTodo();
    }
    $this->updateView();
  }

  public function updateView()
  {
    $this->loadMemberData();

    $this->todoSorter = new \Model\TodoSorter($this->loggedInMember);

    $this->presentLoggedInUser();
  }

  private function addTodo()
  {
    $this->userStorage->addTodoToUser($this->loggedInMember, $this->view->getAddedTodo());
  }

  private function completeTodo()
  {
    $this->userStorage->completeTodoForUser($this->loggedInMember, $this->view->getCompletedTodo());
  }

  private function deleteTodo()
  {
    $this->userStorage->deleteTodoFromUser($this->loggedInMember, $this->view->getDeletedTodo());
  }

  private function loadMemberData()
  {
    $loggedInUsername = $this->sessionHandler->getSessionValue(LoginController::$loginSession);
    $this->loggedInMember = $this->userStorage->findUserByUsername($loggedInUsername);
  }

  private function presentLoggedInUser()
  {
    $this->view->setName($this->loggedInMember->username);
    $this->presentNonCompleteTasks();
    $this->presentCompleteTasks();
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
