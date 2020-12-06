<?php
session_start();
require_once './repositories/User.repo.php';
require_once './classes/User.class.php';
require_once './repositories/Auftraege.repo.php';
require_once './repositories/Modus.repo.php';
require_once './repositories/Kommentar.repo.php';
if(!(isset($_SESSION['userid']) && isset($_GET['id']))){
    header("Location: ./");
}else {
    $user = UserRepository::find($_SESSION['userid']);
    if(!$user || !(in_array($user->getUsertype(), User::getSupervisedUsertypes()))){
        header("Location: ./");
    }
    if(in_array($_GET['m'], ModusRepository::asArray("kuerzel"))){
        AuftraegeRepository::updateModus($_GET['id'], $_GET['m']);
    }
    if(isset($_GET['v'])){
        $vMode = $_GET['v'] === "1" ? true : false;
        AuftraegeRepository::setVisibility($_GET['id'], $vMode);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KXI-Service</title>
    <?php
include './incs/bootstrap.head.inc.php';
?>
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
    <div class="container">
        <div class="col pt-4 pb-4">
            <div class="row pl-3 pr-3 d-flex">
                <h1>KXI</h1>
                <div class="ml-auto options d-flex pt-3 pb-3">
                    <a href="./dashboard.php" class="fas fa-compass fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="./logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>
            <div class="row p-3 pt-5">
                <?php
                $auftrag = AuftraegeRepository::find($_GET['id']);

                if(!$auftrag) {
                    echo "<div class=\"mt-5 col-md-12 p-4 vw-100 border bg-light rounded\" style=\"border-color:#bfc0c0;\">
                        <div class=\"p-2 text-center\" style=\"color:#7f7f7f;\">Dieser Auftrag existiert nicht.</div>
                    </div>";
                }else {
                    echo $auftrag->toHTML();
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>