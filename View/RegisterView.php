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

  public function wantsToRegister(): bool
  {
    return isset($_POST[self::$registerBtn]);
  }

  public function getPostUserName(): string
  {
    return $_POST[self::$name];
  }

  public function getPostPassword(): string
  {
    return $_POST[self::$password];
  }

  public function getPostPasswordRepeat(): string
  {
    return $_POST[self::$passwordRepeat];
  }

  public function setMessage(string $newMessage): void
  {
    $this->message .= $newMessage;
  }

  public function applyTagFilter(string $username): string
  {
    if (strip_tags($username) === $username) {
      return $username;
    } else {
      throw new \InvalidCharacters;
    }
  }

  public function generateBodyHTML(): string
  {
    $username = $this->getPreviousEnteredUsername();
    return ' 
    <div class="container" >
    <h2>Register new user</h2>
    <form action="?register" method="post" enctype="multipart/form-data">
      <fieldset>
      <legend>Register a new user - Write username and password</legend>
        <p id="' . self::$messageId . '">' . $this->message . '</p>
        <label for="' . self::$name . '" >Username :</label>
        <input type="text" size="20" name="' . self::$name . '" id="' . self::$name . '" value="' . $username . '" />
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
    </div>
    ';
  }

  private function getPreviousEnteredUsername()
  {
    if (!empty($_POST[self::$name])) {
      return strip_tags($_POST[self::$name]);
    }
  }
}
