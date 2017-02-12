<?php

/**
 * TODO (12/02/17):
 * - Fehlermeldung.
 */

session_start();

$dir = "../uploads/".$_SESSION['dir']."/trash/";

foreach (scandir($dir) as $file) {
    if (!is_dir($file)) {
        if(unlink($dir.$file)) {

        } else {
            echo "Fehler";
        };
    }
}

header("Location: ../files.php");

