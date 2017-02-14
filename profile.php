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

    <body>
<!-- Menüleiste = Stylen -->
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

                <?php if (empty(glob("avatar/".$_SESSION['dir'].".*"))) { ?>
                    <img class="img-rounded img-responsive center-block" src="avatar/default.png">
                <?php } else { ?>
                    <img class="img-rounded img-responsive center-block" src="<?php echo 'avatar/'.$_SESSION['dir']; ?>">
                <?php } ?>

                <h4 class="text-uppercase text-center"><?php echo $_SESSION['first']?></h4>
            </div>

<div class="col-md-10">
        <div id="changePwd" class="panel panel-default">
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

        <div id="avatar" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Profilbild

                    <?php if (empty(glob("avatar/".$_SESSION['dir'].".*"))) {
                        echo "hochladen";
                    } else {
                        echo "ändern";
                        echo " <a href='includes/delAvatar.inc.php'>(löschen)</a>";
                    }
                    ?>

                </h3>
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