<?php

/**
 * TODO (12/02/17):
 * - Neuer Name bereinigen
 */

session_start();
include 'functions.php';
$dir ='../uploads/' . $_SESSION['dir'] . '/';

$oldname = $_POST['pk'];
$newname = $_POST['value'];

if (isset($_POST['method'])) {
    $fileinfoOld = pathinfo($oldname);
    $newname = clearChar($newname);
    $fileinfoNew = pathinfo($newname);
    //var_dump($fileinfoOld);
    //var_dump($fileinfoNew);
    $newname = $fileinfoNew['filename'].".".$fileinfoOld['extension'];
    rename($dir.$oldname, $dir.$newname);
} else {
    rename($dir.$oldname, $dir.$newname);
}
header("location: ../files.php");

