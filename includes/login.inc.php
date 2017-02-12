<?php
/**
 * TODO (12/02/17):
 * - SQL-Injection verhindern.
 * - Fehler übergeben bei falschem Passwort.
 * - SESSION-Variablen überprüfen.
 * - Passwort nicht mehr in SESSION speichern
 */

session_start();
include 'dbh.inc.php';

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
$result = $statement->execute(array('email' => $email));
$user = $statement->fetch();


if ($user != false && password_verify($pwd, $user['pwd'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['first'] = $user['first'];
    $_SESSION['dir'] = $user['dir'];
    $_SESSION['size'] = $user['size'];
    //$_SESSION['pwd'] = $user['pwd']; //über SQL auslesen!
    header('location: ../files.php');

}

else {
    header('location: ../index.php?error=wrongpwd');
    //echo "Fehler";
    //über GET auf index.php anzeigen!
}

