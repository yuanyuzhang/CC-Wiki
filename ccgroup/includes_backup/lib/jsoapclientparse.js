function parse(data)
{
	try
	{
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = "false";
		xmlDoc.loadXML(data);
	}
	catch(e)
	{
		try
		{
			parser = new DOMParser();
			xmlDoc = parser.parseFromString(data,"text/xml");
		}
		catch(e)
		{
			alert(e.message);
		}
	}
	return xmlDoc.getElementsByTagName("return")[0].childNodes[0].nodeValue;
}
