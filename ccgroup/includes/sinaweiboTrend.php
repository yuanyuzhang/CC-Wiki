<?php
include '../conf.php';
function convertTime($t){
	$month=array(
			"Jan"=>1,
			"Feb"=>2,
			"Mar"=>3,
			"Apr"=>4,
			"May"=>5,
			"Jun"=>6,
			"Jul"=>7,
			"Aug"=>8,
			"Sep"=>9,
			"Oct"=>10,
			"Nov"=>11,
			"Dec"=>12     
			);
	$original=explode(" ", $t);
    $originalMonth=$original[1];
    $originalMonth=$month[$originalMonth];
    $originalDay=$original[2];
    $originalTime=$original[3];
    $originalYear=$original[5];
    $originalHMS=explode(":",  $originalTime);
    $originalHour=$originalHMS[0];
    $originalMinute=$originalHMS[1];
    $originalSecond=$originalHMS[2];
    $t=mktime($originalHour,$originalMinute,$originalSecond,$originalMonth,$originalDay,$originalYear);
	$t=date("c",$t);
    return $t;
	
}
//$access_token=$_REQUEST['access_token'];
$trend=$_REQUEST['trend'];
//$access_token="2.004DZvHCbgY9OBb4ab7991140KQLEL";
//$trend='baidu';
$url="https://api.weibo.com/2/trends/statuses.json?trend=".$trend."&access_token=".$access_token;
$ch = curl_init($url);//打开
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);//关闭
$contents=json_decode($response,true);
$doc=new DOMDocument('1.0', 'UTF-8');
$doc->formatOutput=true;
$root=$doc->createElement("statuses");
$doc->appendChild($root);
$i=1;
foreach ($contents['statuses']as $content){
	$status=$doc->createElement("status");
	$mid=$doc->createElement("mid");
	$text=$doc->createElement("text");
	$time=$doc->createElement("time");
	$name=$doc->createElement("name");
	$id=$doc->createElement("id");
	$image=$doc->createElement("image");
	$cate=$doc->createElement("cate");
	$page=$doc->createElement("page");
	$mid->appendChild($doc->createTextNode($content['mid']));
	$text->appendChild($doc->createTextNode($content['text']));
	$timeValue=$content['created_at'];
	$timeValue=convertTime($timeValue);
	$time->appendChild($doc->createTextNode($timeValue));
	$name->appendChild($doc->createTextNode($content['user']['name']));
	$id->appendChild($doc->createTextNode($content['user']['id']));
	$image->appendChild($doc->createTextNode($content['user']['profile_image_url']));
	$cate->appendChild($doc->createTextNode("sina"));
	$page->appendChild($doc->createTextNode($i));
	$i++;
	$status->appendChild($mid);
	$status->appendChild($text);
	$status->appendChild($time);
	$status->appendChild($name);
	$status->appendChild($id);
	$status->appendChild($image);
	$status->appendChild($cate);
	$status->appendChild($page);
	$root->appendChild($status);
}
echo $doc->saveXML();

?>