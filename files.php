<html>
<?php

include 'header.php';
include 'includes/functions.php';

/*
 *  Es wird überprüft, ob ein Nutzer angemeldet ist. Ist dies nicht
 *  der Fall, wird umgeleitet auf index.php.
 */
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
}
/*
 *  Variable $dir beinhaltet den Pfad zum Upload-Ordner, abhängig
 *  vom jeweiligen Nutzer.
 *
 */
$dir ='uploads/' . $_SESSION['dir'] . '/';
?>

<body>

<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navigation einblenden</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <span class="fa fa-bomb"></span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Dateien</a></li>
                    <li><a href="trash.php">Papierkorb</a></li>
                    <li><a href="profile.php">Profil</a></li>
                </ul>
                <form action="includes/logout.inc.php" class="navbar-form navbar-right">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-sign-out"></span> Abmelden
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Meine Dateien</h3>
            </div>

            <table id="userfiles" class="table">
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
/*
 * Anzeigen der Dateien über eine foreach-Schleife und scandir($dir)
 *
 * AUFGABEN:
 *    - Umschreiben als Funktion (extern)
 *       - MIME-Type (X)
 *       - Downloadlink (X)
 *
 */
    foreach (scandir($dir) as $file) {

        //Pfad zur Datei
        $path = $dir . $file;

        //Dateigröße in kb
        $size = ceil(filesize($path)/1024) . " kb";

        $sizeadd += $size;
        $mdate = filemtime($path);

        //if ($file != '.' && $file != '..' || !is_dir($file)) {
        if (!is_dir($path)) {
            ?>

            <tr>
                <td><?php showMime($path)?></td>
                <td class="filename">

                    <!-- DOWNLOADLINK -->
                    <span>
                    <a id="name"
                       class="publicname-change"
                       data-name="<?php echo $file; ?>"
                       data-pk="<?php echo $file; ?>"
                       data-type="text"
                       href="includes/download.inc.php?file=<?php echo $file ?>&dir=<?php echo $dir ?>">
                        <span><?php echo $file; ?></span>
                    </a>
                    </span>

                </td>
                <td><?php echo $size; ?></td>
                <td><?php echo date("d.m.Y H:i", $mdate); ?></td>
                <td>
                        <button class="btn btn-link">
                            <span id="<?php echo $file; ?>"
                                class="movetotrash fa fa-trash">
                            </span>
                        </button>
                        <button class="edit btn btn-link">
                            <span class="fa fa-edit"></span>

                        </button>
                        <button class="btn btn-link">
                            <span class="fa fa-share"></span>
                        </button>
                </td>
            </tr>

            <?php
        }
    }
    ?>
    </tbody>
</table>
</div>
    </div>
</section>

<br><br><br>

<!-- Anzeige des freien Speicherplatzes

     AUFGABE:
     - Grafische Darstellung
     - Überprüfung einbauen in Dateiupload, ob genügend Speicher
       vorhanden ist.

     -->

<h3>Freier Speicherplatz</h3>

<?php
$sizeaddMB = $sizeadd/1024;
echo 'Es sind ' . number_format($sizeaddMB, 2, ',', '.') . ' MB ' . 'von ' . $_SESSION['size']/1024 .' MB belegt';
?>

<br><br><br>


<!-- Upload-Formular

     AUFGABE:
     - Auslagern? Modal?
     - Drag and Drop.
-->


<!--form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file"><br>
    <button type="submit">Upload</button>
</form-->

    <form enctype="multipart/form-data" id="yourregularuploadformId">
     <input type="file" name="files[]" multiple="multiple">
</form>
    
<footer>
    <!-- Footer einfügen
         z.B. Links: FAQ, Impressum, Hilfe-->
</footer>
</body>

</html>

<!--
    ZUSATZFUNKTIONEN?
    - Papierkorb
    - Bilderanzeige

-->
