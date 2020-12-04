<?php
session_start();
require_once './classes/DB.class.php';
require_once './repositories/Service.repo.php';
require_once './repositories/User.repo.php';
require_once './incs/createServices.func.inc.php';

$background = "https://images.unsplash.com/photo-1486072889922-9aea1fc0a34d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80";
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
    $usertype = UserRepository::find($_SESSION['userid'])->getUsertype();
    $ml = "ml-auto";
    if (in_array($usertype, array("moderator", "admin"))) {
        echo "<a href=\"./dashboard.php\" class=\"fas fa-compass fa-2x align-self-end text-decoration-none\"></a>";
        $ml = "ml-3";
    }
    echo "<a href=\"./logout.php\" class=\"fas fa-sign-out-alt fa-2x $ml align-self-end text-decoration-none\"></a>";

}
?>
                </div>
            </div>
            <h2>
                Dein Ski-Service in den Alpen 😊⛷
            </h2>
            <br />
            <img src="<?php echo $background; ?>" class="col p-0 br-2 rounded h-50" />
            <h3 class="pt-4">
                Über uns
            </h3>
            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut asperiores tempora maxime obcaecati iste voluptatem, provident sapiente nam eius perferendis a deserunt eveniet! Inventore, quod et eveniet doloremque illum incidunt.</p>
            <div class="row row-cols-3 justify-content-around">
<?=createServices(ServiceRepository::findAll());?>
            </div>
            <div class="row p-5"></div>
        </div>
<?php include './incs/footer.inc.php';?>
    </div>
</body>
</html>