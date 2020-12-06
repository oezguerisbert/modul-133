<?php
/**
 * Crates a Bootstrap-Card
 *
 * @param string $imageLink
 * @param string $title
 * @param string $description
 *
 * @return string precreated card as html
 */
function createCard(string $imageLink, string $title, string $description = "", string $buttonText = "Open", string $cardLink = "")
{

    return "
        <div class=\"col p-2\">
            <div class=\"card\">
                <img src=\"$imageLink\" class=\"card-img-top\">
                <div class=\"card-body\" style=\"height:180px;\">
                    <h5 class=\"card-title\">$title</h5>
                    <p class=\"card-text\" style=\"height:50px;\">$description</p>
                    <a href=\"./formular.php?service=$cardLink\" class=\"btn btn-primary align-self-end\">$buttonText</a>
                </div>
            </div>
        </div>
        ";
}
/**
 * Crates a Service-Rows-Card
 *
 * @param array $array
 *
 * @return string precreated cards as html
 */
function createServices(array $services)
{
    $d = "";
    foreach ($services as $key2 => $value) {
        $d .= createCard(
            $value->getImage(),
            $value->getTitle(),
            $value->getDescription(),
            $value->getPrice() . " CHF",
            $value->getKuerzel()
        );
    }

    return $d;
}
