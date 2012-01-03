function loadXMLDoc(url){
	var xmlDoc;
	try{ 
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
	}catch(e)
	{
		try{ 
			var oXmlHttp = new XMLHttpRequest();
			oXmlHttp.open("GET",url,false);
			oXmlHttp.send(null);
			return oXmlHttp.responseXML;
		}catch(e){
			return;
		}
	}
	xmlDoc.async=false;
	xmlDoc.load(url);
	return xmlDoc;
}

function showFriend(xmlFile)
{
	xmlDoc=loadXMLDoc(xmlFile);
	var result = ""; 

	for(k=0;k<xmlDoc.getElementsByTagName("user").length;k++)
	{
		x=xmlDoc.getElementsByTagName("user")[k].childNodes;
		y=xmlDoc.getElementsByTagName("user")[k].firstChild;

		for(i=0;i<x.length;i++)
		{
			if(y.nodeType==1)
			{
				result = result + (y.nodeName + ":" + y.childNodes[0].nodeValue + " ");
			}
			y=y.nextSibling;
		}
		result = result + "<br />";
	}

	return result;
}

function sendMessage()
{
alert("clicked!");
}
