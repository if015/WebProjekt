<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 06.02.17
 * Time: 21:11
 */

/**
 * TODO (12/02/17):
 * - funktioniert noch nicht, Ich schaue drüber - Daniel
 */
session_start();

$email = $_SESSION['email'];
$recipient = $_POST['recipient'];
$file = basename($_POST['file']);
$dir = $_SESSION['dir'];


$subject = $_SESSION['first'] . " hat eine Datei mit dir geteilt.";

$mailtext = '<html>
<head>
<title>Geteilte Datei</title>
</head>
 
<body>
<p>
' . $_SESSION['first'] . ' hat die Datei ' . $file . ' mit dir geteilt
</p>
<p>
Du kannst sie <a href="https://mars.iuk.hdm-stuttgart.de/~db118/webprojekt/includes/download.inc.php?file='.$file.'&dir='.$dir.'">hier</a> herunterladen.
</p> 
</body>
</html>
';

$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";


$header .= "From: $email\r\n";
$header .= "Reply-To: $email\r\n";

$header .= "X-Mailer: PHP ". phpversion();

mail( $recipient,
    $subject,
    $mailtext,
    $header);

//echo "Mail wurde gesendet!";

header('location: ../files.php');
?>
