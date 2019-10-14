<?php

require_once('Model/UserStorage.php');
require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');
require_once('Controller/LoginController.php');

class Application
{
  private $storage;
  private $members;
  private $loginController;
  private $layoutView;
  private $loginView;
  private $dateView;


  public function __construct()
  {
    $this->storage = new \Model\UserStorage();
    $this->members = $this->storage->loadUsers('users.json');
    $this->loginView = new LoginView();
    $this->layoutView = new LayoutView();
    $this->dateView = new DateTimeView();
    $this->loginController = new \Controller\LoginController($this->loginView, $this->storage);
  }

  public function run()
  {
    if (isset($_SESSION["loggedIn"])) {
      echo "Logged In";
    } else {
      $this->generateLoginPage();
    }
  }

  private function generateLoginPage()
  {
    $this->layoutView->render(false, $this->loginView, $this->dateView);

    if ($this->loginView->userTriesToLogin()) {
      var_dump($this->loginView->getRequestInput());
    }
  }
}
