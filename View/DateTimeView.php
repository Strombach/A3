<?php

namespace View;

date_default_timezone_set('Europe/Stockholm');

class DateTimeView
{

  public function showDate(): string
  {
    $dayText = date('l');
    $dateNum = date('jS');
    $monthAndYear = date('F Y');
    $time = date('G:i:s');

    $timeString = "$dayText, the $dateNum of $monthAndYear, The time is $time";

    return '<p>' . $timeString . '</p>';
  }
}
