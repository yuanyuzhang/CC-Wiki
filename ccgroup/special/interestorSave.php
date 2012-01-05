<?php
include ( '../conf.php' );
include ( '../includes/upload_image.php' );

$page_name = $_POST['page_name'];
$name = $_POST['name'];
$email = $_POST['email'];
$photo = $_FILES['photo'];

$photoName = upload_image($photo);

//write into DB
$con = mysql_connect( $ccDB, $ccDBUsername, $ccDBPassword );
if(!$con){
	die('Could not connect: '.mysql_error()); 
}
mysql_select_db( $ccDBName, $con );
mysql_query( 'insert into ' .$cc_interestor. ' (page_name, name, photo, email) values ("'.$page_name.'", "'.$name.'", "'.$photoName.'", "'.$email.'")' );
mysql_close( $con );

header('Location:http://' .$ccHost. ':' .$ccPort.'/' .$ccSite.'/index.php');
?>


