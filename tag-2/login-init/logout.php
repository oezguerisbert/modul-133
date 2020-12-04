<?php
   /* Session-Start oder Session-Wiederaufnahme */
   session_start();

   // Sitzung löschen
   session_unset();
   session_destroy();  
   
   echo "<script type='text/javascript'> window.location = 'index.php' </script>";   
?>
