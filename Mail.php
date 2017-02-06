<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 06.02.17
 * Time: 21:11
 */

$mailtext = '<html>
<head>
    <title>Folgende Datei wurde mit dir geteilt:</title>
</head>
 
<body>
 
<h1>includes/download.inc.php?file=<?php echo $file ?>&dir=<?php echo $dir ?></h1>
 
 
</body>
</html>
';

$empfaenger = "du@testkarnickel.de"; //Mailadresse
$absender   = "ich@testkarnickel.de";
$betreff    = "Mail-Test - HTML-E-Mail mit PHP erstellen";
$antwortan  = "ICH@testkarnickel.de";

$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";

$header .= "From: $absender\r\n";
$header .= "Reply-To: $antwortan\r\n";
// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
$header .= "X-Mailer: PHP ". phpversion();

mail( $empfaenger,
    $betreff,
    $mailtext,
    $header);

echo "Mail wurde gesendet!";
?>