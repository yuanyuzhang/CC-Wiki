<?php
$access_token=$_REQUEST['access_token'];
//$access_token="174175|6.b1d8dd00ea6b7adc13b9c0044ed34053.2592000.1327212000-427985954";
$method="friends.getFriends";
$v="1.0";
$secret="06e01ffcaa304f32bd3fcaa709e35411";
$format="XML";
$content="access_token=".$access_token."format=".$format."method=".$method."v=".$v.$secret;
$sig=md5($content);
$post_data="access_token=".$access_token."&format=".$format."&method=".$method."&v=".$v."&sig=".$sig;
$url="http://api.renren.com/restserver.do";
$ch = curl_init();//打开
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
$response  = curl_exec($ch);
curl_close($ch);//关闭
//echo $response;
$input=new DOMDocument();
$doc=new DOMDocument('1.0','UTF-8');
$doc->formatOutput=true;
$root=$doc->createElement("friends");
$doc->appendChild($root);
$input->loadXML($response);
$friends=$input->getElementsByTagName("friend");
foreach ($friends as $friend){
	$f=$doc->createElement("friend");
	$id=$friend->getElementsByTagName("id");
	$name=$friend->getElementsByTagName("name");
	$url=$friend->getElementsByTagName("tinyurl");
	$idname=$doc->createElement("id");
	$namename=$doc->createElement("name");
	$urlname=$doc->createElement("url");
	$cate=$doc->createElement("cate");
	$idname->appendChild($doc->createTextNode($id->item(0)->nodeValue));
	$namename->appendChild($doc->createTextNode($name->item(0)->nodeValue));
	$urlname->appendChild($doc->createTextNode($url->item(0)->nodeValue));
	$cate->appendChild($doc->createTextNode("renren"));
	$f->appendChild($idname);
	$f->appendChild($namename);
	$f->appendChild($urlname);
	$f->appendChild($cate);
    $root->appendChild($f);
}
echo $doc->saveXML();


?>
