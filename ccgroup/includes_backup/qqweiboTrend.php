<?php
$httext=$_REQUEST['httext'];
//$httext='baidu';
$format='json';
$url="http://open.t.qq.com/api/statuses/ht_timeline?format=".$format."&httext=".$httext;
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
foreach ($contents['data']['info']as $content){
	$status=$doc->createElement("status");
	$mid=$doc->createElement("mid");
	$text=$doc->createElement("text");
	$time=$doc->createElement("time");
	$name=$doc->createElement("name");
	$id=$doc->createElement("id");
	$image=$doc->createElement("image");
	$cate=$doc->createElement("cate");
	$page=$doc->createElement("page");
	$mid->appendChild($doc->createTextNode($content['id']));
	$text->appendChild($doc->createTextNode($content['text']));
	$timestamp=date('c',$content['timestamp']);
	$time->appendChild($doc->createTextNode($timestamp));
	$name->appendChild($doc->createTextNode($content['nick']));
	$id->appendChild($doc->createTextNode($content['name']));	
	if($content['head']==""){
		$image->appendChild($doc->createTextNode("http:img.kaixin001.com.cn/i/50_0_0.gif"));
	}
	else{
	$image->appendChild($doc->createTextNode($content['head']."/100"));
	}
	$cate->appendChild($doc->createTextNode('tencent'));
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