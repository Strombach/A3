<?php

// INCLUDE THE FILES NEEDED...
require_once('Model/UserStorage.php');
require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');
require_once('Controller/LoginController.php');


// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView();
$dateView = new DateTimeView();
$layoutView = new LayoutView();

// Create Objects of the userstorage and
// loads all users in the file
$userStorage = new \Model\UserStorage();
$userStorage->loadUsers('users.json');


$layoutView->render(false, $loginView, $dateView);
