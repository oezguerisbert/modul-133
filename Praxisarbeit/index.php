<?php
    include_once './incs/createServices.func.inc.php';

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
        <h1>KXI</h1>
            <h2>
                Dein Ski-Service in den Alpen 😊⛷
            </h2>
            <br />
            <img src="<?php echo $background; ?>" class="col p-0 br-2 rounded" />
            <h3 class="pt-4">
                Über uns
            </h3>
            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut asperiores tempora maxime obcaecati iste voluptatem, provident sapiente nam eius perferendis a deserunt eveniet! Inventore, quod et eveniet doloremque illum incidunt.</p>
            <div class="row">
                <?php
                    $services = array(
                        array(
                            "title"=> "Kleiner Service",
                            "description" => "Unser kleiner Service beinhaltet die einfachen Einstellungen",
                            "price"=> "50.00 CHF",
                            "image" => "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
                            "cardLink" => "kleiner-service"
                        ),
                        array(
                            "title"=> "Großer Service",
                            "description" => "Unser grosser Service beinhaltet alle Einstellungen",
                            "price"=> "70.00 CHF",
                            "image" => "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
                            "cardLink" => "grosser-service"
                        ),
                        array(
                            "title"=> "Rennski-Service",
                            "description" => "Das Komplettpacket",
                            "price"=> "150.00 CHF",
                            "image" => "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
                            "cardLink" => "rennski-service"
                        ),
                        array(
                            "title"=> "Bindung montieren und einstellen",
                            "description" => "Die Bindung aller Verbindungen",
                            "price"=> "20.00 CHF",
                            "image" => "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
                            "cardLink" => "montage-service"
                        ),
                        array(
                            "title"=> "Fell zuschneiden",
                            "description" => "Das zuschneiden des Fells für das perfekte Feeling",
                            "price"=> "15.00 CHF",
                            "image" => "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
                            "cardLink" => "fell-service"
                        ),
                        array(
                            "title"=> "Heisswachsen",
                            "description" => "Mit hochprofessionellem Wachs wird ihr Equipment versorgt",
                            "price"=> "15.00 CHF",
                            "image" => "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
                            "cardLink" => "wachs-service"
                        ),
                    );
                    echo createServices($services);
                ?>
            </div>
            <div class="row p-5"></div>
        </div>
        <?php include './incs/footer.inc.php'; ?>
    </div>
</body>
</html>