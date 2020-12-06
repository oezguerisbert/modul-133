<?php 
session_start();
$service = $_GET['service'];
include './incs/formular.inc.php';
require_once './incs/createInput.func.inc.php';
require_once './incs/createPriorities.func.inc.php';
require_once './incs/createAlert.func.inc.php';
require_once './incs/checkInput.func.inc.php';
require_once './incs/getPrioDays.func.inc.php';
require_once './repositories/Service.repo.php';
require_once './repositories/Priority.repo.php';
require_once './classes/DB.class.php';

if (isset($_SESSION['userid'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $prio = $_POST['prio'];
        $errors = checkInput(array("priority" => $prio));
        if (sizeof($errors) === 0) {
            $db_result = DB::addService(array("userid" => $_SESSION['userid'], "service" => strtolower($service), "priority" => $prio));
            $db_query_result = $db_result ? "success" : "warning";
        }
    }
} else {
    header("Location: ../login.php?redirect=" . "formular/?service=$service");
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
                        <br />
                        <?=ServiceRepository::findByKuerzel($service) ?>
                        <?php
if (isset($prio)) {
    ?>
        <?=PriorityRepository::findByKuerzel($prio)?>
    <?php
}

?>
                </h1>
                <div id="infos">
                    <?php
if (isset($db_query_result) && sizeof($errors) === 0) {
    echo createAlert($db_query_result, "✨ Perfekt!", array("Wir werden Sie am " . (date("d.m.Y", strtotime("+" . getPrioDays($prio) . " days"))) . " (in " . getPrioDays($prio) . " Tagen) kontaktieren."));
    echo "<a class=\"btn btn-secondary\" href=\"javascript:document.location.href= './';\">zurück</a>";
} else if (isset($errors) && sizeof($errors) > 0) {
    echo createAlert("warning", "Opps!", $errors);
}
?>
                </div>
                <?php if (!isset($db_query_result) || sizeof($errors) > 0) {
    ?>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <h5>Wählen sie eine Priorität aus</h5>
                        <?=createPriorities(PriorityRepository::findAll(), isset($prio) ? $prio : "");?>
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