<?php
$status=$_REQUEST['status'];
$access_token=$_REQUEST['access_token'];
$url="https://api.weibo.com/2/statuses/update.json";
$post_data="access_token=".$access_token."&status=".$status;
$ch = curl_init();//打开
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
$response  = curl_exec($ch);
curl_close($ch);//关闭
echo $response;
?>