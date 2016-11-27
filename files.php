<?php

include 'header.php';


//Überprüfung ob kein User angemeldet ist, dann wir zurückgeleitet auf index.php
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
}
$dir ='uploads/' . $_SESSION['dir'] . '/';
?>

<body>

<form action="includes/logout.inc.php">
    <button class="btn btn-default btn-lg">Abmelden</button>
</form>

<h1>Meine Dateien</h1>

<table class="table">
    <thead>
    <tr>
        <th></th>
        <th align="left">Datei</th>
        <th align="left">Größe</th>
        <th align="left">Letzte Änderung</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    //Anzeigen der Dateien
    foreach (scandir($dir) as $file) {
        $fileinfo = pathinfo($dir."/".$file);
        $size = ceil(filesize($dir."/".$file)/1024) . "kb";
        $sizeadd += $size;
        $mdate = filemtime($dir."/".$file);
        $mime = mime_content_type($fileinfo['dirname'] . "/" . $fileinfo['basename']);
        //$finfo = new finfo(FILEINFO_MIME, "share/file/magic");
        if ($file != '.' && $file != '..') {
            ?>

            <tr>

                <!-- noch ersetzen durch Bild:: Pfadname??? >> siehe includes/mimetype.inc.php
                     FALSCHE AUSGABE?! >> geht mit mime_content_type-->

                <td>
                    <?php include 'includes/mimetype.inc.php'?>
                </td>

                <td><a href="<?php echo $fileinfo['dirname'] . "/" . $fileinfo['basename']; ?>">
                        <span><?php echo $file; ?></span>
                    </a></td>
                <td><?php echo $size; ?></td>
                <td><?php echo date("d.m.Y H:i", $mdate); ?></td>
                <td>
                    <div class="btn-group" role="group">
                    <button class="btn btn-link">
                        <span id="<?php echo $fileinfo['dirname'] . "/" . $fileinfo['basename']; ?>"
                              class="unlink fa fa-trash">
                        </span>
                    </button>
                    <button class="btn btn-link">
                        <span class="fa fa-edit"></span>
                    </button>
                    <button class="btn btn-link">
                        <span class="fa fa-share"></span>
                    </button>
                    </div>
                </td>
            </tr>

            <?php
        }
    }
    ?>
    </tbody>
</table>

<br><br><br>

<h2>Freier Speicherplatz</h2>

<h3>Verfügbarer Spreicherplatz</h3>
<?php
echo $_SESSION['size']/1024 .' MB';
?>
<h3>Belegter Speicherplatz</h3>
<?php
$sizeaddMB = (int)($sizeadd/1024);
echo $sizeaddMB .' MB';
?>

<br><br><br>


<!-- Upload-Formular -->

<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file"><br>
    <button type="submit">Upload</button>
</form>

<!-- Namen einer Datei ändern. Funktionert, ist aber nicht schön. Ich suche bessere Alternativen
     funktioniert nur in der foreach Schleife!

     <form action="./includes/rename.inc.php" method="post">
                        <input type="text" name="newname" placeholder="Neuer Name">
                        <button type="submit" name="oldname"
                                value="<?php //echo $fileinfo['basename']; ?>">Umbenennen</button>
                    </form>
-->
</body>

</html>