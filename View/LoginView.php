<?php

namespace View;

class LoginView
{
  private static $login = 'LoginView::Login';
  private static $logout = 'LoginView::Logout';
  private static $name = 'LoginView::UserName';
  private static $password = 'LoginView::Password';
  private static $keep = 'LoginView::KeepMeLoggedIn';
  private static $messageId = 'LoginView::Message';

  private $message = '';

  public function wantsToLogin()
  {
    return isset($_POST[self::$login]);
  }

  public function wantsToLogout()
  {
    return isset($_POST[self::$logout]);
  }

  public function getPostUserName()
  {
    if (!empty($_POST[self::$name])) {
      return $_POST[self::$name];
    } else {
      throw new \UserNameMissing();
    }
  }

  public function getPostPassword()
  {
    if (!empty($_POST[self::$password])) {
      return $_POST[self::$password];
    } else {
      throw new \PasswordMissing();
    }
  }

  public function setMessage(string $newMessage)
  {
    $this->message = $newMessage;
  }

  public function generateBodyHTML($isLoggedIn): string
  {
    if (!$isLoggedIn) {
      $generateBodyHTML = $this->generateLoginFormHTML($this->message);
    } else {
      $generateBodyHTML = $this->generateLogoutButtonHTML($this->message);
    }
    return $generateBodyHTML;
  }


  private function getPreviousEnteredUsername()
  {
    if (!empty($_POST[self::$name])) {
      return $_POST[self::$name];
    }
  }

  private function generateLogoutButtonHTML($message)
  {
    return '
		<form  method="post" >
			<p id="' . self::$messageId . '">' . $message . '</p>
			<input type="submit" name="' . self::$logout . '" value="logout"/>
		</form>
		';
  }

  private function generateLoginFormHTML($message)
  {
    $username = $this->getPreviousEnteredUsername();

    return '
    <form method="post" > 
      <fieldset>
      <legend>Login - enter Username and password</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
				
				<label for="' . self::$name . '">Username :</label>
				<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $username . '" />
				<label for="' . self::$password . '">Password :</label>
				<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
				<label for="' . self::$keep . '">Keep me logged in  :</label>
				<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
				
        <input type="submit" name="' . self::$login . '" value="login" />
      </fieldset>
    </form>
		';
  }
}
