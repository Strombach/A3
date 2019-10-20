<?php

namespace Model;

class UserStorage
{

  private $jsonData;
  private $members;

  public function loadUsersFrom(string $jsonFile): void
  {
    $this->jsonData = file_get_contents($jsonFile, true);
    $this->members = json_decode($this->jsonData);
  }

  public function findUserByUsername(string $username): \Model\MemberData
  {
    for ($i = 0; $i < sizeof($this->members); $i++) {
      if ($this->members[$i]->username === $username) {
        $foundMember = new \Model\MemberData($this->members[$i]->username, $this->members[$i]->password, $this->members[$i]->todos);
        return $foundMember;
      }
    }
    throw new \WrongCredentials();
  }
}
