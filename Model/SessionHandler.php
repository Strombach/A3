<?php

namespace Model;

class SessionHandler
{
  public function isSessionSet(string $sessionKey): bool
  {
    return isset($_SESSION[$sessionKey]);
  }

  public function setSession($sessionKey): void
  {
    $_SESSION[$sessionKey] = true;
  }

  public function setLoginSession($sessionKey, $username): void
  {
    $_SESSION[$sessionKey] = $username;
  }

  public function getSessionValue($sessionKey): void
  {
    return $_SESSION[$sessionKey];
  }

  public function unsetSession($sessionKey): void
  {
    unset($_SESSION[$sessionKey]);
  }
}
