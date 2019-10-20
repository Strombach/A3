<?php

namespace View;

class TodoView
{
  private static $todoText = 'TodoView::TodoTextArea';

  public function generateBodyHTML(): string
  {
    return '
    ' . $this->generateTodoFormHTML() . '
    <h3>Remaining Todos</h3>
    <ol>

    </ol>
    <h3>Completed Todos</h3>
    <ul>

    </ul>
    ';
  }

  private function generateTodoFormHTML()
  {
    return '
    <form method="post" > 
      <label for="' . self::$todoText . '" >New Todo: </label>
        <input type="text" name=' . self::$todoText . '/>
        <input type="submit" name="' . self::$todoText . '" value="Add" form="' . self::$todoText . '"/>
    </form>
    ';
  }
}
