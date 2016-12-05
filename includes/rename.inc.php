<?php
session_start();
$dir ='../uploads/' . $_SESSION['dir'] . '/';

$oldname = $_POST['pk'];
$newname = $_POST['value'];

//echo $oldname;
//echo $newname;

rename($dir.$oldname, $dir.$newname);

//header("Location: ../files.php");