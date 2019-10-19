<?php

use controller\LoginController;

require_once('Model/Exceptions.php');
require_once('Model/UserStorage.php');
require_once('Model/MemberCredentials.php');
require_once('Model/SessionHandler.php');

require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');
require_once('View/RegisterView.php');

require_once('Controller/LoginController.php');

class Application
{
  private $loginView;
  private $layoutView;
  private $dateView;
  private $registerView;

  private $loginController;

  private $isLoggedIn;

  public function __construct()
  {
    $this->loginView = new \View\LoginView();
    $this->layoutView = new \View\LayoutView();
    $this->dateView = new \View\DateTimeView();
    $this->registerView = new \View\RegisterView();

    $this->loginController = new \Controller\LoginController($this->loginView);
  }

  public function run()
  {
    $this->isLoggedIn = $this->loginController->setUserLoginState();

    if (!$this->registerView->wantsRegisterPage()) {
      $this->renderLoginPageHTML();
    } else {
      $this->renderRegisterPageHTML();
    }
  }

  private function renderLoginPageHTML()
  {
    $this->layoutView->renderHTML($this->isLoggedIn, $this->loginView, $this->dateView);
  }

  private function renderRegisterPageHTML()
  {
    $this->layoutView->renderHTML($this->isLoggedIn, $this->registerView, $this->dateView);
  }
}
