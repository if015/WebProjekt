<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 07.02.17
 * Time: 18:05
 */

/**
 * TODO (12/02/17):
 * - MIME bestimmen und nur jpg, png, gif zulassen
 * - Überprüfung, falls ein Profilbild bereits hochgeladen wurde, entsprechend das alte löschen
 * - Fehler übergeben
 *
 */
session_start();
include 'functions.php';

//Abfrage nach Mime!!!
$extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
$allowed_img = array('png', 'jpg', 'jpeg', 'gif');
if(!in_array($extension, $allowed_img)) {
    header('location: ../profile.php?hallo=hallo');
    exit;
}
else {
$uploaddir = '../avatar/';
$uploadfile = clearChar(basename($_FILES['file']['name']));
$uploadfile = $uploaddir . $uploadfile;
unlink($uploaddir.$_SESSION['dir'].".jpeg");
unlink($uploaddir.$_SESSION['dir'].".jpg");
unlink($uploaddir.$_SESSION['dir'].".gif");
unlink($uploaddir.$_SESSION['dir'].".png");

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    $fileinfo = pathinfo($uploadfile);
    rename($uploadfile, $uploaddir . $_SESSION['dir'] . "." . $fileinfo['extension']);
    header('location: ../profile.php');
}
else {
    echo "Fehler: Profilbild konnte nicht hochgeladen werden. Bitte wende dich an den Administrator.";
}
}

