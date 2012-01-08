<?php
include ( '../conf.php');


class SpecialAllCCTemplate extends SpecialPage {
	function __construct() {
		parent::__construct( 'AllCCTemplate' );
	}
	
	function execute( $par ) {
		global $wgRequest, $wgOut;
		global $ccHost, $ccPort, $ccSite;
		$pre_letter = '';

		$this->setHeaders();

		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select('cc_class', array( 'name' ),
                        '', __METHOD__, array( 'ORDER BY' => 'name ASC' ));

		$text = '<html> 
                        <head>  
                                <h3>All CC Template</h3>
                        </head>';
		while ( $row = $res->fetchObject() ){
			$letter = substr( $row->name, 0, 1 );
			if($pre_letter!=$letter) {
				$text .= '<p>' .$letter. '</p>';
				$pre_letter = $letter;
			}
			$text .= '<ul><li><a href="http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Category_widget:' .$row->name. '">' .$row->name. ' Template</a>&nbsp&nbsp&nbsp<a href="http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Category:' .$row->name. '">Go</a></li></ul>';
		}
		$text .= '</html>';
		$wgOut->addHTML($text);
	}
}
