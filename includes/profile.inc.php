<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 02.02.17
 * Time: 13:01
 */
session_start();
include 'dbh.inc.php';
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$pwdold = $_POST['pwdold'];

$statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
$result = $statement->execute(array('id' => $_SESSION['id']));
$user = $statement->fetch();

// Passwort zu kurz
if (strlen($pwd) < 5) {
    header('Location: ../profile.php?error=password1');
    exit();
}
// Passwörter nicht gleich
if ($pwd != $pwd2) {
    header('Location: ../profile.php?error=password2');
    exit();
}



else if ($user != false && password_verify($pwdold, $user['pwd']))
{
    $pwdEnc = password_hash($pwd, PASSWORD_DEFAULT);

    if (isset($pwd)) {
        $statement = $conn->prepare("UPDATE users SET pwd = :pwd WHERE id = :id") ;
    }

    $result = $statement->execute(array('pwd' => $pwdEnc, 'id' => $_SESSION['id']));
    if ($result) {
        //echo "Passwort geändert";
        header('Location: ../profile.php?success=true');
    } else {
        echo 'Fehler: Beim Abspeichern';
    }
// Fehlerhandling wieder einbauen!
}
else
{
    header('Location: ../profile.php?error=pwdwrong');
}