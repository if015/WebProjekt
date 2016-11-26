<!DOCTYPE html>
<html lang="de">

<head>
    <title>Profileinstellungen</title>
</head>

<body>

<h1>Profileinstellungen</h1>

<form>
    <h2>Daten &auml;ndern</h2>
    Profilbild &auml;ndern <input type="file" /><br />
    E-Mail <input type="text" /><br />
    Vorname <input type="text" /><br />
    Nachname <input type="text" /><br />
    Neues Passwort <input type="password" /><br />
    Neues Passwort wiederholen <input type="password" /><br />
    <input type="submit" value="&Auml;ndern">
</form>

<div style="position: fixed; bottom: 0;">

    <!--
        Links zu den einzelnen Seiten
        Nur zur Übersicht
    -->

    Impressum<br />
    <h3>&Uuml;bersicht</h3>
    <ul style="list-style: none">
        <li><a href="includes/login.inc.php">Login</a></li>
        <li><a href="register_old.php">Registrieren</a></li>
        <li><a href="main.php">&Uuml;bersicht</a></li>
        <li><a href="settings.php">Profileinstellungen</a> </li>
        <li><a href="includes/upload.inc.php">Dateien hochladen</a> </li>
        <li><a href="share.php">Dateien teilen</a> </li>

    </ul>
</div>
</body>
</html>