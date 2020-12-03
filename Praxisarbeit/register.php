<?php
    session_start();
    // include_once './incs/createUsers.func.inc.php';
    include_once './incs/createInput.func.inc.php';
    include_once './incs/checkInput.func.inc.php';
    include_once './incs/createAlert.func.inc.php';
    include_once './incs/DB.class.inc.php';
    // $users = DB::getUsers();
    $data = array(
        "username" => null,
        "vorname" => null,
        "nachname" => null,
        "email" => null,
        "password" => null
    );

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $data["username"] = $_POST['username'];
        $data["vorname"] = $_POST['vorname'];
        $data["nachname"] = $_POST['nachname'];
        $data["email"] = $_POST['email'];
        $data["phone"] = $_POST['phone'];
        $data["password"] = hash("sha256", $_POST['password']);
        $data_errors = checkInput($data);
        $data_ok = sizeof($data_errors) == 0;
        
        $db_query_result = DB::createUser($data);
        if($db_query_result){
            $_SESSION['userid'] = DB::checkLogin(array("username"=> $data['username'], "password" => $data['password']))['id'];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KXI-Service - Login</title>
    <?php
        include './incs/bootstrap.head.inc.php';
    ?>
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
    <div class="container p-3">
        <div class="col-md-6 m-auto">
            <h2 class="pl-3 pr-3">Registration</h2>
            <?php 
            if(isset($db_query_result) && sizeof($data_errors) === 0) {
                print "<script>document.location.href = './index.php';</script>";
            }else if(isset($data_errors) && sizeof($data_errors) > 0) {
                echo createAlert("warning", "Opps!", $data_errors);
            }
            ?>
            <form class="col p-3 pt-4" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <?= createInput("username", (isset($data_ok) && !$data_ok) ? $data["username"] : "", "text", null, true); ?>
                <?= createInput("vorname", (isset($data_ok) && !$data_ok) ? $data["vorname"] : "", "text", null, true); ?>
                <?= createInput("nachname", (isset($data_ok) && !$data_ok) ? $data["nachname"] : "", "text", null, true); ?>
                <?= createInput("phone", (isset($data_ok) && !$data_ok) ? $data["phone"] : "", "phone", "Ihre Telefonnummer wird nicht weitergegeben.", true); ?>
                <?= createInput("email", (isset($data_ok) && !$data_ok) ? $data["email"] : "", "email", "Ihre E-Mail wird nicht weitergegeben.", true); ?>
                <?= createInput("password", (isset($data_ok) && !$data_ok) ? $data["password"] : "", "password", null, true); ?>
                <div class="col d-flex p-0 mt-3">
                    <a href="index.php" class="btn btn-secondary">Back to Front</a>
                    <button type="submit" class="btn btn-primary ml-auto align-self-end">Register & Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>