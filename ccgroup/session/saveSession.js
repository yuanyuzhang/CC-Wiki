function saveSession(page_name, gbTitle, gbImg, gbUrl, address) {
var url = "http://"+ccHost+":"+ccPort+"/"+ccSite+"/extensions/ccgroup/session/saveSession.php?page_name="+page_name+"&gbTitle="+gbTitle+"&gbImg="+gbImg+"&gbUrl="+gbUrl+"&address="+address+"&";
getContent("", url);
}
