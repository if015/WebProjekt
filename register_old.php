<?php

include 'dbh.inc.php';


//$error = false;
$email = $_POST['email'];
$first = $_POST['vorname'];
$last = $_POST['nachname'];
$password = $_POST['password'];
$password2 = $_POST['password2'];



/* Überprüfung ob eine gültige E-Mail-Adresse angegeben wurde */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Fehler: Keine gültige E-Mail-Adresse!';
    $error = true;
}
/* Überprüfung ob ein Passwort angegeben wurde */
if (strlen($password) == 0) {
    echo 'Fehler: kein Passwort angegeben';
    $error = true;
}
/* Überprüfung ob Passwörter gleich sind */
if ($password != $password2) {
    echo 'Fehler: Passwörter sind nicht identisch';
    $error = true;
}
/* Prüfung, ob E-Mail schon registriert ist */
if (!$error) {
    $statement = $pdo->prepare("
          SELECT * FROM users WHERE email = :email
      ");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
    if ($user !== false) {
        echo 'Fehler: E-Mail wurde schon vergeben';
        $error = true;
    }
}

/* keine Fehler, Nutzer kann registriert werden */
if (!$error) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $directory = md5($email);
    $statement = $pdo->prepare("
           INSERT INTO users (email, vorname, nachname, password, directory) 
           VALUES (:email, :vorname, :nachname, :password, :directory)
       ");
    $result = $statement->execute(array('email' => $email, 'vorname' => $vorname, 'nachname' => $nachname,
        'password' => $password_hash, 'directory' => $directory));
    //Benutzerverzeichnis wird mit dem Hash der Email-Adresse wird erstellt
    mkdir("uploads/$directory", 777, true);

    if ($result) {
            echo "Registrierung abgeschlossen";
            $showForm = false;
            header('Location: login.inc.php');
        } else {
            echo 'Fehler: Beim Abspeichern';
        }
    }
}


