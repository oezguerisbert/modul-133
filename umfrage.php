<?php

$errors = [];

// Schritt 4
$email = $_POST['email'] ?? '';
$country = $_POST['country'] ?? '';
$explorer = $_POST['radioExplorer'] ?? '';
$interesse = $_POST['interesse'] ?? '';
$programmierung = false;
$design = false;
$web = false;
$filename = "umfrage.csv";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $programmierung = array_key_exists("programmierung", $interesse) ? "1" : "0";
    $design = array_key_exists("design", $interesse) ? "1" : "0";
    $web = array_key_exists("web", $interesse) ? "1" : "0";

    if (!file_exists($filename)) {
        $handle = fopen($filename, "a+");
        if(!$handle){
            dd("Some Error Occured");
        }
        $title = array("E-Mail", "Country", "Browser", "Programmierung", "Design", "Web");
        $values = array($email, $country, $explorer, $programmierung, $design, $web);
        $titleString = join(";", $title) . "\n";
        $valuesString = join(";", $values) . "\n";
        $toBeWritten = $titleString . $valuesString;
        fwrite($handle, $toBeWritten);
        fclose($handle);
    } else {
        $handle = fopen($filename, "a+");
        $values = array($email, $country, $explorer, $programmierung, $design, $web);
        $valuesString = join(";", $values) . "\n";
        $toBeWritten = $valuesString;
        fwrite($handle, $toBeWritten);
        fclose($handle);
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

    <style type="text/css">
        .errors {
            border: 1px solid #E20404;
            background: #FFF3F3;
            color: #E20404;
            padding: 1em;
            border-radius: 4px;
        }

        .errors li {
            padding-left: 4px;
            margin-left: 14px;
        }
         </style>

    <title>Ihre Angaben</title>
  </head>
  <body>
  <div class="container">
    <h1>Umfrage</h1>

    <!-- SCHRITT 2 -->
    <?php if (count($errors) > 0): ?>
        <ul class="errors">
            <?php foreach ($errors as $error): ?>
                <li><?=$error?></li>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
    <!-- /SCHRITT 2 -->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">e-Mail</label>
            <div class="col-sm-9">
                <input id="email" name="email" type="email" class="form-control" placeholder="name@domain.de" value="<?php echo $email; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="country" class="col-sm-3 col-form-label">Land</label>
            <div class="col-sm-9">
                <select id="country" name="country" class="form-control">
                <option value="1" <?php echo $country == 1 ? "selected" : ""; ?>>Schweiz</option>
                <option value="2" <?php echo $country == 2 ? "selected" : ""; ?>>Deutschland</option>
                <option value="3" <?php echo $country == 3 ? "selected" : ""; ?>>Frankreich</option>
                </select>
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-3 pt-0">Welchen Browser nutzen Sie ?</legend>
                <div class="col-sm-9">
                    <div class="form-check">
                        <input id="radioIE" type="radio" class="form-check-input" name="radioExplorer" value="1" <?php echo $explorer == 1 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="radioIE">Internet-Explorer</label>
                    </div>
                    <div class="form-check">
                        <input id="radioMozilla" type="radio" class="form-check-input" name="radioExplorer" value="2" <?php echo $explorer == 2 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="radioMozilla">Mozilla</label>
                    </div>
                    <div class="form-check">
                        <input id="radioOther" type="radio"class="form-check-input" name="radioExplorer" value="3" <?php echo $explorer == 3 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="radioOther">anderer Browser</label>
                    </div>
                    <div class="form-check">
                        <input id="radioUnknow" type="radio" class="form-check-input" name="radioExplorer" value="4" <?php echo $explorer == 4 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="radioUnknow">ich weiss es nicht</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="form-group row">
            <div class="col-sm-3">Ich interessiere mich für</div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input id="checkProg" class="form-check-input" type="checkbox" name="interesse[programmierung]" value="programmierung" <?php echo $programmierung ? "checked" : ""; ?>>
                    <label for="checkProg" class="form-check-label">Programmierung</label>
                </div>
                <div class="form-check">
                    <input id="checkDesign" class="form-check-input" type="checkbox" name="interesse[design]" value="design" <?php echo $design ? "checked" : ""; ?>>
                    <label for="checkDesign" class="form-check-label">Design</label>
                </div>
                <div class="form-check">
                    <input id="checkWeb" class="form-check-input" type="checkbox" name="interesse[web]" value="web" <?php echo $web ? "checked" : ""; ?>>
                    <label for="checkWeb" class="form-check-label">Web-Marketing</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <input class="btn btn-primary" type="submit" value="Jetzt anmelden">
            </div>
        </div>
    </form>
   </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
