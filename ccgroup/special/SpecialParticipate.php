<?php

include ( '../conf.php');

class SpecialParticipate extends SpecialPage {

        public function __construct() {
                parent::__construct( 'Participate' );
        }

        public function execute( $par ) {
                global $wgOut , $wgRequest;

                $this->setHeaders();
                
		$this->page_name = $wgRequest->getText( 'page_name' );
		$this->gbTitle = $wgRequest->getText( 'gbTitle' );
		$this->gbImg = $wgRequest->getText( 'gbImg' );
		$this->gbUrl = $wgRequest->getText( 'gbUrl' );

		$wgOut->addHTML( $this->makeForm( $this->page_name, $this->gbTitle, $this->gbImg, $this->gbUrl ) );

         }

        private function makeForm( $page_name, $gbTitle, $gbImg, $gbUrl ) {
		global $ccHost, $ccPort, $ccSite;

                $title = self::getTitleFor( 'Participate' );
                $form  = '<fieldset><legend>' . wfMsgHtml( 'Participate' ) . '</legend>';

		$form .= '<div>
                        <h3>Page name: ' .$page_name. '</h3></div>';
		$form .='<table cellpadding="20"><tr><td>';
                $form .= '<form id="form1" name="form1" method="post" action="' .'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/special/participatorSave.php'. '" enctype="multipart/form-data">';
		$form .= '<input type="hidden" name="page_name" value="' .$page_name. '" /><br />';
		$form .= '<input type="hidden" name="gbUrl" value="' .$gbUrl. '" /><br />';
		$form .= '<p> Name <input type="text" name="name" />';
                $form .= '<p> Email <input type="text" name="email" />';
                $form .= '<p> Photo <input type="file" name="photo" />';
                $form .= '<br /><br />' . Xml::submitButton( 'Participate' ) . '</p>';
                $form .= '</form>';
		$form .= '</td><td>
                        <p><font size="3" face="arial" color="red">'.$gbTitle.'</font></p>
                        <img src="'.$gbImg.'" /></td></tr>
                        </table>';
                $form .= '</fieldset>';

                return $form;
        } 
}
?>
