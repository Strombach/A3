<?php

namespace Model;

class SessionHandler
{
  public function isSessionSet(string $sessionKey): bool
  {
    return isset($_SESSION[$sessionKey]);
  }

  public function setSession($sessionKey)
  {
    $_SESSION[$sessionKey] = true;
  }

  public function setLoginSession($sessionKey, $username)
  {
    $_SESSION[$sessionKey] = $username;
  }

  public function unsetSession($sessionKey)
  {
    unset($_SESSION[$sessionKey]);
  }
}
