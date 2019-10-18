<?php

namespace Model;

use Exception;

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

  public function authUser(string $username, string $password)
  {
    $user = $this->findUserByUsername($username);

    if ($user) {
      if ($user->password == $password) {
        return true;
      } else {
        throw new \WrongCredentials();
      }
    } else {
      throw new \WrongCredentials();
    }
  }

  private function findUserByUsername($uname)
  {
    for ($i = 0; $i < sizeof($this->members); $i++) {
      if ($this->members[$i]->username === $uname) {
        return $this->members[$i];
      }
    }
    return false;
  }
}
