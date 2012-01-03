<?php
session_start();
require_once ("./lib/nusoap.php");
include('../conf.php');
$server = new soap_server ();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->xml_encoding = 'UTF-8';
$server->configureWSDL ( 'function' ); 
$server->register ( 'getrenrenFriends', 
        array ("arg" => "xsd:string"), 
        array ("return" => "xsd:string" ) ); 
$server->register ( 'postrenrenMessage',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'getkaixinFriends',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'postkaixinMessage',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'getqqweiboFriends',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'postqqweiboMessage',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'getsinaTrend',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'getqqweiboTrend',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'sinaRepost',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'qqweiboRepost',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'qqweiboUpdate',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'sinaUpdate',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'getGroupBuy',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$server->register ( 'weiboMashup',
		array ("arg" => "xsd:string"),
		array ("return" => "xsd:string" ) );
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
/**
 * 供调用的方法
 * @param $name
 */
function get($url){
$ch = curl_init($url);//打开
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);//关闭
return $response;
}

function getrenrenFriends($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$response=  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/renrenFriend.php?access_token=".$arg);
     return  $response;
}
function postrenrenMessage($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$response=  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/renrenMessage.php?access_token=".$arg[0]."&to_ids=".$arg[1]."&notification=".$arg[2]);
	return  $response;
}
function getkaixinFriends($arg) {
    global $ccHost;
	global $ccPort;
	global $ccSite;
	$response=  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/kaixinFriend.php?access_token=".$arg);
     return  $response;
}
function postkaixinMessage($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$response=  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/kaixinMessage.php?access_token=".$arg[0]."&fuids=".$arg[1]."&content=".$arg[2]);
	return  $response;
}
function getqqweiboFriends($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$response=  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/qqweiboFriend.php?oauth_token=".$arg[0]."&oauth_token_secret=".$arg[1]);
     return  $response;
}
function postqqweiboMessage($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$response=  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/qqweiboMessage.php?oauth_token=".$arg[0]."&oauth_token_secret=".$arg[1]."&id=".$arg[2]."&content=".$arg[3]);
     return  $response;
}
/*
function getsinaTrend($arg) {
	
	$response=get("http://localhost/sinaTrend/index.php?trend=".$arg[0]);
	return $response;
}
function getqqweiboTrend($arg) {
	$response=get("http://localhost/qqweiboTrend/index.php?httext=".$arg[0]);
	return $response;
}
*/
function weiboMashup($arg) {
	/**
	 add cotents
	 */	
	global $ccDB;
	global $ccDBUsername;
	global $ccDBPassword;
	global $ccDBName;
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$link=mysql_connect($ccDB,$ccDBUsername,$ccDBPassword);
	if(!$link) echo "failed";
	mysql_select_db($ccDBName,$link);
	$sql="select * from  cc_conf_wb where page_name='$arg'";
	$result=mysql_query($sql,$link);
	$firstline=mysql_fetch_array($result);
	$title=$arg;
	$url=$firstline['weibo'];
  $response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/weiboMashup.php?data=".$url."&title=".$title);
  return $response;
}
/*
function sinaRepost($arg) {
	
	$response=get("http://localhost/sinaRepost/index.php?access_token=".$arg[0]."&mid=".$arg[1]."&content=".$arg[2]);
	return $response;
}
function qqweiboRepost($arg) {
	
	$response=get("http://localhost/qqweiboRepost/index.php?oauth_token=".$arg[0]."&oauth_token_secret=".$arg[1]."&mid=".$arg[2]."&content=".$arg[3]);
	return $response;
}
*/
function sinaUpdate($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$access_token=$_SESSION['sina_access_token'];
	$response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/sinaweiboUpdate.php?access_token=".$access_token."&status=".$arg);
	return $response;
}
function qqweiboUpdate($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	$access_token=$_SESSION['qqweibo_access_token'];
	$access_token_secret=$_SESSION['qqweibo_access_token_secret'];
	$response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/qqweiboUpdate.php?oauth_token=".$access_token."&oauth_token_secret=".$access_token_secret."&content=".$arg);
	return $response;
}
function getGroupBuy($arg) {
	global $ccHost;
	global $ccPort;
	global $ccSite;
	global $ccDB;
	global $ccDBUsername;
	global $ccDBPassword;
	global $ccDBName;
	$link=mysql_connect($ccDB,$ccDBUsername,$ccDBPassword);
	if(!$link) echo "failed";
	mysql_select_db($ccDBName,$link);
	$sql="select * from  cc_conf_gb where page_name='$arg'";
	$result=mysql_query($sql,$link);
	$firstline=mysql_fetch_array($result);
	$gb=$firstline['web'];
	$city=$firstline['city'];
	$time=$firstline['time'];
	$sql="select keyword from  cc_page where page_name='$arg'";
	$result=mysql_query($sql,$link);
	$firstline=mysql_fetch_array($result);
	$keyword=$firstline['keyword'];
	
	$response=get("http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/groupBuy.php?gb=".$gb."&language=".$city."&keyword=".$keyword."&endTime=".$time);
	return $response;
}
?>
