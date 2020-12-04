<?php

// prüfen ob cookie besuch existiert
if (isset($_COOKIE["Besuch"])) 
{
    echo "cookie besuch exisitert. Besuch =" . $_COOKIE['Besuch'] . "</br>";

    // cookie löschen
    setcookie("Besuch", "", time() - 3600);
    echo "cookie Besuch wurde gelöscht";
}
else
{
    echo "cookie besuch existiert noch nicht.<br/>";
    // neues cookie
    setcookie("Besuch", "1", time() + 86400);
}

// Zufälliger Wert wird in Cookie (PHPSESSID) gespeichert
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
?>
