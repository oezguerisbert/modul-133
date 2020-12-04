<?php
   /* Session-Start oder Session-Wiederaufnahme */
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
   if (isset($_SESSION["zz"]))   /* Zugriffszähler existiert */
   {
      $_SESSION["zz"] = $_SESSION["zz"] + 1;
      $_SESSION["name"] = "Max";
   }
   else                         /* Zugriffszähler ist neu */
   {
      $_SESSION["zz"] = 1;
   }

   echo "Ihr Besuch Nr.: " . $_SESSION["zz"] . "<br>";
   echo "Ihre Session-ID: " . session_id();
?>
</body>
</html>
