<?php
session_name('MeineSitzung');
session_start();

// Logout
/*
$_SESSION = array();
session_destroy();
exit();
*/

// Wo werden die Sessiondaten gespeichert
var_dump(session_save_path());
echo "Session name: " . session_name();
echo "<br>";

// Wert in Session speichern
$_SESSION["name"] = "Müller";
$_SESSION["vorname"] = "Lukas";

// Anzeigen des Session Arrays
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Zufälliger Wert wird in Cookie (PHPSESSID) gespeichert
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
?>
