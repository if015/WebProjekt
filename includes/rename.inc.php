<?php
session_start();
$dir ='../uploads/' . $_SESSION['dir'] . '/';

$oldname = $_POST['oldname'];
$newname = $_POST['newname'];

$newname = htmlspecialchars($newname);

//echo $oldname;
//echo $newname;

rename($dir.$oldname, $dir.$newname);

header("Location: ../files.php");