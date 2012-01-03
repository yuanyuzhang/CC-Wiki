/*
*********************
PageNav ver1.0
author:Keel (keel.sike@gmail.com)
*********************
*/
var pageNav=pageNav||{};pageNav.fn=null;pageNav.pre="pre";pageNav.next="next";pageNav.nav=function(p,pn){if(pn<=1){this.p=1;this.pn=1;return this.pHtml2(1);}
if(pn<p){p=pn;};var re="";if(p<=1){p=1;}else{re+=this.pHtml(p-1,pn,pageNav.pre);re+=this.pHtml(1,pn,"1");}
this.p=p;this.pn=pn;var start=2;var end=(pn<9)?pn:9;if(p>=7){re+="...";start=p-4;var e=p+4;end=(pn<e)?pn:e;}
for(var i=start;i<p;i++){re+=this.pHtml(i,pn);};re+=this.pHtml2(p);for(var i=p+1;i<=end;i++){re+=this.pHtml(i,pn);};if(end<pn){re+="...";};if(p<pn){re+=this.pHtml(p+1,pn,pageNav.next);};return re;};pageNav.pHtml=function(pageNo,pn,showPageNo){showPageNo=showPageNo||pageNo;var H=" <a href='javascript:pageNav.go("+pageNo+","+pn+");' class='pageNum'>"+showPageNo+"</a> ";return H;};pageNav.pHtml2=function(pageNo){var H=" <span class='cPageNum'>"+pageNo+"</span> ";return H;};pageNav.go=function(p,pn){$("#pageNav").html(this.nav(p,pn));if(this.fn!=null){this.fn(this.p,this.pn);};};

