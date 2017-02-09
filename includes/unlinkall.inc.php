<?php
session_start();

$dir = "../uploads/".$_SESSION['dir']."/trash/";

foreach (scandir($dir) as $file) {
    if (!is_dir($file)) {
        unlink($dir.$file);
    }
}

header("Location: ../files.php");
