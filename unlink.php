<?php

session_start();
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-db118', 'db118', 'iad1jai1Ai');

$dirwert = $_SESSION['dir'];
$dir ='uploads/' . $dirwert . '/';

echo 'login: '.$dirwert;
$filepath = $_POST['id'];
$filename = $dir.'install.log';

echo $filepath;

// Delete File @ Symbol damit keine PHP Warnung angezeigt wird
if (unlink($filepath)) {
echo 'File <strong>' .$filepath .'has been deleted.';
    }   else {
    echo $filepath;
    echo 'File cannot be deleted.';
    }
