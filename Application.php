<?php

require_once('Model/Exceptions.php');
require_once('Model/UserStorage.php');
require_once('Model/MemberCredentials.php');
require_once('Model/SessionHandler.php');
require_once('Model/Authenticator.php');
require_once('Model/RegistrationTester.php');

require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');
require_once('View/RegisterView.php');
require_once('View/TodoView.php');


require_once('Controller/LoginController.php');
require_once('Controller/TodoController.php');
require_once('Controller/RegisterController.php');

class Application
{
  private $loginView;
  private $layoutView;
  private $dateView;
  private $registerView;
  private $todoView;

  private $loginController;
  private $registerController;

  private $userStorage;
  private $sessionHandler;

  private $isLoggedIn;

  public function __construct()
  {
    $this->todoView = new \View\TodoView();
    $this->loginView = new \View\LoginView($this->todoView);
    $this->layoutView = new \View\LayoutView();
    $this->dateView = new \View\DateTimeView();
    $this->registerView = new \View\RegisterView();

    $this->userStorage = new \Model\UserStorage();
    $this->userStorage->loadUsersFrom('users.json');
    $this->sessionHandler = new \Model\SessionHandler();

    $this->loginController = new \Controller\LoginController($this->loginView, $this->sessionHandler, $this->userStorage);
    $this->registerController = new \Controller\RegisterController($this->registerView, $this->userStorage);
    $this->todoController = new \Controller\TodoController($this->todoView, $this->sessionHandler, $this->userStorage);
  }

  public function run(): void
  {
    $this->isLoggedIn = $this->loginController->setUserLoginState();

    if (!$this->registerView->wantsRegisterPage() && !$this->isLoggedIn) {
      $this->renderPageHTML($this->loginView);
    } else if ($this->registerView->wantsRegisterPage()) {
      $this->registerController->registration();
      $this->renderPageHTML($this->registerView);
    } else if ($this->isLoggedIn) {
      $this->renderPageHTML($this->loginView);
    }
  }

  private function renderPageHTML($pageToRender): void
  {
    $this->layoutView->renderHTML($this->isLoggedIn, $pageToRender, $this->dateView);
  }
}
