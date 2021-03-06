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
    <nav id="unicornbox" class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navigation einblenden</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="files.php">
                    <span class="icon-logo_svg logo"></span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="files.php">Dateien</a></li>
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
        <div class="row">
            <div class="col-md-2">

                <?php if (empty(glob("avatar/".$_SESSION['dir'].".*"))) { ?>
                    <img class="img-rounded img-responsive center-block" src="avatar/default.png">
                <?php } else { ?>
                    <img class="img-rounded img-responsive center-block" src="<?php echo 'avatar/'.$_SESSION['dir']; ?>">
                <?php } ?>

                <h4 class="text-uppercase text-center"><?php echo $_SESSION['first']?></h4>

                <button type="button" class="btn btn-primary btn-lg center-block" data-toggle="modal" data-target="#uploadModal">
                    <span class="fa fa-upload"> Upload</span>
                </button>


            </div>

            <div class="col-md-10">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Meine Dateien</h3>
            </div>

            <div class="panel-body">

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
                     */

                    foreach (scandir($dir) as $file) {

                    $path = $dir . $file;                       //Pfad zur Datei
                    $fileinfo = pathinfo($path);
                    $size = ceil(filesize($path)/1024) . " kb"; //Dateigröße
                    $sizeadd += $size;                          //Dateigröße akkumuliert
                    $mdate = filemtime($path);                  //Zeitpunkt der letzten Bearbeitung

                    /*
                     * Überprüfung, ob Datei kein Verzeichnis ist.
                     */

                    $imgMime = ["image/gif", "image/jpeg", "image/png"];

                    if (!is_dir($path)) {
                    ?>

                        <tr>
                            <td>
                                <!-- Bestimmung und Anzeige des Mime-Types -->
                                <?php showMime($path)?>
                            </td>
                            <td class="filename">

                                <!-- DOWNLOADLINK -->
                                <a id="name"
                                   class="publicname-change"
                                   data-name="<?php echo $file; ?>"
                                   data-pk="<?php echo $file; ?>"
                                   data-type="text"
                                   href="

                                   <?php
                                   //if (in_array(mime_content_type($path), $imgMime)) {
                                   //    echo $path."\" data-toggle=\"modal\" data-target=\"#imageModal\">";
                                   //} else {
                                       echo "includes/download.inc.php?file=".$file."\"";
                                   //}
                                   ?>

                                    <span><?php echo $file; ?></span>
                                </a>

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

                                <!--
                                <form action = "includes/mail.inc.php">
                                    <button type="submit" class="btn btn-link">
                                        <span class="fa fa-share"></span><form action = "includes/mail.inc.php">
                                    </button>
                                </form>
                                -->

                                <button id="<?php echo $path; ?>" class="share btn btn-link" data-toggle="modal"
                                        data-target="#shareModal" id="<?php echo $file?>">
                                    <span class="fa fa-share"></span>
                                </button>

                                <!--
                                <button class="btn btn-link">
                                    <span class="fa fa-share"></span>
                                </button>
                                -->
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
        </div>
    </div>


    <!-- Fileupload in einem Modal -->

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="Upload">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload</h4>
                </div>
                <div class="modal-body">
                    <form action="includes/upload.inc.php"
                          class="dropzone"
                          id="awesomeDropzone">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Dateilink über E-Mail versenden -->

    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="Datei teilen...">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Datei teilen</h4>
                </div>
                <div class="modal-body form-horizontal">
                    <form action="includes/mail.inc.php" method="post">
                        <input id="file" name="file" type="hidden" value="">

                        <div class="form-group">
                            <label for="recipient" class="col-sm-2 control-label">an E-Mail senden</label>
                            <div class="col-sm-10">
                                <input id="recipient" type="text" name="recipient" class="form-control" placeholder="E-Mail-Adresse">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-send">Datei über E-Mail teilen</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        <div class="container">
            <h5>
                <span class="fa fa-hdd-o"></span>
                <?php
                $sizeaddMB = $sizeadd/1024;
                $sizeaddPercent = $sizeadd/$_SESSION['size']*100;
                echo "Verfügbarer Speicherplatz: " . number_format(($_SESSION['size']-$sizeadd)/1024, 2, ',', '.') .
                    " MB von " . number_format(($_SESSION['size'])/1024, 2, ',', '.') . " MB" ;
                ?>
            </h5>

            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $sizeadd; ?>" aria-valuemin="0"
                     aria-valuemax="<?php echo $_SESSION['size']; ?>" style="width: <?php echo $sizeaddPercent; ?>%">
                    <span class="sr-only">60% Complete</span>
                </div>
            </div>
        </div>

</section>

<footer class="container-fluid text-center">
    <a href="#unicornbox" title="To Top">
        <span class="fa fa-arrow-up"></span>
    </a>
    <p>
        <a href="#">Hilfe</a>
        <a href="#">Datenschutz</a>
        <a href="#">Impressum</a>
        <a href="#">Kontakt</a>
    </p>
</footer>
</body>

</html>

<?php

/**
 * TODO (12/02/17):
 * - Teilen-Funktion
 * -
 */

?>