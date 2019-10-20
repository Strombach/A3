<?php

namespace Controller;

class TodoController
{
  private $view;

  public function __construct(\View\TodoView $view)
  {
    $this->view = $view;
  }
}
