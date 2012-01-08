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
                                mysql_query('UPDATE ' .$cc_conf_wb. ' SET weibo="' .$this->sina.','.$this->tencent .'",time="' .$this->time. '" WHERE page_name="' .$this->page_name. '"');
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

		$form .= Xml::openElement( 'form', array( 'name' => 'form1', 'method' => 'get', 'action' => 'http://' .$ccHost. ':' .$ccPort. '/' .$ccSite .'/index.php/Special:ConfigureWeibo' ));
		$form .= '<input type="hidden" name="page_name" value="' .$page_name. '" /><br />';
		$form .= '<input type="checkbox" name="sina" value="sina"><img height="50" width="100" src="http://www.ekesn.com/producer/1/sz21/1/fckeditor/13021409731.jpg" /></input> &nbsp';
		$form .= '<input type="checkbox" name="tencent" value="tencent"><img height="40" width="100" src="http://open.t.qq.com/images/resource/p9.gif" /></input> &nbsp';
		$form .= '<input type="checkbox" name="wangyi" value="wangyi"><img height="50" width="100" src="http://img1.cache.netease.com/cnews/img/wblogostandard/logo5.png" /></input> &nbsp';
		$form .= '<input type="checkbox" name="ifeng" value="ifeng"><img height="50" width="100" src="http://www.budeyan.com/wp-content/uploads/2010/07/ifeng-logo.png" /></input> &nbsp';
		$form .= '<input type="checkbox" name="souhu value="souhu"><img height="50" width="100" src="http://www.w010w.com.cn/upimg/userup/1004/1614345T196.jpg" /></input><br /><br /><br />';
		$form .= $this->selectTime().'<br />';
                $form .= 'Select Date: <input type="text" name="time" id="date-input" /><br /><br />';
		$form .= Xml::submitButton( 'OK' );
		$form .= Xml::closeElement( 'form' );
		$form .= '</filedset>';
		return $form; 
	}

        private function selectTime() {
                $out = '<style>
.date-picker-wp {
display: none;
position: absolute;
background: #f1f1f1;
left: 40px;
top: 40px;
border-top: 4px solid #3879d9;
}
.date-picker-wp table {
border: 1px solid #ddd;
}
.date-picker-wp td {
background: #fafafa;
width: 22px;
height: 18px;
border: 1px solid #ccc;
font-size: 12px;
text-align: center;
}
.date-picker-wp td.noborder {
border: none;
background: none;
}
.date-picker-wp td a {
color: #1c93c4;
text-decoration: none;
}
.strong {font-weight: bold}
.hand {cursor: pointer; color: #3879d9}
</style>
  <script type="text/javascript">
var DatePicker = function () {
var $ = function (i) {return document.getElementById(i)},
addEvent = function (o, e, f) {o.addEventListener ? o.addEventListener(e, f, false) : o.attachEvent("on"+e, function(){f.call(o)})},
getPos = function (el) {
for (var pos = {x:0, y:0}; el; el = el.offsetParent) {
pos.x += el.offsetLeft;
pos.y += el.offsetTop;
}
return pos;
}
var init = function (n, config) {
window[n] = this;
Date.prototype._fd = function () {var d = new Date(this); d.setDate(1); return d.getDay()};
Date.prototype._fc = function () {var d1 = new Date(this), d2 = new Date(this); d1.setDate(1); d2.setDate(1); d2.setMonth(d2.getMonth()+1); return (d2-d1)/86400000;};
this.n = n;
this.config = config;
this.D = new Date;
this.el = $(config.inputId);
this.el.title = this.n+"DatePicker";
this.update();
this.bind();
}
init.prototype = {
update : function (y, m) {
var con = [], week = ["Su","Mo","Tu","We","Th","Fr","Sa"], D = this.D, _this = this;
fn = function (a, b) {return "<td title=\""+_this.n+"DatePicker\" class=\"noborder hand\" onclick=\""+_this.n+".update("+a+")\">"+b+"</td>"},
_html = "<table cellpadding=0 cellspacing=2>";
y && D.setYear(D.getFullYear() + y);
m && D.setMonth(D.getMonth() + m);
var year = D.getFullYear(), month = D.getMonth() + 1, date = D.getDate();
for (var i=0; i<week.length; i++) con.push("<td title=\""+this.n+"DatePicker\" class=\"noborder\">"+week[i]+"</td>");
for (var i=0; i<D._fd(); i++ ) con.push("<td title=\""+this.n+"DatePicker\" class=\"noborder\"> </td>");
for (var i=0; i<D._fc(); i++ ) con.push("<td class=\"hand\" onclick=\""+this.n+".fillInput("+year+", "+month+", "+(i+1)+")\">"+(i+1)+"</td>");
var toend = con.length%7;
if (toend != 0) for (var i=0; i<7-toend; i++) con.push("<td class=\"noborder\"> </td>");
_html += "<tr>"+fn("-1, null", "<<")+fn("null, -1", "<")+"<td title=\""+this.n+"DatePicker\" colspan=3 class=\"strong\">"+year+"/"+month+"/"+date+"</td>"+fn("null, 1", ">")+fn("1, null", ">>")+"</tr>";
for (var i=0; i<con.length; i++) _html += (i==0 ? "<tr>" : i%7==0 ? "</tr><tr>" : "") + con[i] + (i == con.length-1 ? "</tr>" : "");
!!this.box ? this.box.innerHTML = _html : this.createBox(_html);
},
fillInput : function (y, m, d) {
var s = this.config.seprator || "/";
this.el.value = y + s + m + s + d;
this.box.style.display = "none";
},
show : function () {
var s = this.box.style, is = this.mask.style;
s["left"] = is["left"] = getPos(this.el).x + "px";
s["top"] = is["top"] = getPos(this.el).y + this.el.offsetHeight + "px";
s["display"] = is["display"] = "block";
is["width"] = this.box.offsetWidth - 2 + "px";
is["height"] = this.box.offsetHeight - 2 + "px";
},
hide : function () {
this.box.style.display = "none";
this.mask.style.display = "none";
},
bind : function () {
var _this = this;
addEvent(document, "click", function (e) {
e = e || window.event;
var t = e.target || e.srcElement;
if (t.title != _this.n+"DatePicker") {_this.hide()} else {_this.show()}
})
},
createBox : function (html) {
var box = this.box = document.createElement("div"), mask = this.mask = document.createElement("iframe");
box.className = this.config.className || "datepicker";
mask.src = "javascript:false";
mask.frameBorder = 0;
box.style.cssText = "position:absolute;display:none;z-index:9999";
mask.style.cssText = "position:absolute;display:none;z-index:9998";
box.title = this.n+"DatePicker";
box.innerHTML = html;
document.body.appendChild(box);
document.body.appendChild(mask);
return box;
}
}
return init;
}();
onload = function () {
new DatePicker("_DatePicker_demo", {
inputId: "date-input",
className: "date-picker-wp",
seprator: "-"
});
new DatePicker("_demo2", {inputId: "demo2", className: "date-picker-wp"})
}
</script>';
                return $out;
        }
}
?>
