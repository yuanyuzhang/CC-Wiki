<?php
include '../conf.php';
$url="http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/gbRdf.php";
$ch = curl_init($url);//打开
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);//关闭
$products=json_decode($response,true);
foreach ($products as $product ){
	echo "[[GBId::".$product['goodrelation:id']."]]";
	echo "[[GBTitle::".$product['goodrelation:title']."]]";
	echo "[[GBCategory::".$product['goodrelation:category']."]]";
	echo "[[GBCity::".$product['goodrelation:city']."]]";
	echo "[[GBTitle::".$product['goodrelation:title']."]]";
	echo "[[GBValidFrom::".$product['goodrelation:validFrom']."]]";
	echo "[[GBValidThrough::".$product['goodrelation:validThrough']."]]";
	echo "[[GBDescription::".$product['goodrelation:description']."]]";
	echo "[[GBUrl::".$product['goodrelation:name']."]]";
	echo "[[GBCount::".$product['goodrelation:purchase_count']."]]";
	foreach ($product["goodrelation:availableAtOrFrom"] as $location){
	echo "[[GBAddress::".$location['goodrelation:address']."]]";
	echo "[[GBLatitude::".$location['goodrelation:latitude']."]]";
	echo "[[GBLongitude::".$location['goodrelation:longitude']."]]";
	}
	echo "[[GBOriginalPrice::".$product['goodrelation:hasDiscount']['goodrelation:original_price']."]]";
	echo "[[GBPresentPrice::".$product['goodrelation:hasDiscount']['goodrelation:present_price']."]]";
	echo "[[GBOriginalImage::".$product['goodrelation:img']['goodrelation:name']."]]";
	
}

?>