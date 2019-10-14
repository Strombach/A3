<?php

namespace Model;

class UserStorage
{

  private $jsonData;
  private $members;

  public function getMembers()
  {
    return $this->members;
  }

  public function loadUsers($jsonFile)
  {
    $this->jsonData = file_get_contents($jsonFile, true);
    $this->members = json_decode($this->jsonData);
  }

  public function findUserByUsername($uname)
  {
    for ($i = 0; $i < sizeof($this->members); $i++) {
      if ($this->members[$i]->username === $uname) {
        return $this->members[$i];
      }
    }
    return false;
  }

  public function authAUser($creds)
  {
    $user = $this->findUserByUsername($creds[0]);

    if ($user) {
      if ($user->password == $creds[1]) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function saveUser($newUser)
  { }
}
