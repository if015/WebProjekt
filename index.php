<?php

include 'header.php';


// Überprüfung ob ein User angemeldet ist, dann wird weitergeleitet auf files.php

if (isset($_SESSION['id'])) {
    header('Location: files.php');
}
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
                <a id="unicornbox" class="navbar-brand" href="files.php">

                    <!-- LOGO LOGO LOGO LOGO LOGO -->

                    <span class="icon-logo_svg logo"></span>

                    <!-- LOGO LOGO LOGO LOGO LOGO -->

                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- Anmeldeformular -->
                <form action="includes/login.inc.php" class="navbar-form navbar-right" method="post">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-Mail">
                        <input type="password" name="pwd" class="form-control" placeholder="Passwort">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-sign-in"></span> Anmelden</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<section>

    <div class="container">
        <?php
        if (!empty($_GET['error']) && $_GET['error'] == "wrongpwd") {
        $errormsg = "Das Passwort ist nicht korrekt";
        ?>
        <div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <?php echo $errormsg; } ?>
        </div>
    </div>


<div class="container">
   <div class="row">
       <div class="col-md-5">

           <!-- Hier Bild rein -->
            <img class="img-responsive" src="img/logo.png">

       </div>


    <div class="col-md-7">

    <div id="signup" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registrieren</h3>
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
            if (!empty($_GET['error']) && $_GET['error'] == "unvalidemail") {
                $errormsg = "Die eingegebene PE-Mail-Adresse ist nicht gültig!";
            }
            if (!empty($_GET['error']) && $_GET['error'] == "user") {
                $errormsg = "Die angegegebenene E-Mail-Adresse wurde bereits registriert. Bitte eine andere Adresse angeben.";
            }

                if (isset($errormsg) && $_GET['error'] != "wrongpwd") {
                    ?>

                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>


                        <?php echo $errormsg; ?> </div> <?php

                }

            if (!empty($_GET['success'])) {
                $successmsg = "Du hast dich erfolgreich registriert und kannst dich nun anmelden!";
                ?>

                <div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>


                    <?php echo $successmsg; ?> </div> <?php
            }
            ?>
            <form action="includes/register.inc.php" class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="first" class="col-sm-2 control-label">Vorname</label>
                    <div class="col-sm-10">
                        <input type="text" name="first" class="form-control" id="first" placeholder="Vorname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="last" class="col-sm-2 control-label">Nachname</label>
                    <div class="col-sm-10">
                        <input type="text" name="last" class="form-control" id="last" placeholder="Nachname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">E-Mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="E-Mail">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd" class="col-sm-2 control-label">Passwort</label>
                    <div class="col-sm-10">
                        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Passwort">
                        <input type="password" name="pwd2" class="form-control" placeholder="Passwort wiederholen">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="submit" class="btn btn-primary">Registrieren</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
   </div>


</div>
    <div class="container">
    <div class="jumbotron jumbocolor">
        <h3>SHARE EVERY COLOR OF YOUR LIFE!</h3>
        <p>Dateien immer und überall zugänglich. Einfach mit Freunden teilen und loslegen!</p>
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