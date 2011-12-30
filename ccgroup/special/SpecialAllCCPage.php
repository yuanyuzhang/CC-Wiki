<?php

/**
 *All CC  Special Page
 *
 */
include ( 'conf.php');

class SpecialAllCCPage extends SpecialPage {

        /**
         * Constructor
         */
        public function __construct() {
                parent::__construct( 'AllCCPage' );
        }

        /**
         * Show the special page
         */
        public function execute( $par ) {
                global $wgOut, $wgRequest;
                $this->setHeaders();
                $wgOut->addHTML( $this->makeForm() );

         }

        private function makeForm() {
                global $wgScript, $wgOut, $path;
		global $ccHost, $ccPort, $ccSite;
		$pre_template = '';

		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select('cc_page', array( 'page_name', 'template'),
			'', __METHOD__, array( 'ORDER BY' => 'template, page_name ASC' ));
		//foreach( $res as $row ){ 
//		while( $row = $res->fetchObject() ){
//			$wgOut->addWikiText( $row->title );
//		}
	
                $title = self::getTitleFor( 'AllCCPage' );
                $form  = '<fieldset><legend>' . wfMsgHtml(  'allccpage' ) . '</legend>';
//              $form .= Xml::hidden( 'title', $title->getPrefixedText() );
		while ( $row = $res->fetchObject() ){
			$template = $row->template;
			if( $template!=$pre_template ){
				$form .= '<p>'.$template.'</p>';
				$pre_template = $template; 
			}
			$tmpUrl = 'http://'  .$ccHost.  ':'  .$ccPort.  '/' .$ccSite;
			$form .= '<a href="'.$tmpUrl.'/index.php/'.$row->page_name.'">'.$row->page_name.'</a> &nbsp &nbsp &nbsp';
		}
                $form .= '</fieldset>';
                return $form;
        }
}
?>
