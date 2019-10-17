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
  private $loginView;
  private $layoutView;
  private $dateView;

  private $loginController;

  public function __construct()
  {
    $this->loginView = new \View\LoginView();
    $this->layoutView = new \View\LayoutView();
    $this->dateView = new \View\DateTimeView();

    $this->loginController = new \Controller\LoginController($this->loginView);
  }

  public function run()
  {
    $isLoggedIn = $this->loginController->isLoggedInBySession();

    if ($this->loginView->userTriesToLogin()) {
      try {
        $this->loginController->doTryLoginUser();
      } catch(\UsernameMissing $e) {
        $this->loginView->setMessage("Username is missing");
      } catch(\PasswordMissing $e) {
        $this->loginView->setMessage("Password is missing");
      }
    }

    $this->layoutView->render($isLoggedIn, $this->loginView, $this->dateView);

  }
}
