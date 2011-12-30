<?php
include ( 'conf.php');

class SpecialInvite extends SpecialPage {
        function __construct() {
                parent::__construct( 'Invite' );
        }

        function execute( $par ) {
                global $wgOut, $wgRequest, $ccHost, $ccPort, $ccSite;

                $this->setHeaders();
                $wgOut->addHTML( $this->makeForm() );
		
		$this->token=$wgRequest->getText( 'access_token' );
		$this->token_secret=$wgRequest->getText( 'access_token_secret' );
		$this->sns=$wgRequest->getText( 'type' );
		//$wgOut->addWikiText( $sns )
		if($this->token != ''){
			$this->getFriends( $this->token, $this->sns, $this->token_secret);
		}
        }

        private function makeForm() {
                global $ccHost, $ccPort, $ccSite;
                $title = self::getTitleFor( 'Invite' );
                $form = '<fieldset><legend>' . wfMsgHtml( 'Invite' ) . '</legend>';
		//login Renren
                $form .= '<a href="https://graph.renren.com/oauth/authorize?response_type=code&client_id=507acaf228d04a9ba517e732b4454151&redirect_uri=http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/login/log2.htm&scope=read_user_feed read_user_status read_user_comment publish_feed write_guestbook status_update publish_comment"><input type="image" height="30" width="70" src="http://www.guanfang.info/uploads/allimg/110107/1_110107120047_1.jpg" /></a> &nbsp &nbsp';
		//login Kaixin
		$form .= '<a href="http://api.kaixin001.com/oauth2/authorize?response_type=code&client_id=3004238376121d9a4a078abfdd2b00ff&redirect_uri=http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/login/kaixin2.htm&scope=send_message"><input type="image" height="30" width="70" src="http://smt.114chn.com/Webpub/upload/091102/129016123320781250.jpg" /></a> &nbsp &nbsp';
		//login Tencen
		$form .= '<a href="http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/login/qqweibo1.htm"><input type="image" height="30" width="70" src="http://open.t.qq.com/images/resource/p9.gif" /></a> &nbsp &nbsp';
                $form .= '</fieldset>';
                return $form;
        }

	private function getFriends( $token, $sns, $token_secret ){
		global $ccHost, $ccPort, $ccSite;
		$count = 0;
		$tag = true;
		$sendURL = 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/sendMessage.php';
		if($sns=='renren')
			$url = 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/renrenFriend.php?access_token=' . $token; 
		elseif($sns=='kaixin')
			$url = 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/kaixinFriend.php?access_token=' . $token; 
		elseif($sns=='qq')
			$url = 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite. '/extensions/ccgroup/includes/qqweiboFriend.php?oauth_token=' .$token. '&oauth_token_secret=' . $token_secret;
	//	$wgOut->addWikiText( $url );
                $doc = new DOMDocument(); 
                $doc->load( $url );
                $friends = $doc->getElementsByTagName( 'friend' );
	//	$wgOut->addWikiText( $friends->length );
		$form = Xml::openElement(  'form', array( 'method' => 'get', 'action' => $sendURL ));
                $form .= Xml::openElement( 'table', array( 'border' => '0', 'cellpadding' => '20', 'id' => 'table1' ));
                $form .= '<tbody id="table2">';
		foreach ( $friends as $friend ){
                	$username = $friend->getElementsByTagName( 'name' );
                        $photo = $friend->getElementsByTagName( 'url' );
			$id = $friend->getElementsByTagName( 'id' );
			if(($count%6)==0){
				$tag = false;
				$form .= '<tr>';
			}
			$form .= '<td><img src="'.$photo->item(0)->nodeValue.'" /><br /><input type="checkbox" name="friends" value="'.$id->item(0)->nodeValue.'">'.$username->item(0)->nodeValue.'</input></td>';
			if(($count%6)==5){
				$form .= '</tr>';
				$count = -1;
				$tag = true;
			}
			$count++; 
		}
		if($tag==false)
			$form .= '</tr>';
		$form .= '</tbody>';
                $form .= Xml::closeElement('table');
                $form .= '<span id="spanFirst">First</span> &nbsp <span id="spanPre">Pre</span> &nbsp <span id="spanNext">Next</span> &nbsp ';
                $form .= '<span id="spanLast">Last</span> &nbsp Page<span id="spanPageNum"></span>/Total<span id="spanTotalPage"></span>pages<br /><br />';
		$form .= 'Message:<input type="text" name="message" size="64" />';//Xml::inputLabel( 'Message', 'message', 'message', 64, $this->message);
		$form .= '<input type="hidden" name="token" value="' . $token . '" />';
		$form .= '<input type="hidden" name="token_secret" value="' . $token_secret . '" />';
		$form .= '<input type="hidden" name="sns" value="' . $sns . '" />';
		$form .= Xml::SubmitButton( 'Invite' );
		$form .= Xml::closeElement( 'form' );
		$form .= $this->fenye();
		$wgOut->addHTML( $form );
	}

