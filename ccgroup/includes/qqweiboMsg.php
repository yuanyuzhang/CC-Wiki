
<?php
error_reporting('0');
//设置include_path 到 OpenSDK目录
set_include_path(dirname(dirname(__FILE__)) . '/lib/');
require_once 'OpenSDK/Tencent/Weibo.php';
require_once( '../conf.php');
//include 'appkey.php';
OpenSDK_Tencent_Weibo::init($appkey, $appsecret);
//打开session
session_start();
header('Content-Type: text/html; charset=utf-8');
	$_SESSION[OpenSDK_Tencent_Weibo::ACCESS_TOKEN]=$_REQUEST['oauth_token'];
	$_SESSION[OpenSDK_Tencent_Weibo::OAUTH_TOKEN_SECRET]=$_REQUEST['oauth_token_secret'];
//$_SESSION[OpenSDK_Tencent_Weibo::ACCESS_TOKEN]="f0d504bc125a46d6bff70ff3cb9fc6bc";
//$_SESSION[OpenSDK_Tencent_Weibo::OAUTH_TOKEN_SECRET]="a92503333c470411cfb78461076347d1";
$content=$_REQUEST["content"];	
//$content="hello";
$id=$_REQUEST["id"];
//$id="yuanyuzhang2011";
$api_name = 'private/add';
	$params=array(
					'format'=>'xml',
					'content'=>$content,
			        'clientip'=>'192.168.0.12',
			        'jing'=>'',
			        'wei'=>'',
			        'name'=>$id
					);
	$response = OpenSDK_Tencent_Weibo::call($api_name,$params,"post",false,true,false);
	echo $response;
?>
