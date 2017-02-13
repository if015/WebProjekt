<?php

/**
 * TODO (12/02/17):
 * - Überprüfung ob Download durch den Nutzer.
 * - Fehlerseite: Nicht zum Download berechtigt
 */

session_start();
if (isset($_GET['dir'])) {
    $dir = "../uploads/" . $_GET['dir'] . "/";
} else {
    $dir = "../uploads/" . $_SESSION['dir'] . "/";
}



if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) {
    $filename = $_GET['file'];
}

else {
    $filename = NULL;
}

if (!$filename) {
    //File nicht vorhanden.
}

//if (!isset($_SESSION['id'])) {
//    echo "Du bist nicht zum Dateidownload berechtigt!";
//}

else {

    $path = $dir . $filename;
    $mime = mime_content_type($path);
    $fsize = filesize($path);

    if (file_exists($path) && is_readable($path)) {
        header('Content-Type: '.$mime);
        header('Content-Length: '.$fsize);
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');

        //File öffnen in binary read-only-Modus
        $file = @ fopen($path, 'rb');

        if ($file) {
            // stream the file and exit the script when complete
            fpassthru($file);
            exit;
        } else {
            //Error
        }
    }
}


