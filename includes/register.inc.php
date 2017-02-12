<?php

/**
 * TODO (12/02/17):
 * - Fehler beim Anlegen der der Ordner zurückgeben.
 *
 */

session_start();
include 'dbh.inc.php';

$email = $_POST['email'];
$first = $_POST['first'];
$last = $_POST['last'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];


// Nicht alle Felder ausgefüllt
if (empty($first) || empty($last) || empty($email) || empty($pwd) || empty($pwd2)) {
    header('Location: ../index.php?error=empty');
    exit();
}

// Passwort zu kurz
if (strlen($pwd) < 5) {
    header('Location: ../index.php?error=password1');
    exit();
}

// Passwörter nicht gleich
if ($pwd != $pwd2) {
    header('Location: ../index.php?error=password2');
    exit();
}

// Keine gültige EMail-Adresse
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../index.php?error=unvalidemail');
    exit();
}

// E-Mail-Adresse schon vergeben
$statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
$result = $statement->execute(array('email' => $email));
$user = $statement->fetch();

if($user !== false) {
    header('Location: ../index.php?error=user');
    exit();
}

else {

    $pwdEnc = password_hash($pwd, PASSWORD_DEFAULT);
    $dir = md5($email);

    $statement = $conn->prepare("INSERT INTO users (email, first, last, pwd, dir) 
                                 VALUES (:email, :first, :last, :pwd, :dir)");
    $result = $statement->execute(array('email' => $email, 'first' => $first, 'last' => $last,
                                        'pwd' => $pwdEnc, 'dir' => $dir));

    if ($result) {
        //Benutzerverzeichnis und Papierkorb werden mit dem Hash der Email-Adresse erstellt
        mkdir("../uploads/$dir", 0777, true);
        mkdir("../uploads/$dir/trash", 0777, true);

        header('Location: ../index.php?success=true');
        exit;
    } else {
        header('Location: ../index.php?error=');
        //Fehler beim Anlegen!!!
        exit;
    }
}

