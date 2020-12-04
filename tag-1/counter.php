<p>Der Stand des Zähler ist: <?php counter();?></p>

<?php
function counter()
{
    $name = "counter.txt";
    $handle = fopen($name, "r+");
    if ($handle) {
        flock($handle, LOCK_EX);
        $count = fgets($handle, 10);
        fseek($handle, 0);
        echo "<strong>" . ++$count . "</strong>";
        fwrite($handle, $count);
        fclose($handle);
    }
}
?>