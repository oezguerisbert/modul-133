<?php
    session_start();
    include_once './incs/createUsers.func.inc.php';
    include_once './incs/createAlert.func.inc.php';
    include_once './incs/checkInput.func.inc.php';
    include_once './incs/DB.class.inc.php';
    $users = DB::getUsers();
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $data = array(
            "username" => $_POST['username'],
            "password" => hash("sha256", $_POST['password'])
        );
        $data_errors = checkInput($data);
        if(sizeof($data_errors) == 0){
            $user = DB::checkLogin($data);
            if($user){
                $_SESSION['userid'] = $user['id'];
                header("Location: ./");
            }else {
                $data_errors = array("password" => "Please retry, wrong password.");
            }
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
    <div class="container">
        <div class="col vw-100">
            <div class="row row-cols-3 p-3">
                <?php
                    if(isset($data_errors) && sizeof($data_errors) > 0) {
                        echo createAlert("warning", "Opps!", $data_errors);
                    }
                ?>
            </div>
            <div class="row p-3">
                <div class="col d-flex">
                    
                    <?= createUsers($users); ?>
                </div>
            </div>
            
        </div>
        <a href="index.php" class="btn btn-secondary">Back to Front</a>
        
    </div>
</body>
</html>