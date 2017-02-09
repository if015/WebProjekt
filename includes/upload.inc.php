<?php
session_start();
$dir ='../uploads/' . $_SESSION['dir'] . '/';

if (isset($_FILES["file"])) {
    $startname = $_FILES["file"]["tmp_name"];
    $zielname = $_FILES["file"]["name"];
    $zielname = $dir . basename($zielname);
    if (@move_uploaded_file($startname, $zielname)) {
        //chmod($zielname, 0600);
        header('location: ../files.php');
        exit;
    } else {
        header('Location: ../files.php?error=');
        exit;
        //Fehler beim Upload
    }
}
