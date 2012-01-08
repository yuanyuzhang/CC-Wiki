<?php
require_once( '../conf.php');
$friend = $_GET["friends"];
$message = $_GET["message"];
$token = $_GET["token"];
$token_secret = $_GET["token_secret"];
$sns = $_GET["sns"];
$friends = $friend[0];
for($i=1;$i<count($friend);$i++){
	$friends .= ','.$friend[$i];
}
$tmpSite = 'http://' . $ccHost . ':' . $ccPort . '/' . $ccSite . '/extensions/ccgroup/includes/';
if($sns == "renren") {
	$url = $tmpSite. 'renrenMessage.php?access_token=' .$token. '&notification=' .$message. '&to_ids=' .$friends;	
	header( 'Location:' .$url );
}
elseif($sns == "kaixin") {
	$url = $tmpSite . 'kaixinMessage.php?access_token=' .$token. '&content=' .$message. '&fuids=' .$friends;
	header( 'Location:'.$url );
}
elseif($sns == "qq") {
	$url = $tmpSite. 'qqweiboMessage.php?oauth_token=' .$token. '&oauth_token_secret=' .$token_secret. '&content=' .$message. '&id=' .$friends;
	header( 'Location:'.$url );
}

?>
