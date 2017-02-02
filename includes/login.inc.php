<?php
session_start();
include 'dbh.inc.php';

$email = $_POST['email'];
$pwd = $_POST['pwd'];
$statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
$result = $statement->execute(array('email' => $email));
$user = $statement->fetch();

if ($user != false && password_verify($pwd, $user['pwd'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['first'] = $user['first'];
    $_SESSION['dir'] = $user['dir'];
    $_SESSION['size'] = $user['size'];
    header('Location: ../files.php');

}

else {
    echo "Fehler";
    //über GET auf index.php anzeigen!
}