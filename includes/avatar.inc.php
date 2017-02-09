<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 07.02.17
 * Time: 18:05
 */
session_start();
$dir ='../avatar/';
$newname = $_SESSION['dir'];
if (isset($_FILES["file"])) {
    $startname = $_FILES["file"]["tmp_name"];
    $zielname = basename($_FILES["file"]["name"]);
    if (@move_uploaded_file($startname, $dir.$zielname)) {
        rename($dir.$zielname, $dir.$newname.'.jpeg');
        header('location: ../profile.php');
    } else {
        echo "Fehler.";
    }
}