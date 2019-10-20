<?php

namespace View;

class TodoView
{
  private static $todoText = 'TodoView::TodoTextArea';
  private static $add = 'TodoView::TodoaddButton';

  private $username = '';
  private $nonCompleteTodos = array();
  private $completeTodos = array();

  public function wantsToAddTodo()
  {
    if (isset($_POST[self::$add])) {
      return $_POST[self::$todoText];
    }
  }

  public function setName(string $username)
  {
    $this->username = $username;
  }

  public function generateBodyHTML(): string
  {
    return '
    ' . $this->generateTodoFormHTML() . '
    <h3>Remaining Todos for ' . $this->username . '</h3>
    ' . $this->generateRemainingTodos() . '
    <h3>Completed Todos</h3>
    ' . $this->generateCompleteTodos() . '
    ';
  }

  private function generateTodoFormHTML()
  {
    return '
    <form id="' . self::$todoText . '" method="post" > 
      <label for="' . self::$todoText . '" >New Todo: </label>
        <input type="text" name=' . self::$todoText . '>
        <input type="submit" name="' . self::$add . '" value="Add Todo" form="' . self::$todoText . '">
    </form>
    ';
  }

  private function generateCompleteTodos()
  {
    $ret = '<ul>';

    if (!empty($this->completeTodos) > 0) {
      for ($i = 0; $i < sizeof($this->completeTodos); $i++) { }
      $ret .= '</ul>';
    } else {
      $ret = '<p>No completed tasks yet, get cracking!</p>';
    }

    return $ret;
  }

  private function generateRemainingTodos()
  {
    $ret = '<ol>';

    if (!empty($this->nonCompleteTodos) > 0) {
      for ($i = 0; $i < sizeof($this->nonCompleteTodos); $i++) { }
      $ret .= '</ol>';
    } else {
      $ret = '<p>Nothing to do yet</p>';
    }

    return $ret;
  }
}
