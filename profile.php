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

?>

    <body  id="hintergrundfarbe">
<!-- Menüleiste = Stylen -->
<header>
    <nav class="navbar navbar-default navbar-fixed-top hintergrund">
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
                    <li><a href="trash.php">Papierkorb</a></li>
                    <li class="active"><a href="profile.php">Profil</a></li>
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
            </div>

<div class="col-md-10">
        <div id="changePwd" class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Dein Passwort ändern</h3>
            </div>
            <div class="panel-body">

                <?php
                if (!empty($_GET['error']) && $_GET['error'] == "empty") {
                    $errormsg = "Bitte überprüfe deine Angaben. Es müssen alle Felder ausgefüllt sein!";
                }
                if (!empty($_GET['error']) && $_GET['error'] == "password1") {
                    $errormsg = "Das angegebene Passwort ist zu kurz. Bitte gib ein Passwort mit mindestens 5 Zeichen ein!";
                }
                if (!empty($_GET['error']) && $_GET['error'] == "password2") {
                    $errormsg = "Die eingegebene Passwörter stimmen nicht überein!";
                }
                if (!empty($_GET['error']) && $_GET['error'] == "pwdwrong") {
                    $errormsg = "Dein altes Passwort ist nicht korrekt. Die Änderung konnte nicht übernommen werden";
                }

                if (isset($errormsg)) {
                    ?>

                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>


                        <?php echo $errormsg; ?> </div> <?php

                }

                if (!empty($_GET['success'])) {
                    $successmsg = "Dein Passwort wurde erfolgreich geändert!";
                    ?>

                    <div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>


                        <?php echo $successmsg; ?> </div> <?php
                }
                ?>
                <form action="includes/profile.inc.php" class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="pwd" class="col-sm-2 control-label">Neues Passwort</label>
                        <div class="col-sm-10">
                            <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Neues Passwort">
                            <input type="password" name="pwd2" class="form-control" placeholder="Neues Passwort wiederholen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwdold" class="col-sm-2 control-label">Passwort</label>
                        <div class="col-sm-10">
                            <input type="password" name="pwdold" class="form-control" id="pwdold" placeholder="Altes Passwort">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary">Änderungen übernehmen</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div id="avatar" class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Profilbild hochladen oder ändern</h3>
            </div>
            <div class="panel-body">
                <!-- Avatar Upload über dropzone, noch nicht erstellt -->
                <form action="includes/avatar.inc.php"
                      class="dropzone"
                      id="avatarDropzone">
                </form>
            </div>
        </div>

        </div>
    </div>
    </div>

</section>


<footer id="footer" class="container-fluid navbar-fixed-bottom text-center">
    <a href="#unicornbox" title="To Top">
        <span class="fa fa-arrow-up"></span></a>
    <a href="#">Hilfe</a>
    <a href="#">Datenschutz</a>
    <a href="#">Impressum</a>
    <a href="#">Kontakt</a>
</footer>


?>