	private function fenye() {
		$out = '<script>
		var theTable = document.getElementById("table2");
		var totalPage = document.getElementById("spanTotalPage");
		var pageNum = document.getElementById("spanPageNum");
 
		var spanPre = document.getElementById("spanPre");
		var spanNext = document.getElementById("spanNext");
		var spanFirst = document.getElementById("spanFirst");
		var spanLast = document.getElementById("spanLast");

		var numberRowsInTable = theTable.rows.length;
		var pageSize = 3;
		var page = 1;


		function next() {

		hideTable();
    
		currentRow = pageSize * page;
		maxRow = currentRow + pageSize;
		if ( maxRow > numberRowsInTable ) maxRow = numberRowsInTable;
		for ( var i = currentRow; i< maxRow; i++ ) {
        	theTable.rows[i].style.display = "";
    		}
	        page++;

		if ( maxRow == numberRowsInTable )  { nextText(); lastText(); }
    		showPage();    
		preLink();
		firstLink();
		}

		function pre() {

	        hideTable();
    
		    page--;
    
		    currentRow = pageSize * page;
		    maxRow = currentRow - pageSize;
		    if ( currentRow > numberRowsInTable ) currentRow = numberRowsInTable;
		    for ( var i = maxRow; i< currentRow; i++ ) {
		        theTable.rows[i].style.display = "";
		    }
    
    
		    if ( maxRow == 0 ) { preText(); firstText(); }
		    showPage();
		    nextLink();
		    lastLink();
		}
		
		function first() {
		    hideTable();
		    page = 1;
		    for ( var i = 0; i<pageSize; i++ ) {
		        theTable.rows[i].style.display = "";
		    }
		    showPage();
		    
		    preText();
		    nextLink();	
		    lastLink();
		}

		function last() {
		    hideTable();
		    page = pageCount();
		    currentRow = pageSize * (page - 1);
		    for ( var i = currentRow; i<numberRowsInTable; i++ ) {
		        theTable.rows[i].style.display = "";
		    }
		    showPage();
    	
		    preLink();
		    nextText();
		    firstLink();
		}
		
		function hideTable() {
		    for ( var i = 0; i<numberRowsInTable; i++ ) {
		        theTable.rows[i].style.display = "none";
		    }
		}
	
		function showPage() {
		    pageNum.innerHTML = page;
		}
		
		function pageCount() {
		    var count = 0;
		    if ( numberRowsInTable%pageSize != 0 ) count = 1; 
		    return parseInt(numberRowsInTable/pageSize) + count;
		}
		
		function preLink() { spanPre.innerHTML = "<a href=\"javascript:pre();\">Pre</a>"; }
		function preText() { spanPre.innerHTML = "Pre"; }
		
		function nextLink() { spanNext.innerHTML = "<a href=\"javascript:next();\">Next</a>"; }
		function nextText() { spanNext.innerHTML = "Next"; }
		
		function firstLink() { spanFirst.innerHTML = "<a href=\"javascript:first();\">First</a>"; }
		function firstText() { spanFirst.innerHTML = "First"; }
		
		function lastLink() { spanLast.innerHTML = "<a href=\"javascript:last();\">Last</a>"; }
		function lastText() { spanLast.innerHTML = "Last"; }
		
		function hide() {
		    for ( var i = pageSize; i<numberRowsInTable; i++ ) {
		        theTable.rows[i].style.display = "none";
		    }
		 
		    totalPage.innerHTML = pageCount();
		pageNum.innerHTML = "1";
    
		    nextLink();
		    lastLink();
		}

		hide();
		</script>';
		return $out; 
        }
}
?>
