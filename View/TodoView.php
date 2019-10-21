<?php

namespace View;

class TodoView
{
  private static $todoText = 'TodoView::TodoTextArea';
  private static $add = 'TodoView::TodoaddButton';
  private static $complete = 'TodoView::CompleteTodo';
  private static $delete = 'TodoView::DeleteTodo';

  private $username = '';

  private $nonCompleteTodos;
  private $completeTodos;


  public function wantsToAddTodo()
  {
    return isset($_POST[self::$add]);
  }

  public function getAddedTodo()
  {
    return $_POST[self::$todoText];
  }

  public function getDeletedTodo()
  {
    return $_POST[self::$delete];
  }

  public function wantsToCompleteTodo()
  {
    return isset($_POST[self::$complete]);
  }

  public function wantsToDeleteTodo()
  {
    return isset($_POST[self::$delete]);
  }

  public function setName(string $username)
  {
    $this->username = $username;
  }

  public function setCompleteTodos($todos)
  {
    $this->completeTodos = $todos;
  }

  public function setNonCompleteTodos($todos)
  {
    $this->nonCompleteTodos = $todos;
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
    <form id="' . self::$delete . '" method="post" ></form>
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
      for ($i = 0; $i < sizeof($this->completeTodos); $i++) {
        $ret .= '
        <li>
        ' . $this->completeTodos[$i]->todo . '
        </li>
        <button name="' . self::$delete . '" value="' . $this->completeTodos[$i]->todo . '" form="' . self::$delete . '">Delete</button>
        ';
      }
      $ret .= '</ul>';
    } else {
      $ret = '<p>No completed tasks yet, get cracking!</p>';
    }

    return $ret;
  }

  private function generateRemainingTodos()
  {
    $ret = '
    <form id="' . self::$complete . '" method="post" ></form>
    <ol>';

    if (!empty($this->nonCompleteTodos) > 0) {
      for ($i = 0; $i < sizeof($this->nonCompleteTodos); $i++) {
        $ret .= '
        <li>
        ' . $this->nonCompleteTodos[$i]->todo . '
        </li>
        <button name="' . self::$complete . '" value="' . $this->nonCompleteTodos[$i]->todo . '" form="' . self::$complete . '">Complete</button>
        <button name="' . self::$delete . '" value="' . $this->nonCompleteTodos[$i]->todo . '" form="' . self::$delete . '">Delete</button>
        ';
      }
      $ret .= '</ol>';
    } else {
      $ret = '<p>Nothing to do yet</p>';
    }

    return $ret;
  }
}
