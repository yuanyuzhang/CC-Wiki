<?php

/**
 *participate Special Page
 *
 */
include ( 'conf.php');

class SpecialParticipate extends SpecialPage {

        /**
         * Constructor
         */
        public function __construct() {
                parent::__construct( 'Participate' );
        }

        /**
         * Show the special page
         */
        public function execute( $par ) {
                global $wgOut , $wgRequest, $path;
		global $ccHost, $ccPort, $ccSite;

                $this->setHeaders();
                
		$this->page_name = $wgRequest->getText( 'page_name' );
		$this->names = $wgRequest->getText( 'name' );
                $this->photo = $wgRequest->getText( 'photo' );
                $this->email = $wgRequest->getText( 'email' );

		$wgOut->addHTML( $this->makeForm( $this->page_name) );

                if( $this->names != '' )
                {
                        $dbw =  wfGetDB( DB_MASTER );
                        $dbw->begin();
                        $dbw->insert( 'cc_participator', array('page_name' => $this->page_name, 'name' => $this->names, 'photo' => $this->photo, 'email' => $this->email), __METHOD__, 'IGNORE' );
                        $dbw->commit();
                        header('Location:http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php');
                }
         }

        private function makeForm( $page_name ) {
		global $ccHost, $ccPort, $ccSite;

                $title = self::getTitleFor( 'Participate' );
                $form  = '<fieldset><legend>' . wfMsgHtml( 'Participate' ) . '</legend>';

		$form .= '<div>
                        <h3>Page name: ' .$page_name. '</h3></div>';
                $form .= Xml::openElement( 'form ', array( 'method' => 'get', 'action' => 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/index.php/Special:Participate' ) );
//              $form .= Xml::hidden( 'title', $title->getPrefixedText() );
		$form .= '<input type="hidden" name="page_name" value="' .$page_name. '" /><br />';
                $form .= '<p>' . Xml::inputLabel( 'Name', 'name', 'name', 20, $this->names );
                $form .= '<p>' . Xml::inputLabel( 'Photo', 'photo', 'photo', 20, $this->photo );
                $form .= '<p>' . Xml::inputLabel( 'Email', 'email', 'email', 20, $this->email );
                $form .= '<br /><br />' . Xml::submitButton( 'Participate' ) . '</p>';
                $form .= Xml::closeElement( 'form' );
                $form .= '</fieldset>';
                 return $form;
        } 
}
?>
