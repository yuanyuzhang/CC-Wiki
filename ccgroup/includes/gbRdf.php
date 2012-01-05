<?php
include '../conf.php';
$gburl="http://".$ccHost.":".$ccPort."/".$ccSite."/extensions/ccgroup/includes/groupBuy.php";
//$gburl="http://open.client.lashou.com/api/detail/city/2419/p/1/r/10";
$ch = curl_init($gburl);//打开
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);//关闭
//echo $response;
$product_count=1;
$location_count=1;
$img_count=1;
$discount_count=1;
$all=array();
$doc = new DOMDocument ();
$doc->loadXML($response);
$datas=$doc->getElementsByTagName("data");
foreach ($datas as $data){
	$productInfo=array();
	$id=$data->getElementsByTagName('id');
	$id=$id->item(0)->nodeValue;
	$productInfo["goodrelation:id"]=$id;
	
	$title=$data->getElementsByTagName('title');
	$title=$title->item(0)->nodeValue;
	$productInfo["goodrelation:title"]=$title;
	
	$category=$data->getElementsByTagName('category');
	$category=$category->item(0)->nodeValue;
	$productInfo["goodrelation:category"]=$category;
	
	$city=$data->getElementsByTagName('city');
	$city=$city->item(0)->nodeValue;
	$productInfo["goodrelation:city"]=$city;
	
	$validFrom=$data->getElementsByTagName('start_time');
	$validFrom=$validFrom->item(0)->nodeValue;
	$productInfo["goodrelation:validFrom"]=$validFrom;
	
	$validThrough=$data->getElementsByTagName('end_time');
	$validThrough=$validThrough->item(0)->nodeValue;
	$productInfo["goodrelation:validThrough"]=$validThrough;
	
	$description=$data->getElementsByTagName('detail');
	$description=$description->item(0)->nodeValue;
	$productInfo["goodrelation:description"]=$description;
	
	$name=$data->getElementsByTagName('url');
	$name=$name->item(0)->nodeValue;
	$productInfo["goodrelation:name"]=$name;
	
	$purchase_count=$data->getElementsByTagName('purchase_count');
	$purchase_count=$purchase_count->item(0)->nodeValue;
	$productInfo["goodrelation:purchase_count"]=$purchase_count;
	
	
	$discount=array();
	$original_price=$data->getElementsByTagName('value');
	$original_price=$original_price->item(0)->nodeValue;
	$discount["goodrelation:original_price"]=$original_price;
	
	$present_price=$data->getElementsByTagName('price');
	$present_price=$present_price->item(0)->nodeValue;
	$discount["goodrelation:present_price"]=$present_price;
	
	$image=array();
	$name=$data->getElementsByTagName('image');
	$name=$name->item(0)->nodeValue;
	$image["goodrelation:name"]=$name;
	
	$shops=$data->getElementsByTagName('shop');
	$location_count=1;
	$location=array();
	foreach ($shops as $shop){
		$locationInfo=array();
		
		$address=$shop->getElementsByTagName('address');
		$address=$address->item(0)->nodeValue;
	    $locationInfo["goodrelation:address"]=$address;
		
	    $latitude=$shop->getElementsByTagName('latitude');
	    $latitude=$latitude->item(0)->nodeValue;
	    $locationInfo["goodrelation:latitude"]=$latitude;
	    
	    $longitude=$shop->getElementsByTagName('longitude');
	    $longitude=$longitude->item(0)->nodeValue;
	    $locationInfo["goodrelation:longitude"]=$longitude;
	    
	    $location["location".$location_count]=$locationInfo;
	    $location_count++;
	}
	
	$productInfo["goodrelation:availableAtOrFrom"]=$location;
	$productInfo["goodrelation:hasDiscount"]=$discount;
	$productInfo["goodrelation:img"]=$image;
	$all["product".$product_count]=$productInfo;
	$product_count++;
}
$result=json_encode($all);
//$result=urldecode($result);
echo $result;
?>