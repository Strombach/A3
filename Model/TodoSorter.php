<?php

namespace Model;

class TodoSorter
{
  private $todosToSort;

  private $completedTodos = array();
  private $nonCompletedTodos = array();

  public function __construct(\Model\MemberData $member)
  {
    $this->todosToSort = $member->todos;

    if (!empty($this->todosToSort)) {
      $this->checkIfCompleted();
    }
  }

  public function getCompleted()
  {
    return $this->completedTodos;
  }

  public function getNonCompleted()
  {
    return $this->nonCompletedTodos;
  }

  private function checkIfCompleted()
  {
    for ($i = 0; $i < sizeof($this->todosToSort); $i++) {
      if ($this->todosToSort[$i]->complete) {
        array_push($this->completedTodos, $this->todosToSort[$i]);
      } else {
        array_push($this->nonCompletedTodos, $this->todosToSort[$i]);
      }
    }
  }
}
