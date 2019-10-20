<?php

namespace Model;

class SessionHandler
{
  public function isSessionSet(string $sessionKey): bool
  {
    return isset($_SESSION[$sessionKey]);
  }

  public function setSession(string $sessionKey): void
  {
    $_SESSION[$sessionKey] = true;
  }

  public function setLoginSession(string $sessionKey, string $username): void
  {
    $_SESSION[$sessionKey] = $username;
  }

  public function getSessionValue(string $sessionKey)
  {
    return $_SESSION[$sessionKey];
  }

  public function unsetSession(string $sessionKey): void
  {
    unset($_SESSION[$sessionKey]);
  }
}
