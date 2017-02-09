
<html>
<head>
</head>
<body>
 

<?php
$alldata = scandir('files'); // ordner, wo bei mir dateien liegen
foreach ($alldata as $file) {
	$info = pathinfo('files'."/".$file); 
	
	if ($file != "." && $file != ".."  && $file != "_notes" && $info['basename'] != "Thumbs.db")  
 {
	$bildtypen= array("jpg", "jpeg", "gif", "png");
 	if(in_array($info['extension'],$bildtypen)){
 ?>
 
 <ul id= "galerie">
 <li>
             <div class="galerie">
                <a href="<?php echo $info['dirname']."/".$info['basename'];?>">
                <img src="<?php echo $info['dirname']."/".$info['basename'];?>" width="140" alt="Vorschau" /></a> 
                <span><?php echo $info['filename']; ?> </span>
            </div>
            </li>
 <?php 
 } else { ?>
 <li>
            <div class="document">
             <a href="<?php echo $info['dirname']."/".$info['basename'];?>">&raquo<?php echo $info['filename']; ?></a> (<?php echo $info['extension']; ?> 
            </div>
            <?php } ?>
            </li>
<?php
 };
 };
?>
 




</body>
</html>
