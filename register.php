<?php
session_start();
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-db118', 'db118', 'password');

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Registrieren</title>
</head>

<body>

    <?php
$showForm = true;
if (isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
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
        $statement = $pdo->prepare("
            INSERT INTO users (email, vorname, nachname, password) VALUES (:email, :vorname, :nachname, :password)
        ");
        $result = $statement->execute(array('email' => $email, 'vorname' => $vorname, 'nachname' => $nachname, 'password' => $password_hash));
        if ($result) {
            echo "Registrierung abgeschlossen";
            $showForm = false;
            header('Location: login.php');
        } else {
            echo 'Fehler: Beim Abspeichern';
        }
    }
}

?>    
<h1>Registrieren</h1>
<?php
if ($showForm) {
    ?>

    <form action="?register=1" method="post">
        E-Mail <input type="text" name="email"/><br/>
        Vorname <input type="text" name="vorname"/><br/>
        Nachname <input type="text" name="nachname"/><br/>
        Passwort <input type="password" name="password"/><br/>
        Passwort wiederholen <input type="password" name="password2"/><br/>
        <input type="submit" value="Registrieren"> 
    </form>

    <?php
}
?>

<div style="position: fixed; bottom: 0;">
&copy; 2016
</div>
</body>
</html>
