<?php
include ( '../conf.php' );

session_start();
$page_name = $_SESSION['page_name'];

header( 'Location:http://'.$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Special:ConfigureWeibo?page_name=' .$page_name );
?>
