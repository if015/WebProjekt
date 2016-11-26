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
    <button>Abmelden</button>
</form>

<h1>Meine Dateien</h1>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Datei</th>
            <th>Größe</th>
            <th>Letzte Änderung</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    <?php

    //Anzeigen der Dateien

    foreach (scandir($dir) as $file) {
        $fileinfo = pathinfo($dir."/".$file);
        $size = ceil(filesize($dir."/".$file)/1024) . "kb";
        $mdate = filemtime($dir."/".$file);
        $mime = mime_content_type($fileinfo['dirname'] . "/" . $fileinfo['basename']);
        //$finfo = new finfo(FILEINFO_MIME, "share/file/magic");

        if ($file != '.' && $file != '..') {
            ?>

            <tr>

                <!-- noch ersetzen durch Bild:: Pfadname???
                     FALSCHE AUSGABE?! -->

                <td>
                    <?php //echo $mime; ?>
                </td>

                <td><a href="<?php echo $fileinfo['dirname'] . "/" . $fileinfo['basename']; ?>">
                        <span><?php echo $file; ?></span>
                    </a></td>
                <td><?php echo $size; ?></td>
                <td><?php echo date("d.m.Y H:i", $mdate); ?></td>
                <td>
                    <button>
                        <span id="<?php echo $fileinfo['dirname'] . "/" . $fileinfo['basename']; ?>"
                               class="unlink fa fa-trash">
                        </span>
                    </button>
                </td>
                <td>


                    <form action="./includes/rename.inc.php" method="post">
                        <input type="text" name="newname" placeholder="Neuer Name">
                        <button type="submit" name="oldname"
                                value="<?php echo $fileinfo['basename']; ?>">Umbenennen</button>
                    </form>
                </td>
                <td>
                    <form>
                        <button>Teilen</button>
                    </form>
                </td>
            </tr>

            <?php
        }
    }


    ?>
    </tbody>
</table>

<br><br><br>


<!-- Upload-Formular -->

<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file"><br>
    <button type="submit">Upload</button>
</form>

</body>

</html>
