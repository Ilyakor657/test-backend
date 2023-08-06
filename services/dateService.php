<?php
  function dateException($date) {
    $dateNew = $date;
    while (true) {
      $i = 0;
      $dateArray = explode("-", $dateNew);
      $timestamp = mktime(0, 0, 0, $dateArray[1], $dateArray[2], $dateArray[0]);
      if (getdate($timestamp)['mday'] <= 8 && getdate($timestamp)['mon'] == 1) {
        $dateNew = "".$dateArray[0]."-01-09";
        $i = 1;
      } elseif (getdate($timestamp)['mday'] == 23 && getdate($timestamp)['mon'] == 2) {
        $dateNew = "".$dateArray[0]."-02-24";
        $i = 1;
      } elseif (getdate($timestamp)['mday'] == 8 && getdate($timestamp)['mon'] == 3) {
        $dateNew = "".$dateArray[0]."-03-09";
        $i = 1;
      } elseif (getdate($timestamp)['mday'] == 1 && getdate($timestamp)['mon'] == 5) {
        $dateNew = "".$dateArray[0]."-05-02";
        $i = 1;
      } elseif (getdate($timestamp)['mday'] == 9 && getdate($timestamp)['mon'] == 5) {
        $dateNew = "".$dateArray[0]."-05-10";
        $i = 1;
      } elseif (getdate($timestamp)['mday'] == 12 && getdate($timestamp)['mon'] == 6) {
        $dateNew = "".$dateArray[0]."-06-13";
        $i = 1;
      } elseif (getdate($timestamp)['mday'] == 4 && getdate($timestamp)['mon'] == 11) {
        $dateNew = "".$dateArray[0]."-11-05";
        $i = 1;
      } elseif (getdate($timestamp)['wday'] == 0) {
        $dateNew = date('Y-m-d', strtotime('+1 day', strtotime($dateNew)));
        $i = 1;
      }
      if ($i == 0) { 
        break;
      }
    }
    return $dateNew;
  }
?>