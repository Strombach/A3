<?php

namespace View;

class RegisterView
{

  private static $name = 'RegisterView::UserName';
  private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $messageId = 'RegisterView::Message';
  private static $registerBtn = 'RegisterView::Register';

  private $message = '';

  public function wantsRegisterPage(): bool
  {
    return isset($_GET["register"]);
  }

  public function wantsToRegister()
  {
    return isset($_POST[self::$registerBtn]);
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

  public function generateBodyHTML(): string
  {
    return ' 
    <div class="container" >
    <h2>Register new user</h2>
    <form action="?register" method="post" enctype="multipart/form-data">
      <fieldset>
      <legend>Register a new user - Write username and password</legend>
        <p id="' . self::$messageId . '">' . $this->message . '</p>
        <label for="' . self::$name . '" >Username :</label>
        <input type="text" size="20" name="' . self::$name . '" id="' . self::$name . '" value="" />
        <br/>
        <label for="' . self::$password . '" >Password  :</label>
        <input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" value="" />
        <br/>
        <label for="' . self::$passwordRepeat . '" >Repeat password  :</label>
        <input type="password" size="20" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" value="" />
        <br/>
        <input id="submit" type="submit" name="RegisterView::Register"  value="Register" />
        <br/>
      </fieldset>
    </form>
    </div>';
  }
}
