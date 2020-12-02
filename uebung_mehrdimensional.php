<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$kennzeichen = array(
    array(
        "beginn" => "9:30",
        "disziplin" => "Diskuswurf",
        "ort" => "Nebenplatz",
        "bemerkung" => "Jugendmeisterschaften",
    ),
    array(
        "beginn" => "10:00",
        "disziplin" => "5-km-Lauf",
        "ort" => "Stadtion - Laufbahn",
        "bemerkung" => "Offener Lauf",
    ),
    array(
        "beginn" => "11:00",
        "disziplin" => "Halbmarathon",
        "ort" => "Waldgebiet",
        "bemerkung" => "Teilnahme ab 18",
    ),
    array(
        "beginn" => "12:00",
        "disziplin" => "Stabhochsprung",
        "ort" => "Stadion - Stabhochsprunganlage",
        "bemerkung" => "Nur Frauen",
    ),
);

?>
    <table border="1">
        <thead>
            <th>Beginn</th>
            <th>Disziplin</th>
            <th>Ort</th>
            <th>Bemerkung</th>
        </thead>
        <tbody>
            <?php
foreach ($kennzeichen as $rowIndex => $reihe) {
    print "<tr>";
    $beginn = $reihe['beginn'];
    $disziplin = $reihe['disziplin'];
    $ort = $reihe['ort'];
    $bemerkung = $reihe['bemerkung'];

    print "<td>$beginn</td>";
    print "<td>$disziplin</td>";
    print "<td>$ort</td>";
    print "<td>$bemerkung</td>";

    print "</tr>";
}
?>
        </tbody>
    </table>

</body>
</html>
