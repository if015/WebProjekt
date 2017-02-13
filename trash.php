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

$dir ='uploads/' . $_SESSION['dir'] . '/trash/';
?>

<body  id="hintergrundfarbe">

<header>
    <nav class="navbar navbar-default hintergrund">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navigation einblenden</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="unicornbox" class="navbar-brand" href="index.php">

                    <!-- LOGO LOGO LOGO LOGO LOGO -->

                    <img src="einhorn.svg"  />

                    <!-- LOGO LOGO LOGO LOGO LOGO -->

                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="files.php">Dateien</a></li>
                    <li class="active"><a href="trash.php">Papierkorb</a></li>
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

                <img class="img-rounded img-responsive center-block" src="<?php echo "avatar/".$_SESSION['dir']; ?>">
                <h4 class="text-uppercase text-center"><?php echo $_SESSION['first']?></h4>
                <form action="includes/unlinkall.inc.php">
                    <button type="submit" class="btn btn-primary btn-lg center-block">
                        <span class="fa fa-minus "> entleeren</span>
                    </button>
                </form>



            </div>

            <div class="col-md-10">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Meine gelöschten Dateien</h3>
            </div>

            <table id="userfiles" class="table">
                <thead>
                <tr>
                    <th></th>
                    <th align="left">Datei</th>
                    <th align="left">Größe</th>
                    <th align="left">gelöscht</th>
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
                    $fileinfo = pathinfo($file);

                    //Dateigröße in kb
                    $size = ceil(filesize($path)/1024) . " kb";

                    $sizeadd += $size;
                    $cdate = filectime($path);


                    if (!is_dir($path)) {
                        ?>

                        <tr>
                            <td><?php showMime($path)?></td>
                            <td class="filename">
                                <span><?php echo $file; ?></span>
                            </td>
                            <td><?php echo $size; ?></td>
                            <td><?php echo date("d.m.Y H:i", $cdate); ?></td>
                            <td>

                                <button class="btn btn-link">
                                    <span id="<?php echo $file; ?>"
                                          class="undo fa fa-undo">
                                    </span>
                                </button>

                                <button class="btn btn-link">
                                    <span id="<?php echo $fileinfo['basename']; ?>"
                                          class="unlink fa fa-trash">
                                    </span>
                                </button>
                            </td>
                        </tr>

                        <!-- Dateien werden nach sieben Tagen automatisch gelöscht -->

                        <?php
                        //if (time() < ($cdate + (7*24*60*60))) {
                        //    unlink($path);
                        //}
                    }
                }
                ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>

<footer id="footer" class="container-fluid text-center">
    <a href="#unicornbox" title="To Top">
        <span class="fa fa-arrow-up"></span></a>
    <div class="container">
        <a href="#">Hilfe</a>
        <a href="#">Datenschutz</a>
        <a href="#">Impressum</a>
        <a href="#">Kontakt</a>
    </div>
</footer>
</body>

