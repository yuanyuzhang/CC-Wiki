<?php
//
//$status=$_REQUEST['status'];
$access_token=$_REQUEST['access_token'];
$to_ids=$_REQUEST['to_ids'];
$notification=$_REQUEST['notification'];
//$access_token="168354|6.7e08d81c8407527a77bd25ddde145b5a.2592000.1325336400-258943266";
$method="notifications.send";
//$to_ids="266660518";
//$notification="hello";
$v="1.0";
$secret="06e01ffcaa304f32bd3fcaa709e35411";
$format="XML";
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
