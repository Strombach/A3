<?php

use controller\LoginController;

require_once('Model/Exceptions.php');
require_once('Model/UserStorage.php');
require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');
require_once('Controller/LoginController.php');

class Application
{
  private $loginController;
  private $layoutView;
  private $loginView;
  private $dateView;


  public function __construct()
  {
    $this->loginView = new LoginView();
    $this->layoutView = new LayoutView();
    $this->dateView = new DateTimeView();
    $this->loginController = new \Controller\LoginController($this->loginView);
  }

  public function run()
  {
    if (isset($_SESSION["loggedIn"])) {
      $this->layoutView->render(true, $this->loginView, $this->dateView);
    } else {
      $this->renderLoginPage();
    }

    if ($this->loginView->userTriesToLogin()) {
      $this->loginController->doTryLoginUser();
    }
  }

  private function renderLoginPage()
  {
    $this->layoutView->render(false, $this->loginView, $this->dateView);
  }
}
