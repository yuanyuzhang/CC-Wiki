<?php
require_once ("lib/nusoap.php");
$server = new soap_server ();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->xml_encoding = 'UTF-8';
$server->configureWSDL ( 'getFriends' ); 
$server->register ( 'getFriends', 
array ("name" => "xsd:string" ), 
array ("return" => "xsd:string" ) ); 
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
/**
 * 供调用的方法
 * @param $name
 */
function getFriends($name) {
	/**
	  add cotents
	*/
	return "http://localhost/smw/server/friends.xml";
}
?>
