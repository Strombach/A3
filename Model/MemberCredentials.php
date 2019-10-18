<?php

namespace Model;

class MemberCredentials
{
  public $username;
  public $password;

  public function __construct(string $uname, string $pword)
  {
    $this->username = $uname;
    $this->password = $pword;
  }
}
