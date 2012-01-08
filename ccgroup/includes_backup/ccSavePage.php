<?php
include ( '../conf.php' );

function ccSavePage( $page_name, $keyword, $template, $name, $photo, $email ) {
	global $cc_page, $ccDB, $ccDBName, $ccDBUsername, $ccDBPassword;

	$con = mysql_connect( $ccDB, $ccDBUsername, $ccDBPassword );
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db( $ccDBName, $con );
	$result = mysql_query( "select page_name from " .$cc_page. " where page_name=\"" .$page_name. "\"" );
	$row = mysql_fetch_array( $result );
	if($row){
		echo "<script>alert('".$row['page_name']." has already exsited!');
			window.history.back();</script>";
		exit;
	}
	else{
//		echo "<script>alert('OK')</script>";
		$add = "insert into " .$cc_page. " (page_name, keyword, template, creator_name, creator_photo, creator_email) values (\"".$page_name."\", \"".$keyword."\", \"".$template."\", \"".$name."\", \"".$photo."\", \"".$email."\")";
		mysql_query($add);
	}
	mysql_close( $con );
}

function isPageExist($page_name)
{
	global $cc_page, $ccDB, $ccDBName, $ccDBUsername, $ccDBPassword;

	$con = mysql_connect( $ccDB, $ccDBUsername, $ccDBPassword );
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db( $ccDBName, $con );
	$result = mysql_query( "select page_name from " .$cc_page. " where page_name=\"" .$page_name. "\"" );
	$row = mysql_fetch_array( $result );
	if($row){
		return true;	
	}
	return false;
}
?>
