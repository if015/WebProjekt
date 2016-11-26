<?php
session_start();
include 'dbh.inc.php';


//$error = false;
$email = $_POST['email'];
$first = $_POST['first'];
$last = $_POST['last'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];


$pwdEnc = password_hash($pwd, PASSWORD_DEFAULT);
$dir = md5($email);

$statement = $conn->prepare("INSERT INTO users (email, first, last, pwd, dir) 
VALUES (:email, :first, :last, :pwd, :dir)");
$result = $statement->execute(array('email' => $email, 'first' => $first, 'last' => $last,
    'pwd' => $pwdEnc, 'dir' => $dir));

//Benutzerverzeichnis wird mit dem Hash der Email-Adresse wird erstellt
mkdir("../uploads/$dir", 0777, true);

if ($result) {
    //echo "Registrierung abgeschlossen";
    header('Location: ../index.php');
} else {
    echo 'Fehler: Beim Abspeichern';
}

// Fehlerhandling wieder einbauen!