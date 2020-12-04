<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$kennzeichen = array("HH" => "Hamburg", "B" => "Berlin", "S" => "Stuttgart");
$kennzeichen["F"] = "Frankfurt";
$kennzeichen["HB"] = "Bremen";

unset($kennzeichen["HB"]);
$kennzeichen["F"] = "Frankfurt am Main";
?>
    <table border="1">
        <thead>
            <th>
                Kennzeichen
            </th>
            <th>
                Stadt
            </th>
        </thead>
        <tbody>
            <?php
foreach ($kennzeichen as $kuerzel => $stadt) {
    print "<tr>";
    print "<td>$kuerzel</td>";
    print "<td>$stadt</td>";
    print "</tr>";
}
?>
        </tbody>
    </table>

</body>
</html>
