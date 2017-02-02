<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 02.02.17
 * Time: 13:01
 */

session_start();
include 'dbh.inc.php';


$error = false;
$email = $_POST['email'];
$first = $_POST['first'];
$last = $_POST['last'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$opwd = $_POST['opwd'];


// Nicht alle Felder ausgefüllz
if (empty($first) || empty($last) || empty($email) || empty($pwd) || empty($pwd2)) {
    header('Location: ../index.php?error=empty');
    exit();
}

// Passwort zu kurz
if (strlen($pwd) <= 5) {
    header('Location: ../index.php?error=password1');
    exit();
}

// Passwörter nicht gleich
if ($pwd != $pwd2) {
    header('Location: ../index.php?error=password2');
    exit();
}



// E-Mail-Adresse schon vergeben
$statement = $conn->prepare(" * FROM users WHERE email = :email");
$result = $statement->execute(array('email' => $email));




else {


    $pwdEnc = password_hash($pwd, PASSWORD_DEFAULT);
    $dir = md5($email);

    $statement = $conn->prepare("INSERT INTO users (email, first, last, pwd, dir) 
VALUES (:email, :first, :last, :pwd, :dir)");
    $result = $statement->execute(array('email' => $email, 'first' => $first, 'last' => $last,
        'pwd' => $pwdEnc, 'dir' => $dir));

//Benutzerverzeichnis wird mit dem Hash der Email-Adresse erstellt
    mkdir("../uploads/$dir", 0777, true);

    if ($result) {
        //echo "Registrierung abgeschlossen";
        header('Location: ../index.php?success=true');
    } else {
        echo 'Fehler: Beim Abspeichern';
    }

// Fehlerhandling wieder einbauen!
}