<?php

include 'header.php';


// Überprüfung ob ein User angemeldet ist, dann wird weitergeleitet auf files.php

if (isset($_SESSION['id'])) {
    header('Location: files.php');
}
?>

<body>

<!-- Anmeldeformular -->

<form action="includes/login.inc.php" method="post">
    <input type="text" name="email" placeholder="E-Mail">
    <input type="password" name="pwd" placeholder="Passwort">
    <button type="submit">Anmelden</button>
</form>

<br><br><br><br><br>

<!-- Registrierungsformular -->

<!--
<form action="includes/register.inc.php" method="post">
    <input type="text" name="email" placeholder="E-Mail"><br>
    <input type="text" name="first" placeholder="Vorname"><br>
    <input type="text" name="last" placeholder="Nachname"><br>
    <input type="password" name="pwd" placeholder="Passwort"><br>
    <input type="password" name="pwd2" placeholder="Passwort wiederholen"><br/>
    <button type="submit">Registrieren</button>
</form>
-->
</body>
</html>