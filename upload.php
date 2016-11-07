<!DOCTYPE html>
<html lang="de">

<head>
    <title>Upload</title>
</head>

<body>

<h1>Datei-Upload</h1>

<!--
    Upload einer Datei und Verschieben in Ordner "upload"
-->

<?php
if (isset($_FILES["Datei"])) {
    $startname = $_FILES["Datei"]["tmp_name"];
    $zielname = $_FILES["Datei"]["name"];
    $zielname = "upload/" . basename($zielname);
    if (@move_uploaded_file($startname, $zielname)) {
        echo "Datei wurde &uuml;bertragen";
    } else {
        echo "Fehler.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="Datei" /><br />
    <input type="submit" value="Upload" />
</form>

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