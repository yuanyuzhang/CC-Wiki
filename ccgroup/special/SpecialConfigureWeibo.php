<?php
include ( '../conf.php');

class SpecialConfigureWeibo extends SpecialPage {    

 	function __construct() {
        	parent::__construct( 'ConfigureWeibo' );
    	}

    	function execute( $par ) {
         	global $wgRequest, $wgOut;
		global $ccHost, $ccPort, $ccSite;
		global $ccDB, $ccDBUsername, $ccDBPassword, $ccDBName, $cc_conf_wb;

        	$this->setHeaders();
	
		$this->page_name = $wgRequest->getText( 'page_name' );
                $this->sina = $wgRequest->getText( 'sina' );
                $this->tencent = $wgRequest->getText( 'tencent' );
		$this->year = $wgRequest->getText( 'YYYY' );
                $this->month = $wgRequest->getText( 'MM' );
                $this->day = $wgRequest->getText( 'DD' );

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
                                mysql_query('UPDATE ' .$cc_conf_wb. ' SET weibo="' .$this->sina.','.$this->tencent .'",time="' .$this->year. '-' .$this->month. '-' .$this->day. '" WHERE page_name="' .$this->page_name. '"');
                                mysql_close( $con );
                        }
                        else{
                                 //insert
                                $dbw = wfGetDB( DB_MASTER );
                                $dbw->insert( 'cc_conf_wb', array('page_name' => $this->page_name, 'weibo' => $this->sina.','.$this->tencent, 'time' => $this->year. '-' .$this->month. '-' .$this->day ), __METHOD__, 'IGNORE');
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

		$form .= Xml::openElement( 'form', array( 'name' => 'form1', 'method' => 'get', 'action' => 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite .'/index.php/Special:ConfigureWeibo' ));
		$form .= '<input type="hidden" name="page_name" value="' .$page_name. '" /><br />';
		$form .= '<input type="checkbox" name="sina" value="sina"><img height="50" width="100" src="http://www.ekesn.com/producer/1/sz21/1/fckeditor/13021409731.jpg" /></input> &nbsp';
		$form .= '<input type="checkbox" name="tencent" value="tencent"><img height="40" width="100" src="http://open.t.qq.com/images/resource/p9.gif" /></input> &nbsp';
		$form .= '<input type="checkbox" name="wangyi" value="wangyi"><img height="50" width="100" src="http://img1.cache.netease.com/cnews/img/wblogostandard/logo5.png" /></input> &nbsp';
		$form .= '<input type="checkbox" name="ifeng" value="ifeng"><img height="50" width="100" src="http://www.budeyan.com/wp-content/uploads/2010/07/ifeng-logo.png" /></input> &nbsp';
		$form .= '<input type="checkbox" name="souhu value="souhu"><img height="50" width="100" src="http://www.w010w.com.cn/upimg/userup/1004/1614345T196.jpg" /></input><br /><br />';
		$form .= 'Select Time:
                        <select    name="YYYY"    onchange="YYYYDD(this.value)">   
                        <option    value="">=year=</option>   
                        </select>   
                        <select    name="MM"        onchange="MMDD(this.value)">   
                        <option    value="">=month=</option>   
                        </select>   
                        <select    name="DD">   
                        <option    value="">=day=</option>   
                        </select><br /><br />';
		$form .= Xml::submitButton( 'OK' );
		$form .= Xml::closeElement( 'form' );
		$form .= '</filedset>';
		$form .= $this->changeDate();
		return $form; 
	}

	private function changeDate() {
                $out = '<script    language="JavaScript">
   function    YYYYMMDDstart()   
   {   
           MonHead    =    [31,    28,    31,    30,    31,    30,    31,    31,    30,    31,    30,    31];   
    
           var    y        =    new    Date().getFullYear();   
           for    (var    i    =    (y-3);    i    <    (y+30);    i++) 
                   document.form1.YYYY.options.add(new    Option(""+i,  i));   
    
           for    (var    i    =    1;    i    <    13;    i++)   
                   document.form1.MM.options.add(new    Option( ""+i,   i));   
    
           var    n    =    MonHead[new    Date().getMonth()];   
           if    (new    Date().getMonth()    ==1    &&    IsPinYear(YYYYvalue))    n++;   
                   writeDay(n);   
   }   
   if(document.attachEvent)   
       window.attachEvent("onload",    YYYYMMDDstart);   
   else   
       window.addEventListener("load",    YYYYMMDDstart,    false);   
   function    YYYYDD(str)       
   {   
           var    MMvalue    =    document.form1.MM.options[document.form1.MM.selectedIndex].value;   
           if    (MMvalue    ==    ""){    var    e    =    document.form1.DD;    optionsClear(e);    return;}   
           var    n    =    MonHead[MMvalue    -    1];   
           if    (MMvalue    ==2    &&    IsPinYear(str))    n++;   
                   writeDay(n)   
   }   
   function    MMDD(str)        
   {   
           var    YYYYvalue    =    document.form1.YYYY.options[document.form1.YYYY.selectedIndex].value;   
           if    (YYYYvalue    ==    ""){    var    e    =    document.form1.DD;    optionsClear(e);    return;}   
           var    n    =    MonHead[str    -    1];   
           if    (str    ==2    &&    IsPinYear(YYYYvalue))    n++;
                   writeDay(n)   
   }   
   function    writeDay(n)      
   {   
           var    e    =    document.form1.DD;    optionsClear(e);   
           for    (var    i=1;    i<(n+1);    i++)   
                   e.options.add(new    Option(""+i,    i));   
   }   
   function    IsPinYear(year)  
   {        return(0    ==    year%4    &&    (year%100    !=0    ||    year%400    ==    0));}   
   function    optionsClear(e)   
   {   
           e.options.length    =    1;   
   }   
   </script>';
                return $out;
        }
}
?>
