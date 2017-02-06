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
<!-- Menüleiste = Stylen -->
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
                    <li><a href="files.php">Dateien</a></li>
                    <li><a href="trash.php">Papierkorb</a></li>
                    <li class="active"><a href="#">Profil</a></li>
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

<!-- aus Registrierung   -->

<section>
<div class="container">

    <div id="signup" class="panel panel-primary">
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

                if (isset($errormsg)) {
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
</section>


<?php
// Profilbildupload

$upload_folder = 'upload/'; //Das Upload-Verzeichnis
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
if(!in_array($extension, $allowed_extensions)) {
    die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
}

//Überprüfung der Dateigröße
$max_size = 500*1024; //500 KB
if($_FILES['datei']['size'] > $max_size) {
    die("Bitte keine Dateien größer 500kb hochladen");
}

//Überprüfung dass das Bild keine Fehler enthält
if(function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
    if(!in_array($detected_type, $allowed_types)) {
        die("Nur der Upload von Bilddateien ist gestattet");
    }
}

//Pfad zum Upload
$new_path = $upload_folder.$filename.'.'.$extension;

//Neuer Dateiname falls die Datei bereits existiert
if(file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
    $id = 1;
    do {
        $new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
        $id++;
    } while(file_exists($new_path));
}

//Alles okay, verschiebe Datei an neuen Pfad
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';


//Profilbild anzeigen
$avatar = dbarray(dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$userdata['user_id']."'"));
if ($avatar['user_avatar'] != "") {
    echo "<img class='tip' src='".IMAGES."avatars/".$avatar['user_avatar']."' border='0' alt='".$avatar['user_name']."' title='".$avatar['user_name']."' style='max-height:50px; max-width:50px; border-radius: 4px;' />".$avatar['user_name'];
} else {
echo "<img class='tip' src='".IMAGES."avatars/noavatar50.png' border='0' alt='".$avatar['user_name']."' title='".$avatar['user_name']."' style='max-height:50px; max-width:50px;' />".$avatar['user_name'];


?>


