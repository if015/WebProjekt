<?php
session_start();
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-db118', 'db118', 'iad1jai1Ai');

$dirwert = $_SESSION['dir'];
$dir ='uploads/' . $dirwert . '/';


if (is_null($_SESSION['userid'])) {
    header("Location: login.inc.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Hauptseite</title>
</head>

<body>
<div style="text-align: right">
    <img src="#" height="64" width="64" />
    <h2>
        <?php
        echo $_SESSION['vorname'];
        ?>
    </h2>
    <ul style="list-style: none">
        <li><a href="#" >Profileinstellungen</a></li>
        <li><a href="includes/logout.inc.php" >Abmelden</a></li>
    </ul>
</div>

<h1>Meine Dateien</h1>

<ul style="list-style: none">
    <li><a href="#">Neuer Ordner</a></li>
    <li><a href="includes/upload.inc.php">Datei hochladen</a></li>
    <li><a href="#">Datei herunterladen</a></li>
    <li><a href="#">Datei umbenennen</a></li>
    <li><a href="share.php">Datei teilen</a></li>
</ul>

<div style="max-width: 960px; margin: auto; border: 1px solid #000;">
    <table style="width: 100%">
        <thead>
        <tr>
            <th>Datei</th>
            <th>Gr&ouml;&szlig;e</th>
            <th>Letzte &Auml;nderung</th>
        </tr>
        </thead>
        <tbody>

        <!--
            Anzeige der Dateien mittels scandir
            und Ausgabe als Tabelle
            mit Dateigröße in kb und letzter Änderung
         -->

        <?php

        // echo $dir; //zur Fehlersuche: Verzeichnis oder Datei nicht gefunden?! -> Fehler beseitigt.

        foreach (scandir($dir) as $file) {
            $fileinfo = pathinfo($dir."/".$file);
            $size = ceil(filesize($dir."/".$file)/1024) . "kb";
            $mdate = filemtime($dir."/".$file);
            if ($file != "." && $file != "..") {
                ?>
                <tr>
                    <td>
                        <a href="<?php echo $fileinfo['dirname'] . "/" . $fileinfo['basename']; ?>"><?php echo $fileinfo['basename']; ?></a>
                    </td>
                    <td>
                        <?php echo $size; ?>
                    </td>
                    <td>
                        <?php echo date("d.m.Y H:i", $mdate); ?>
                    </td>
                </tr
                <?php
            }
        };
        ?>
        </tbody>
    </table>
</div>

<div style="position: fixed; bottom: 0;">
&copy; 2016
</div>
</body>
</html>
