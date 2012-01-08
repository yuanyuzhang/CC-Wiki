<?php
include('../conf.php');
$access_token=$_REQUEST['access_token'];
//$access_token="131061046_a3480f4766ba885236a0755a28ba43a4";
$fields="";
$url="https://api.kaixin001.com/friends/me.json?access_token=".$access_token."&fields=".$fields;
$ch = curl_init($url);//打开
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);//关闭
$contents=json_decode($response,true);
$doc=new DOMDocument('1.0', 'UTF-8');
$doc->formatOutput=true;
$root=$doc->createElement("friends");
$doc->appendChild($root);
foreach ($contents['users']as $content){
	$f=$doc->createElement("friend");
	$id=$doc->createElement("id");
	$name=$doc->createElement("name");
	$url=$doc->createElement("url");
	$cate=$doc->createElement("cate");
	$id->appendChild($doc->createTextNode($content['uid']));
	$name->appendChild($doc->createTextNode($content['name']));
	$url->appendChild($doc->createTextNode($content['logo50']));
	$cate->appendChild($doc->createTextNode("sina"));
	$f->appendChild($id);
	$f->appendChild($name);
	$f->appendChild($url);
	$f->appendChild($cate);
	$root->appendChild($f);
}
echo $doc->saveXML();

?>