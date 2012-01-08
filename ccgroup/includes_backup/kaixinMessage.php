<?php
include('../conf.php');
$access_token=$_REQUEST['access_token'];
//$access_token="129150607_dfa9af0d9a1a8c1b78279b170547ef8a";
$title=$_REQUEST['content'];
//$title="Hi";
$uids=$_REQUEST['fuids'];
//$uids="131061046";
$category=0;
$url="https://api.kaixin001.com/rgroup/group_create.json";
$post_data="access_token=".$access_token."&title=".$title."&uids=".$uids."&category=0";
$ch = curl_init();//打开
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
$response  = curl_exec($ch);
curl_close($ch);//关闭
echo $response;
?>