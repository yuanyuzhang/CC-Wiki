<?php
include ( 'conf.php');

class SpecialAllCCTemplate extends SpecialPage {
	function __construct() {
		parent::__construct( 'AllCCTemplate' );
	}
	
	function execute( $par ) {
		global $wgRequest, $wgOut, $wgScript;
		global $ccHost, $ccPort, $ccSite;
		$this->setHeaders();
#		$value = $wgRequest->getVal( 'me_text', null);
		$text = '<html>
			<head>
				<h3>All CC Template</h3>
			</head>
			<ul>
			<li><a href="http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Category_widget:RestaurantGB">Restaurant Template</a>&nbsp&nbsp&nbsp<a href="http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Category:RestaurantGB">Go</a></li>
			<li>E-Product Template</li>
			<li>Traveling Template</li>
			</ul>
			</html>';
#		$wgOut->addWikiText( $text );
		$wgOut->addHTML($text);
	#	$wgOut->addWikiText($value);
	}
}
