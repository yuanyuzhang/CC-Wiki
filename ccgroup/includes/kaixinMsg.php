<?php
$access_token=$_REQUEST['access_token'];
//$access_token="131061046_ac4a7ea2000f24cbfa253d0f6a35adee";
$content=$_REQUEST['content'];
//$content="test";
$fuids=$_REQUEST['fuids'];
//$fuids=129150607;
$url="https://api.kaixin001.com/message/send.json";
$post_data="access_token=".$access_token."&content=".$content."&fuids=".$fuids;
$ch = curl_init();//打开
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
$response  = curl_exec($ch);
curl_close($ch);//关闭
echo $response;
?>