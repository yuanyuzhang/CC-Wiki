<?php
session_start();
$url=$_GET["url"];
if($url=="session"){
	if(isset($_SESSION['oauth_token_secret'])){
		echo $_SESSION['oauth_token_secret'];
		unset($_SESSION['oauth_token_secret']);
	}
	else {
		$_SESSION['oauth_token_secret']=$_REQUEST['oauth_token_secret'];
	}
	
}
elseif ($url=="sinasession"){
	    $_SESSION['sina_access_token']=$_REQUEST['sina_access_token'];
}
elseif ($url=="qqweibosession"){
	   $_SESSION['qqweibo_access_token']=$_REQUEST['qqweibo_access_token'];
	   $_SESSION['qqweibo_access_token_secret']=$_REQUEST['qqweibo_access_token_secret'];
}
else {
$post_data="";
unset($_GET["url"]);
foreach($_GET as $k => $v){
$post_data=$post_data."&".$k."=".$v;
}
$post_data=substr($post_data,1,strlen($post_data));
$ch = curl_init();//打开
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
$response  = curl_exec($ch);
curl_close($ch);//关闭
echo $response;
}
?>
