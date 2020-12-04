<?php
session_start();
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
<?php
if (!isset($_SESSION['userid'])) {
    ?>
    <a href="./login.php" class="fas fa-sign-in-alt fa-2x align-self-end  text-decoration-none"></a>
    <?php
} else {
    require './repositories/User.repo.php';
    $usertype = UserRepository::find($_SESSION['userid'])->getUsertype();
    $ml = "ml-auto";
    if (in_array($usertype, array("moderator", "admin"))) {
        echo "<a href=\"./index.php\" class=\"fas fa-home fa-2x align-self-end text-decoration-none\"></a>";
        $ml = "ml-3";
    }
    echo "<a href=\"./logout.php\" class=\"fas fa-sign-out-alt fa-2x $ml align-self-end text-decoration-none\"></a>";

}
?>
                </div>
            </div>
            <h2>
                Dashboard
            </h2>
            <div class="row row-cols-3  pl-3 pr-3 justify-content-around">
<?php
// CONTENT
include "./incs/dashboard.inc.php";
?>
            </div>
            <div class="row p-5"></div>
        </div>
    </div>
</body>
</html>