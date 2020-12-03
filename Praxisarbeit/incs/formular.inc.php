<?php
    include './incs/createInput.func.inc.php';
    include './incs/createPriorities.func.inc.php';
    include './incs/createAlert.func.inc.php';
    include './incs/checkInput.func.inc.php';
    include './incs/getPrioDays.func.inc.php';
    include './incs/DB.class.inc.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $vname = $_POST['vorname'];
        $nname = $_POST['nachname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $prio = $_POST['prio'];
        $errors = checkInput(array("vorname" => $vname,"nachname" => $nname,"phone" => $phone,"priority" => $prio, "email" => $email));
        if(sizeof($errors) === 0){
            $db_result = DB::addService(array(
                "vorname" => $vname,
                "nachname" => $nname,
                "email" => $email,
                "phone" => $phone,
                "service" => strtolower($service), 
                "priority" => $prio
                )
            );
            $db_query_result = $db_result ? "success" : "warning";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kxi-Service</title>
    <?php
    include './incs/bootstrap.head.inc.php';
    ?>
</head>
<body>
    <div class="container">
        <div class="col pt-4 pb-4">
            <div class="row">
                <div class="col"></div>
                <div class="col-8">
                <h1>
                    Service-Formular
                    <span class="badge badge-primary"><?php echo $service;?></span>
                    <?php
                        if(isset($prio)){
                            ?>
                            <span class="badge badge-secondary"><?php echo $prio;?></span>
                            <?php
                        }
                        
                    ?>
                </h1>
                <div id="infos">
                    <?php 
                    if(isset($db_query_result) && sizeof($errors) === 0){
                        echo createAlert($db_query_result, "✨ Perfekt!", array("Wir werden Sie am ".(date("d.m.Y", strtotime("+".getPrioDays($prio)." days")))." (in ".getPrioDays($prio)." Tagen) kontaktieren."));
                        echo "<a class=\"btn btn-secondary\" href=\"javascript:history.back()\">zurück</a>";
                    }else if(isset($errors) && sizeof($errors) > 0){
                        echo createAlert("warning", "Opps!", $errors);
                    }
                    ?>
                </div>
                <?php if(!isset($db_query_result) || sizeof($errors) > 0){
                    ?>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <?php
                            echo "<h4>Ihre Persönliche Daten</h4>";
                            echo createInput("vorname", !isset($vname) ? "" : trim($vname), "text", null, true);
                            echo createInput("nachname",!isset($nname) ? "" : trim($nname), "text", null, true);
                            echo createInput("email", !isset($email) ? "" : trim($email), "email", "Ihr E-Mail wird nach dem Service entfernt.", true);
                            echo createInput("phone", !isset($phone) ? "" : trim($phone), "phone", "Ihre Telefonnummer wird nach dem Service entfernt.", true);
                            echo "<h4>Wählen sie eine Priorität aus</h4>";
                            echo createPriorities(array("Tief", "Standart", "Express"), isset($prio) ? $prio : "");
                        ?>
                        <br />
                        <div class="row">
                            <div class="col-lg-10">
                                <a class="btn btn-secondary" href="javascript:history.back()">zurück</a>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-primary align-self-end" type="submit">Senden</button>
                            </div>
                        </div>
                    </form>
                <?php
                }
                ?>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</body>
</html>