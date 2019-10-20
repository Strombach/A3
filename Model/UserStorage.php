<?php

namespace Model;

class UserStorage
{
  private $jsonFile;

  private $jsonData;
  private $members;

  public function __construct(string $jsonFile)
  {
    $this->jsonFile = $jsonFile;
  }

  public function loadUsersFromFile(): void
  {
    $this->jsonData = file_get_contents($this->jsonFile, true);
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

  public function addTodoToUser(\Model\MemberData $member, string $todo)
  {
    for ($i = 0; $i < sizeof($this->members); $i++) {
      if ($this->members[$i]->username === $member->username) {
        $newTodo = new \stdClass();

        $newTodo->todo = $todo;
        $newTodo->complete = 0;

        array_push($this->members[$i]->todos, $newTodo);
      }
    }
    $this->saveUsersToFile();
  }

  private function saveUsersToFile()
  {
    $updatedMembers = json_encode($this->members);
    file_put_contents($this->jsonFile, $updatedMembers);
  }
}
