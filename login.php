<?php
session_start();
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-db118', 'db118', 'passwort');
if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $statement = $pdo->prepare("
            SELECT * FROM users WHERE email = :email
        ");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
    if ($user != false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['vorname'] = $user['vorname'];
        header('Location: main.php');
    } else {
        $errorMessage = "Fehler";
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Login</title>
</head>

<body>

<h1>Login</h1>

    <?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>
    
<form action="?login=1" method="post">
    E-Mail <input type="email" name="email" /><br/>
    Passwort <input type="password" name="password" /><br/>
    <input type="submit" value="Anmelden"/>
</form>
    
oder <a href="register.php" >Registrieren</a>

<div style="position: fixed; bottom: 0;">
    &copy; 2016
</div>
</body>
</html>
