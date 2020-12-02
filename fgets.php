<br />
<?php
if (is_file("./protokoll.txt") && file_exists("./protokoll.txt")) {
    $handle = fopen("protokoll.txt", "r");
    if ($handle != false) {
        while (!feof($handle)) {
            $zeile = fgets($handle);
            echo $zeile . "<br>";
        }
        fclose($handle);
    } else {
        echo "<p>Beim Öffnen der Datei trat ein Fehler auf.</p>";
    }
} else {
    echo "<p>Der angegebene Name ist keine Datei</p>";
}
