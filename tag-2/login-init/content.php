<?php
   /**
    *  Session starten oder wieder aufnehmen
    */
   session_start();
?>   

<?php
/**
 * Session überprüfen
 */
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) 
{
    echo "<script type='text/javascript'> alert('Bitte melden sie sich an!') </script>";
    echo "<script type='text/javascript'> window.location = 'index.php' </script>";
    exit;
}
?> 
<html>
<body>
<h3>Beliebige geschützte Seite</h3>
<?php
   /* Begrüssung des Benutzers */
   echo "<p>Anmeldung war erfolgreich</p>";   
?>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
