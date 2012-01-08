<?php 
$rurl="../conf.php";
$wurl="./temp.php";
$access_token="789";
$rf=fopen($rurl,"r");
$wf=fopen($wurl,"w");
//echo $wf;
while(!feof($rf)){
	$line=fgets($rf);
	
	if(stristr($line, "access_token")){
		fwrite($wf, '$access_token='."'$access_token'");
	}
	else
	fwrite($wf, $line);
}
fclose($rf);
fclose($wf);
$wurl="../conf.php";
$rurl="./temp.php";
$wf=fopen($wurl,"w");
$line=file_get_contents($rurl);
fwrite($wf, $line);
fclose($wf);

?>