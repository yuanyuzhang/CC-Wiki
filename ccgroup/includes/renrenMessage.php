<?php
include('../conf.php');
$access_token=$_REQUEST['access_token'];
$to_ids=$_REQUEST['to_ids'];
$notification=$_REQUEST['notification'];
//$access_token="174952|6.ebb4960f6298cb5713aa53541b7cb24f.2592000.1327806000-258943266";
//$to_ids="236591025";
//$notification="hello";
$v="1.0";
$secret=$renren_secret;
$format="XML";
$method="notifications.send";
$content="access_token=".$access_token."format=".$format."method=".$method."notification=".$notification."to_ids=".$to_ids."v=".$v.$secret;
$sig=md5($content);
$post_data="access_token=".$access_token."&format=".$format."&method=".$method."&v=".$v."&notification=".$notification."&to_ids=".$to_ids."&sig=".$sig;
$url="http://api.renren.com/restserver.do";
$ch = curl_init();//打开
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
$response  = curl_exec($ch);
curl_close($ch);//关闭
echo $response;
?>