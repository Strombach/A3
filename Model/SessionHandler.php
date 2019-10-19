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

  public function unsetSession($sessionKey)
  {
    unset($_SESSION[$sessionKey]);
  }
}
