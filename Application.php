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
    $this->changeState();
    $this->renderHTML();
  }

  private function changeState() {
    if ($this->loginView->wantsToLogin()) {
      try {
        $this->loginController->tryLoginUser();
      } catch (\UsernameMissing $e) {
        $this->loginView->setMessage("Username is missing");
      } catch (\PasswordMissing $e) {
        $this->loginView->setMessage("Password is missing");
      } catch (\WrongCredentials $e) {
        $this->loginView->setMessage("Wrong name or password");
      }
    } else if($this->loginView->wantsToLogout()) {
      $this->loginController->logoutUser();
    }
    $this->isLoggedIn = $this->loginController->isLoggedInBySession();
  }

  private function renderHTML() {
    $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateView);
  }
}
