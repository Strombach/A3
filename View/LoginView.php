<?php

namespace View;

class LoginView
{
  private static $login = 'LoginView::Login';
  private static $logout = 'LoginView::Logout';
  private static $name = 'LoginView::UserName';
  private static $password = 'LoginView::Password';
  private static $cookieName = 'LoginView::CookieName';
  private static $cookiePassword = 'LoginView::CookiePassword';
  private static $keep = 'LoginView::KeepMeLoggedIn';
  private static $messageId = 'LoginView::Message';

  private $message = '';


  /**
   * Create HTTP response
   *
   * Should be called after a login attempt has been determined
   *
   * @return  string The HTML string that's pu in the body.
   */
  public function response($isLoggedIn): string
  {
    if (!$isLoggedIn) {
      $response = $this->generateLoginFormHTML($this->message);
    } else {
      $response = $this->generateLogoutButtonHTML($this->message);
    }
    return $response;
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
    $username = '';
    if (!empty($_POST[self::$name])) {
      $username = $_POST[self::$name];
    }
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

  public function wantsToLogin()
  {
    return isset($_POST[self::$login]);
  }

  public function wantsToLogout () {
    return isset($_POST[self::$logout]);
  }

  public function getRequestUserName()
  {
    if (!empty($_POST[self::$name])) {
      return $_POST[self::$name];
    } else {
      throw new \UserNameMissing();
    }
  }

  public function getRequestPassword()
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
}
