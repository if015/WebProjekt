<?php

/**
 * TODO (12/07/17):
 * - Ausgabe der Fehlermeldung
 *
 */
session_start();

$del = $_POST['id'];

if (!unlink("../".$del)) {
    //echo "Datei konnte nicht gelöscht werden";
} else {
    //echo "Datei wurde gelöscht";
    //header("Location: ../files.php");
}

