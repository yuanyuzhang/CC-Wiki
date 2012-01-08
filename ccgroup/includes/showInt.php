<?php
include ( '/var/www/html/mediawiki-1.16.5/extensions/ccgroup/conf.php' );

function getInterestor($pageName ){
	global $ccSite,$ccDB, $ccDBUsername, $ccDBPassword, $ccDBName, $cc_interestor;

	$count = 0;
	$tag = true;

	//get interestor from cc_intrerestot
	$con = mysql_connect( $ccDB, $ccDBUsername, $ccDBPassword );
	if(!$con){
		die( 'Could not connect: ' . mysql_error() );
	}
	mysql_select_db( $ccDBName, $con );
	$result = mysql_query( 'select * from ' .$cc_interestor . ' where page_name="' .$pageName. '"');

        $form = '<table align="center" border="0" id="table3">';
       	$form .= '<tbody id="table4">';

	while ( $row = mysql_fetch_array($result) ) {
		if(($count%2)==0){
			$tag = false;
			$form .= '<tr>';
		}

		//get image
		if( $row['photo'] != '' ){
                        $image = '/' . $ccSite . '/extensions/ccgroup/images/'.$row['photo'];
		}
		elseif( $row['email'] != '' ){
			$default = "http://www.somewhere.com/homestar.jpg";
			$size = 45;
			$image = "http://www.gravatar.com/avatar/" .md5( strtolower( trim( $row['email'] ) ) ). "?d=" .urlencode( $default ). "&s=" .$size;
		}
		else
			$image = '';

		$form .= '<td align="center"><img src="'.$image.'" width="45" height="45" onmousedown="alert('."'Name:".$row['name'].'\nEmail:'.$row['email']."'".')"/>
			<br />
			<font size="1" face="arial" color="red">'.$row['name'].'</font></td>';
		if(($count%2)==1){
			$form .= '</tr>';
			$count = -1;
			$tag = true;
		}
		$count++; 
	}
	mysql_close( $con );	

	if($tag==false)
		$form .= '</tr>';

	$form .= '</tbody>';
        $form .= '</table>';
        $form .= ' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  <span id="spanPre2">Pre</span> &nbsp <span id="spanNext2">Next</span> &nbsp ';
	$form .= fenye2();

	return $form;
}

function fenye2() {
		$out = '<script>
		var theTable2 = document.getElementById( "table4" );
 
		var spanPre2 = document.getElementById("spanPre2");
		var spanNext2 = document.getElementById("spanNext2");

		var numberRowsInTable2 = theTable2.rows.length;
		var pageSize2 = 3;
		var page2 = 1;


		function next2() {

		"hideTable2();
    
		currentRow2 = pageSize2 * page2;
		maxRow2 = currentRow2 + pageSize2;
		if ( maxRow2 > numberRowsInTable2 ) maxRow2 = numberRowsInTable2;
		for ( var i = currentRow2; i< maxRow2; i++ ) {
        	theTable2.rows[i].style.display = "";
    		}
	        page2++;

		if ( maxRow2 == numberRowsInTable2 )  { nextText2(); }
		preLink2();
		}

		function pre2() {

	        hideTable2();
    
		    page2--;
    
		    currentRow2 = pageSize2 * page2;
		    maxRow2 = currentRow2 - pageSize2;
		    if ( currentRow2 > numberRowsInTable2 ) currentRow2 = numberRowsInTable2;
		    for ( var i = maxRow2; i< currentRow2; i++ ) {
		        theTable2.rows[i].style.display = "";
		    }
    
    
		    if ( maxRow2 == 0 ) { preText2(); }
		    nextLink2();
		}
		
		function hideTable2() {
		    for ( var i = 0; i<numberRowsInTable2; i++ ) {
		        theTable2.rows[i].style.display = "none";
		    }
		}
	
		function preLink2() { spanPre2.innerHTML = "<a href=\"javascript:pre2();\">Pre</a>"; }
		function preText2() { spanPre2.innerHTML = "Pre"; }
		
		function nextLink2() { spanNext2.innerHTML = "<a href=\"javascript:next2();\">Next</a>"; }
		function nextText2() { spanNext2.innerHTML = "Next"; }
		
		function hide2() {
		    for ( var i = pageSize2; i<numberRowsInTable2; i++ ) {
		        theTable2.rows[i].style.display = "none";
		    }
		 
		    nextLink2();
		}

		hide2();
		</script>';
		return $out; 
        }	
?>
