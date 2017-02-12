<?php

/**
 * TODO (12/02/17):
 * - Fehlerausgabe
 * - Überschreiben verhindern
 */

session_start();
include 'functions.php';
$dir ='../uploads/' . $_SESSION['dir'] . '/';

$uploaddir = '../uploads/' . $_SESSION['dir'] . '/';
$uploadfile = clearChar(basename($_FILES['file']['name']));
$uploadfile = $uploaddir . $uploadfile;

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    //Upload erfolgreich
} else {
    echo "Fehler beim Upload";
}


