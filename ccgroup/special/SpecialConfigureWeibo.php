<?php
include ( 'conf.php');

class SpecialConfigureWeibo extends SpecialPage {    
 	function __construct() {
        	parent::__construct( 'ConfigureWeibo' );
    	}

    	function execute( $par ) {
         	global $wgRequest, $wgOut, $path;
		global $ccHost, $ccPort, $ccSite, $ccDB, $ccDBUsername, $ccDBPassword, $ccDBName;

        	$this->setHeaders();
	
		$this->page_name = $wgRequest->getText( 'page_name' );
                $this->sina = $wgRequest->getText( 'sina' );
                $this->tencent = $wgRequest->getText( 'tencent' );
                $this->time = $wgRequest->getText( 'time' );

		$wgOut->addHTML( $this->makeForm( $this->page_name ) );

		if($this->sina!=''||$this->tencent!=''){
                        $dbr = wfGetDB( DB_SLAVE );
                        $res = $dbr->select( 'cc_conf_wb', array( 'page_name' ),
'page_name="' . $this->page_name . '"', __METHOD__, array( 'ORDER BY' => 'page_name ASC' ));
                        $s = $dbr->fetchObject( $res );
                        if( $s->page_name!=''){
                                 //update
                                $con = mysql_connect($ccDB, $ccDBUsername, $ccDBPassword);
                                if (!$con)
                                {
                                        die('Could not connect: ' . mysql_error());
                                }
                                mysql_select_db($ccDBName, $con);
                                mysql_query('UPDATE cc_conf_wb SET weibo="' .$this->sina.','.$this->tencent .'",time="' .$this->time. '" WHERE page_name="' .$this->page_name. '"');
                                mysql_close( $con );
                        }
                        else{
                                 //insert
                                $dbw = wfGetDB( DB_MASTER );
                                $dbw->insert( 'cc_conf_wb', array('page_name' => $this->page_name, 'weibo' => $this->sina.','.$this->tencent, 'time' => $this->time), __METHOD__, 'IGNORE');
                       }

                        header('Location:http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php');
                }	
    	}

	private function makeForm( $page_name ) {
		global $ccHost, $ccPort, $ccSite;

		$title = self::getTitleFor( 'ConfigureWeibo' );
		$form = '<fieldset><legend>' . wfMsgHtml( 'configureweibo' ) . '</legend>';
		//display page name
		$form .= '<div style="color:#00FF00">
                                <h3>Page Name: ' . $page_name . '</h3>
                        </div>';

		$form .= Xml::openElement( 'form', array( 'method' => 'get', 'action' => 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite .'/index.php/Special:ConfigureWeibo' ));
		$form .= '<input type="hidden" name="page_name" value="' .$page_name. '" /><br />';
		$form .= '<input type="checkbox" name="sina" value="sina"><img height="50" width="100" src="http://www.ekesn.com/producer/1/sz21/1/fckeditor/13021409731.jpg" /></input> &nbsp';
		$form .= '<input type="checkbox" name="tencent" value="tencent"><img height="40" width="100" src="http://open.t.qq.com/images/resource/p9.gif" /></input><br /><br />';
		$form .= 'Time("yyyy-mm-dd"):<br /><input type="text" name="time"><br /><br />';
		$form .= Xml::submitButton( 'OK' );
		$form .= Xml::closeElement( 'form' );
		$form .= '</filedset>';
		return $form; 
	}
}
?>
