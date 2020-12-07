<?php
session_start();
include_once './incs/createAlert.func.inc.php';
include_once './incs/checkInput.func.inc.php';
include_once './incs/createInput.func.inc.php';
include_once './repositories/User.repo.php';
include_once './classes/DB.class.php';
$login_blocked = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = array(
        "username" => $_POST['username'],
        "password" => hash("sha256", $_POST['password']),
    );
    $data_errors = checkInput($data);
    if (sizeof($data_errors) == 0) {
        $user = UserRepository::checkLogin($data);
        if ($user) {
            $_SESSION['userid'] = $user->getID();
            header("Location: ./" . ($_GET['redirect'] ?? ""));
        } else {
            $data_errors = array("password" => "Please retry, user/password wrong.");
            $_SESSION['loginattempts'] = isset($_SESSION['loginattempts']) ? $_SESSION['loginattempts'] + 1 : 1;
            if (!isset($_SESSION['lastloginattempt'])) {
                $data_errors = array("blockout" => "You tried to login too many times. Take a break!");
            } else {
                if ($_SESSION['loginattempts'] >= 3 && strtotime("now") - $_SESSION['lastloginattempt'] <= 50) {
                    $data_errors = array("blockout" => "You are blocked from logging in!");
                    $login_blocked = true;
                } else {

                    $_SESSION['loginattempts'] = 0;
                }
            }
            $_SESSION['lastloginattempt'] = strtotime("now");

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
</head>
<body>
    <div class="container pt-5">
        <div class="col-md-6 m-auto">

            <div class="col ">
                <?php
if (isset($data_errors) && sizeof($data_errors) > 0) {
    if ($_SESSION['loginattempts'] < 3 && !$login_blocked) {
        echo createAlert("warning", "😱 Something went wrong!", $data_errors);
    } else {
        echo createAlert("danger", "😠", $data_errors);

    }
}
?>
            </div>
            <?php
if (isset($login_blocked) && !$login_blocked) {
    ?>
<div class="col">
<form class="col align-items-center" action="login.php<?=($_GET['redirect'] ? "?redirect=" . $_GET['redirect'] : "")?> " method="POST">
    <?=createInput("username", $_POST['username'] ?? "", "text", null, true);?>
    <?=createInput("password", $_POST['password'] ?? "", "password", null, true);?>
    <div class="col d-flex p-0">
        <button type="submit" class="btn ml-auto btn-primary">Login</button>
    </div>
    <div class="col d-flex p-0 mt-3">
        <a href="index.php" class="btn btn-secondary">Back to Front</a>
        <a href="register.php<?php echo isset($_GET['redirect']) ? "?redirect=" . $_GET['redirect'] : ""; ?>" class="btn ml-2 mr-auto btn-success">Register</a>
    </div>
</form>
</div>
<?php
}
?>

        </div>
    </div>
</body>
</html>