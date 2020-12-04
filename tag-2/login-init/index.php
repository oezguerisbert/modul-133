<?php
  session_start();
  
  // Falls Aufruf von Login-Seite
  if($_SERVER['REQUEST_METHOD'] === 'POST') 
  {  
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
      // Zugangsdaten einlesen
      $username = htmlspecialchars($_POST["username"]);
      $password = htmlspecialchars($_POST["password"]);
      
      // Ist der Zugang korrekt
      if($username == "ibz" && $password == "ibz12345$")         
      {
        $_SESSION['logged_in'] = true;

        // Geschützte Seite öffnen
        echo "<script type='text/javascript'>window.location='content.php'</script>";
      }
      else
      {
        // Ungültige Anmeldung
        echo "<p>Kein Zugang<br /></p>";
      }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="username">Benutzername</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="" required>
        </div>
        <button type="submit" id="login" class="btn btn-primary">Login</button>
    </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
