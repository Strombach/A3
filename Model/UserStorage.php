<?php

namespace Model;

class UserStorage
{

  private $jsonData;
  private $members;

  public function loadUsersFrom(string $jsonFile)
  {
    $this->jsonData = file_get_contents($jsonFile, true);
    $this->members = json_decode($this->jsonData);
  }

  public function findUserByUsername(string $username): \Model\MemberCredentials
  {
    for ($i = 0; $i < sizeof($this->members); $i++) {
      if ($this->members[$i]->username === $username) {
        $foundMember = new \Model\MemberCredentials($this->members[$i]->username, $this->members[$i]->password);
        return $foundMember;
      }
    }
    throw new \WrongCredentials();
  }
}
