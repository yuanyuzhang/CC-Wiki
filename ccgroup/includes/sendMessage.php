<?php
require_once( '../conf.php');
$friend = $_GET["friends"];
$message = $_GET["message"];
$token = $_GET["token"];
$token_secret = $_GET["token_secret"];
$sns = $_GET["sns"];
$friends = $friend[0];
$res = '';
for($i=1;$i<count($friend);$i++){
	$friends .= ','.$friend[$i];
}
$tmpSite = 'http://' . $ccHost . ':' . $ccPort . '/' . $ccSite . '/extensions/ccgroup/includes/';
if($sns == "renren") {
	$url = $tmpSite. 'renrenMessage.php';
	$data = 'access_token=' .$token. '&notification=' .$message. '&to_ids=' .$friends;	
	$res = _curl_post($url, $data);
}
elseif($sns == "kaixin") {
	$url = $tmpSite . 'kaixinMessage.php';
	$data = 'access_token=' .$token. '&content=' .$message. '&fuids=' .$friends;
	$res = _curl_post($url, $data);
}
elseif($sns == "qq") {
	$url = $tmpSite. 'qqweiboMessage.php';
	$data = 'oauth_token=' .$token. '&oauth_token_secret=' .$token_secret. '&content=' .$message. '&id=' .$friends;
	$res = _curl_post($url, $data);
}
//echo 'yuanyuzhang'.$res;
header('Location:http://' . $ccHost . ':' . $ccPort . '/' . $ccSite. '/index.php/Main_Page');

function _curl_post($url, $vars) {
     $ch = curl_init();
     curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_URL,$url);
     curl_setopt($ch, CURLOPT_POST, 1 );
     curl_setopt($ch, CURLOPT_HEADER, 0 ) ;
     curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
     $data = curl_exec($ch);
     curl_close($ch);
     if ($data)
         return $data;
     else
         return false;
}

?>
