<?php
include ( '/var/www/html/mediawiki-1.16.5/extensions/ccgroup/conf.php' );

function getCreator($pageName ){
	global $ccSite,$ccDB, $ccDBUsername, $ccDBPassword, $ccDBName, $cc_page;

	$con = mysql_connect( $ccDB, $ccDBUsername, $ccDBPassword );
	if(!$con){
		die( 'Could not connect: ' . mysql_error() );
	}
	mysql_select_db( $ccDBName, $con );
	$result = mysql_query( 'select * from ' .$cc_page . ' where page_name="' .$pageName. '"');

        $form = '<table align="center" border="0" id="table3">';

	while ( $row = mysql_fetch_array($result) ) {
		$form .= '<tr>';

		//get image
		if( $row['creator_photo'] != '' ){
                        $image = '/' . $ccSite . '/extensions/ccgroup/images/'.$row['creator_photo'];
		}
		elseif( $row['creator_email'] != '' ){
			$default = "http://www.somewhere.com/homestar.jpg";
			$size = 45;
			$image = "http://www.gravatar.com/avatar/" .md5( strtolower( trim( $row['creator_email'] ) ) ). "?d=" .urlencode( $default ). "&s=" .$size;
		}
		else
			$image = '';

		$form .= '<td align="center"><img src="'.$image.'" width="45" height="45" onmousedown="alert('."'Name:".$row['creator_name'].'\nEmail:'.$row['creator_email']."'".')"/>
			<br />
			<font size="1" face="arial" color="red">'.$row['creator_name'].'</font></td>';
	}
	mysql_close( $con );	

	$form .= '</tr>';
        $form .= '</table>';

	return $form;
}

?>
