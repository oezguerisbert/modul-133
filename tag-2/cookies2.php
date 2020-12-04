<?php

/**
 * Schreibe ein Programm, welches dem Besucher anzeigt,
 * wie oft der die Seite schon aufgerufen hat.
 */

if (!isset($_COOKIE['count'])) {
  setcookie("count", 1);
  echo "Das ist Ihr erster Besuch";
} 
else 
{
  $count = $_COOKIE['count'] + 1;
  setcookie("count", $count);
  echo "Das ist Ihr {$count}. Besuch";
}
 ?>
