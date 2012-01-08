<?php

include ( '../conf.php');

class SpecialAllCCPage extends SpecialPage {

        public function __construct() {
                parent::__construct( 'AllCCPage' );
        }

        public function execute( $par ) {
                global $wgOut, $wgRequest;
                $this->setHeaders();

                $wgOut->addHTML( $this->makeForm() );

         }

        private function makeForm() {
                global $wgScript, $wgOut;
		global $ccHost, $ccPort, $ccSite;
		$pre_template = '';
		$pre_letter = '';

		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select('cc_page', array( 'page_name', 'template'),
			'', __METHOD__, array( 'ORDER BY' => 'template, page_name ASC' ));
	
                $title = self::getTitleFor( 'AllCCPage' );
                $form  = '<fieldset><legend>' . wfMsgHtml(  'allccpage' ) . '</legend>';
	
		while ( $row = $res->fetchObject() ){
			$template = $row->template;
			if( $template!=$pre_template ){
				$form .= '<p><font size="3" face="arial" color="red">'.$template.'</font></P>';
				$pre_template = $template; 
			}
			$letter = substr( $row->page_name, 0, 1 );
			if( $letter != $pre_letter ){
				$form .= '<p>'.$letter.'</p>';
				$pre_letter = $letter;
			}
			$tmpUrl = 'http://'  .$ccHost.  ':'  .$ccPort.  '/' .$ccSite;
			$form .= '<ul><li><a href="'.$tmpUrl.'/index.php/'.$row->page_name.'">'.$row->page_name.'</a></li></ul>';
		}
                $form .= '</fieldset>';
                return $form;
        }
}
?>
