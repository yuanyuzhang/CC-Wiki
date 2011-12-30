<?php
require_once( '../conf.php');
$friends = $_GET["friends"];
$message = $_GET["message"];
$token = $_GET["token"];
$token_secret = $_GET["token_secret"];
$sns = $_GET["sns"];

$tmpSite = 'http://' . $ccHost . ':' . $ccPort . '/' . $ccSite . '/extensions/ccGroup/includes/';
if($sns == "renren") {
	$url = $tmpSite. 'renrenMsg.php?access_token=' .$token. '&notification=' .$message. '&to_ids=' .$friends;	
	header( 'Location:' .$url );
}
elseif($sns == "kaixin") {
	$url = $tmpSite . 'kaixinMsg.php?access_token=' .$token. '&content=' .$message. '&fuids=' .$friends;
	header( 'Location:'.$url );
}
elseif($sns == "qq") {
	$url = $tmpSite. 'qqweiboMessage/qqweiboMsg.php?oauth_token=' .$token. '&oauth_token_secret=' .$token_secret. '&content=' .$message. '&id=' .$friends;
	header( 'Location:'.$url );
}

?>
