
<?php
//error_reporting('0');
//设置include_path 到 OpenSDK目录
set_include_path((dirname(__FILE__)) . '/lib/');
require_once 'OpenSDK/Tencent/Weibo.php';
include '../conf.php';
OpenSDK_Tencent_Weibo::init($qqweibopost_key, $qqweibopost_secret);
//打开session
session_start();
header('Content-Type: text/html; charset=utf-8');
	$_SESSION[OpenSDK_Tencent_Weibo::ACCESS_TOKEN]=$_REQUEST['oauth_token'];
	$_SESSION[OpenSDK_Tencent_Weibo::OAUTH_TOKEN_SECRET]=$_REQUEST['oauth_token_secret'];
//$_SESSION[OpenSDK_Tencent_Weibo::ACCESS_TOKEN]="05d6de23f7d34668bc22f4d3c7a04c62";
//$_SESSION[OpenSDK_Tencent_Weibo::OAUTH_TOKEN_SECRET]="67da7ce02b7934db967ae8085a6cd48d";
$content=$_REQUEST['content'];
	$api_name = 't/add';
	$params=array(
					'format'=>'xml',
					'content'=>$content,
			        'clientip'=>'192.168.0.166',
			        'jing'=>'110.5',
			        'wei'=>'23.4'
					);
	$response = OpenSDK_Tencent_Weibo::call($api_name,$params,"POST",false,true,false);
    print_r($response);
?>