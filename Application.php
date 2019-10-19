<?php

use controller\LoginController;

require_once('Model/Exceptions.php');
require_once('Model/UserStorage.php');
require_once('Model/MemberCredentials.php');
require_once('Model/SessionHandler.php');

require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');

require_once('Controller/LoginController.php');

class Application
{
  private $loginView;
  private $layoutView;
  private $dateView;

  private $loginController;

  private $isLoggedIn;

  public function __construct()
  {
    $this->loginView = new \View\LoginView();
    $this->layoutView = new \View\LayoutView();
    $this->dateView = new \View\DateTimeView();

    $this->loginController = new \Controller\LoginController($this->loginView);
  }

  public function run()
  {
    $this->isLoggedIn = $this->loginController->setUserLoginState();
    $this->renderLoginPageHTML();
  }

  private function renderLoginPageHTML()
  {
    $this->layoutView->renderHTML($this->isLoggedIn, $this->loginView, $this->dateView);
  }
}
