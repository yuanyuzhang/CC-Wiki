<?php
include ( '/var/www/html/mediawiki-1.16.5/extensions/ccgroup/conf.php' );

function getParticipator($pageName ){
        global $apacheSite, $ccSite,$ccDB, $ccDBUsername, $ccDBPassword, $ccDBName, $cc_participator;

        $count = 0;
        $tag = true;

        //get participator from cc_paticipator
        $con = mysql_connect( $ccDB, $ccDBUsername, $ccDBPassword );
        if(!$con){
                die( 'Could not connect: ' . mysql_error() );
        }
        mysql_select_db( $ccDBName, $con );
	$result = mysql_query( 'select * from ' .$cc_participator . ' where page_name="' .$pageName. '"');

        $form = '<table align="center" border="0" id="table5">';
        $form .= '<tbody id="table6">';

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
                        $default =  "http://www.somewhere.com/homestar.jpg";
                        $size = 45;
                        $image = "http://www.gravatar.com/avatar/" .md5( strtolower( trim( $row['email'] ) ) ). "?d=" .urlencode( $default ). "&s=" .$size;
                }
                else
                        $image = '';

		$form .= '<td align="center"><img src="'.$image.'" width="45" height="45" onmousedown="alert('."'Name:".$row['name'].'\nEmail:'.$row['email']."'".')"/>
                        <br />
                        <font size=" 1" face="arial" color="red">'.$row['name'].'</font></td>';

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
        $form .= '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  <span id="spanPre1">Pre</span> &nbsp <span id="spanNext1">Next</span> &nbsp ';
        $form .= fenye3();

        return $form;
}

function fenye3() {
		$out = '<script>
		var theTable3 = document.getElementById( "table6" );
 
		var spanPre3 = document.getElementById("spanPre1");
		var spanNext3 = document.getElementById("spanNext1");

		var numberRowsInTable3 = theTable3.rows.length;
		var pageSize3 = 3;
		var page3 = 1;


		function next3() {

		hideTable3();
    
		currentRow3 = pageSize3 * page3;
		maxRow3 = currentRow3 + pageSize3;
		if ( maxRow3 > numberRowsInTable3 ) maxRow3 = numberRowsInTable3;
		for ( var i = currentRow3; i< maxRow3; i++ ) {
        	theTable3.rows[i].style.display = "";
    		}
	        page3++;

		if ( maxRow3 == numberRowsInTable3 )  { nextText3(); }
		preLink3();
		}

		function pre3() {

	        hideTable3();
    
		    page3--;
    
		    currentRow3 = pageSize3 * page3;
		    maxRow3 = currentRow3 - pageSize3;
		    if ( currentRow3 > numberRowsInTable3 ) currentRow3 = numberRowsInTable3;
		    for ( var i = maxRow3; i< currentRow3; i++ ) {
		        theTable3.rows[i].style.display = "";
		    }
    
    
		    if ( maxRow3 == 0 ) { preText3(); }
		    nextLink3();
		}
		
		function hideTable3() {
		    for ( var i = 0; i<numberRowsInTable3; i++ ) {
		        theTable3.rows[i].style.display = "none";
		    }
		}
	
		function preLink3() { spanPre3.innerHTML = "<a href=\"javascript:pre3();\">Pre</a>"; }
		function preText3() { spanPre3.innerHTML = "Pre"; }
		
		function nextLink3() { spanNext3.innerHTML = "<a href=\"javascript:next3();\">Next</a>"; }
		function nextText3() { spanNext3.innerHTML = "Next"; }
		
		function hide3() {
		    for ( var i = pageSize3; i<numberRowsInTable3; i++ ) {
		        theTable3.rows[i].style.display = "none";
		    }
		 
		    nextLink3();
		}

		hide3();
		</script>';
		return $out; 
        }
?>
