<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=web_projekt', 'root', '1234');

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

    <!--
        Links zu den einzelnen Seiten
        Nur zur Übersicht
    -->

    Impressum<br />
    <h3>&Uuml;bersicht</h3>
    <ul style="list-style: none">

        <!--
            Links zu den einzelnen Seiten
            Nur zur Übersicht
        -->

        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Registrieren</a></li>
        <li><a href="main.php">&Uuml;bersicht</a></li>
        <li><a href="settings.php">Profileinstellungen</a> </li>
        <li><a href="upload.php">Dateien hochladen</a> </li>
        <li><a href="share.php">Dateien teilen</a> </li>

    </ul>
</div>
</body>
</html>
