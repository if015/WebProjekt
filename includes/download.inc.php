<?php

session_start();

if ($_GET['dir'] == 'uploads/' . $_SESSION['dir'] . '/') {

if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) {
    $filename = $_GET['file'];
}

else {
    $filename = NULL;
}

if (!$filename) {
    //File nicht vorhanden.
}

else {

    $path = "../" . $_GET['dir'] . $filename;
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
}
else {
    //Keine Berechtigung zum Download
    echo "Keine Berechtigung!";
}