<?php

namespace Model;

class SessionHandler
{
  public function isSessionSet(string $sessionKey)
  {
    return isset($_SESSION[$sessionKey]);
  }

  public function setLoggedInSession()
  {
    $_SESSION["loggedIn"] = true;
  }

  public function unsetLoggedInSession()
  {
    unset($_SESSION["loggedIn"]);
  }
}
