<?php

namespace View;

class LayoutView
{

  private static $registerLocation = 'register';

  public function renderHTML(bool $isLoggedIn, $v, DateTimeView $dtv): void
  {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 3</h1>
          ' . $this->renderNavLinks($isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->generateBodyHTML($isLoggedIn) . '
              
              ' . $dtv->showDate() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderIsLoggedIn(bool $isLoggedIn): string
  {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    } else {
      return '<h2>Not logged in</h2>';
    }
  }

  private function renderNavLinks(bool $isLoggedIn): string
  {
    if (isset($_GET[self::$registerLocation]) && !$isLoggedIn) {
      return '<a href="?">Back to login</a>';
    } else if (!$isLoggedIn) {
      return '<a href="?' . self::$registerLocation . '">Register a new user</a>';
    } else {
      return '';
    }
  }
}
