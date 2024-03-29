<?php
//设置include_path 到 OpenSDK目录
set_include_path((dirname(__FILE__)) . '/lib/');
require_once 'OpenSDK/Tencent/Weibo.php';
include '../conf.php';
OpenSDK_Tencent_Weibo::init($qqweibo_key, $qqweibo_secret);
//打开session
session_start();
header('Content-Type: text/html; charset=utf-8');
	$_SESSION[OpenSDK_Tencent_Weibo::ACCESS_TOKEN]=$_REQUEST['oauth_token'];
	$_SESSION[OpenSDK_Tencent_Weibo::OAUTH_TOKEN_SECRET]=$_REQUEST['oauth_token_secret'];
	$api_name = 'friends/fanslist';
	$params=array(
					'format'=>'xml',
					'reqnum'=>'30',
			        'starindex'=>'0'
					);
	$response = OpenSDK_Tencent_Weibo::call($api_name,$params,"GET",false,true,false);
	$contents=json_decode($response,true);
   $doc=new DOMDocument('1.0', 'UTF-8');
    $doc->formatOutput=true;
    $root=$doc->createElement("friends");
    $doc->appendChild($root);
    foreach ($contents['data']['info']as $content){
    	$f=$doc->createElement("friend");
    	$id=$doc->createElement("id");
    	$name=$doc->createElement("name");
    	$url=$doc->createElement("url");
    	$cate=$doc->createElement("cate");
    	$id->appendChild($doc->createTextNode($content['name']));
    	$name->appendChild($doc->createTextNode($content['nick']));
    	if($content['head']==""){
    		$url->appendChild($doc->createTextNode("http:img.kaixin001.com.cn/i/50_0_0.gif"));
    	}
    	else{
    	$url->appendChild($doc->createTextNode($content['head']."/50"));
    	}
    	$cate->appendChild($doc->createTextNode("tencent"));
    	$f->appendChild($id);
    	$f->appendChild($name);
    	$f->appendChild($url);
    	$f->appendChild($cate);
    	$root->appendChild($f);
    }
    echo $doc->saveXML();
    
?>
