<?php
include '../gbconfig.php';
echo "hello";
//fliterXML
$gb=$_REQUEST['gb'];
$gb="meituan,lashou";
$gb=explode(',', $gb);
$language=$_REQUEST['language'];
$language="北京,beijing";
$language=explode(',', $language);
$keyword=$_REQUEST['keyword'];
$keywords=explode(',', $keyword);
$keyword="自助";
$endTime=$_REQUEST['endTime'];
$endTime="2011-12-30";
$input=new DOMDocument();
$doc=new DOMDocument('1.0','UTF-8');
$doc->formatOutput=true;
$root=$doc->createElement("deals");
$doc->appendChild($root);
foreach ($gb as $gbcompany){
if($gbcompany=="meituan"){
	$gburl="http://www.meituan.com/api/v2/".$language[1]."/deals";
	$rurl=$meituan;
}
elseif ($gbcompany=="lashou"){
	$gburl="http://open.client.lashou.com/api/detail/city/".$language[0];
	$rurl=$lashou;
}
$contents=json_decode($rurl,true);

$input->load($gburl);
$input_datas=$input->getElementsByTagName($contents['data']);
$i=1;
foreach ($input_datas as $input_data){
	$title_value=$input_data->getElementsByTagName($contents['product']['title']);
	$title_value=$title_value->item(0)->nodeValue;
	$detail_value=$input_data->getElementsByTagName($contents['product']['description']);
	$detail_value=$detail_value->item(0)->nodeValue;
	$end_time_value=$input_data->getElementsByTagName($contents['product']['validThrough']);
	$end_time_value=$end_time_value->item(0)->nodeValue;
	$end_time_value=date('c',$end_time_value);
	$flag=0;
	foreach ($keywords as $keyword)
	{
		if(stristr($title_value, $keyword)||stristr($detail_value, $keyword)){
			$flag=1;
		}
	}
	if($flag==0)
		continue;
	if($end_time_value>=$endTime){
	foreach ($keywords as $keyword)
		
		$data=$doc->createElement("data");
	$page=$doc->createElement("page");
	$page->appendChild($doc->createTextNode($i));
	$data->appendChild($page);
	$i++;
	$id=$doc->createElement("id");
	$input_id=$input_data->getElementsByTagName($contents['product']['id']);
	$id->appendChild($doc->createTextNode($input_id->item(0)->nodeValue));
	$data->appendChild($id);
	
	$title=$doc->createElement("title");
	$input_title=$input_data->getElementsByTagName($contents['product']['title']);
	$title->appendChild($doc->createTextNode($input_title->item(0)->nodeValue));
	$data->appendChild($title);
	
	$city=$doc->createElement("city");
	$input_city=$input_data->getElementsByTagName($contents['product']['city']);
	$city->appendChild($doc->createTextNode($input_city->item(0)->nodeValue));
	$data->appendChild($city);
	
	$category=$doc->createElement("category");
	$input_category=$input_data->getElementsByTagName($contents['product']['category']);
	$category_value=$input_category->item(0)->nodeValue;
	if($contents['cate'][$category_value]!=''){
		$category_value=$contents['cate'][$category_value];
	}
	else {
		$category_value='其他';
	}
	$category->appendChild($doc->createTextNode($category_value));
	$data->appendChild($category);
	
	$value=$doc->createElement("value");
	$input_value=$input_data->getElementsByTagName($contents['discount']['original_price']);
	$value->appendChild($doc->createTextNode($input_value->item(0)->nodeValue));
	$data->appendChild($value);
	
	$price=$doc->createElement("price");
	$input_price=$input_data->getElementsByTagName($contents['discount']['present_price']);
	$price->appendChild($doc->createTextNode($input_price->item(0)->nodeValue));
	$data->appendChild($price);
	
	$purchase_count=$doc->createElement("purchase_count");
	$input_purchase_count=$input_data->getElementsByTagName($contents['product']['purchase_count']);
	$purchase_count->appendChild($doc->createTextNode($input_purchase_count->item(0)->nodeValue));
	$data->appendChild($purchase_count);
	
	$detail=$doc->createElement("detail");
	$input_detail=$input_data->getElementsByTagName($contents['product']['description']);
	$detail->appendChild($doc->createTextNode($input_detail->item(0)->nodeValue));
	$data->appendChild($detail);
	
	$url=$doc->createElement("url");
	$input_url=$input_data->getElementsByTagName($contents['product']['name']);
	$url->appendChild($doc->createTextNode($input_url->item(0)->nodeValue));
	$data->appendChild($url);
	
	$image=$doc->createElement("image");
	$input_image=$input_data->getElementsByTagName($contents['img']['name']);
	$image->appendChild($doc->createTextNode($input_image->item(0)->nodeValue));
	$data->appendChild($image);
	
	$start_time=$doc->createElement("start_time");
	$input_start_time=$input_data->getElementsByTagName($contents['product']['validFrom']);
	$time=$input_start_time->item(0)->nodeValue;
	$time_value=date('c',$time);
	$start_time->appendChild($doc->createTextNode($time_value));
	$data->appendChild($start_time);
	
	$end_time=$doc->createElement("end_time");
	$input_end_time=$input_data->getElementsByTagName($contents['product']['validThrough']);
	$time=$input_end_time->item(0)->nodeValue;
	$time_value=date('c',$time);
	$end_time->appendChild($doc->createTextNode($time_value));
	$data->appendChild($end_time);
	
	$website=$doc->createElement("website");
	$website->appendChild($doc->createTextNode($contents['website']));
	$data->appendChild($website);
	
	
	
	$shops=$doc->createElement("shops");
	$input_shops=$input_data->getElementsByTagName($contents['shop']);
	foreach ($input_shops as $input_shop){
		$shop=$doc->createElement("shop");
		$address=$doc->createElement("address");
		$input_address=$input_shop->getElementsByTagName($contents['location']['address']);
		$address->appendChild($doc->createTextNode($input_address->item(0)->nodeValue));
		$shop->appendChild($address);
		
		$latitude=$doc->createElement("latitude");
		$input_latitude=$input_shop->getElementsByTagName($contents['location']['latitude']);
		$latitude->appendChild($doc->createTextNode($input_latitude->item(0)->nodeValue));
		$shop->appendChild($latitude);
		
		$longitude=$doc->createElement("longitude");
		$input_longitude=$input_shop->getElementsByTagName($contents['location']['longitude']);
		$longitude->appendChild($doc->createTextNode($input_longitude->item(0)->nodeValue));
		$shop->appendChild($longitude);
		$shops->appendChild($shop);
	}
	$data->appendChild($shops);
    $root->appendChild($data);
}
}
}
echo $doc->saveXML();


?>
