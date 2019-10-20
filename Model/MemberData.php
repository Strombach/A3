<?php

namespace Model;

class MemberData
{
  public $username;
  public $password;
  public $todos;

  public function __construct(string $uname, string $pword, array $todos)
  {
    $this->username = $uname;
    $this->password = $pword;
    $this->todos = $todos;
  }
}
