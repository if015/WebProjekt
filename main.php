<!DOCTYPE html>
<html lang="de">

<head>
    <title>Hauptseite</title>
</head>

<body>
<div style="text-align: right">
    <img src="#" height="64" width="64" />
    <h2>Vorname</h2>
    <ul style="list-style: none">
        <li><a href="settings.php" >Profileinstellungen</a></li>
        <li><a href="login.php" >Ambelden</a></li>
    </ul>
</div>

<h1>Meine Dateien</h1>

<ul style="list-style: none">
    <li><a href="#">Neuer Ordner</a></li>
    <li><a href="upload.php">Datei hochladen</a></li>
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
        foreach (scandir('./upload') as $file) {
            $fileinfo = pathinfo('./upload'."/".$file);
            $size = ceil(filesize('./upload'."/".$file)/1024) . "kb";
            $mdate = filemtime('./upload'."/".$file);
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

    <!--
        Links zu den einzelnen Seiten
        Nur zur Übersicht
    -->

    Impressum<br />
    <h3>&Uuml;bersicht</h3>
    <ul style="list-style: none">
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Registrieren</a></li>
        <li><a href="main.php">&Uuml;bersicht</a></li>
        <li><a href="settings.php">Profileinstellungen</a> </li>
        <li><a href="upload.php">Dateien hochladen</a> </li>
        <li><a href="share.php">Dateien teilen</a> </li>

    </ul>
</div>
</body>
</html>
