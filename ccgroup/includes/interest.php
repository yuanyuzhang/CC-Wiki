<?php
include ( '../conf.php' );

session_start();
$page_name = $_SESSION['page_name'];
$gbTitle = $_SESSION['gbTitle'];
$gbImg = $_SESSION['gbImg'];

header( 'Location:http://'.$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Special:Interest?page_name=' .$page_name. '&gbTitle=' .$gbTitle. '&gbImg=' .$gbImg );
?>
