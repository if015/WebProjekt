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
        //echo "Datei wurde &uuml;bertragen";
        header('location: main.php');
    } else {
        echo "Fehler.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="Datei" /><br />
    <input type="submit" value="Upload" />
</form>
<br />
<a href="main.php">Zurück</a>

<div style="position: fixed; bottom: 0;">
&copy; 2016
</div>
</body>
</html>
