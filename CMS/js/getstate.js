var xmlhttp;
	function getSatae(country_id)
	{
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
		  alert ("Browser does not support HTTP Request");
		  return;
		}
		var url="get-state-js.php";
		url=url+"?country_id="+country_id;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=GameGameId;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
	function GameGameId()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("get_state").style.visibility="visible";
			document.getElementById("get_state").style.display="block";
			document.getElementById("get_state").innerHTML=xmlhttp.responseText;
		}
	}
	
function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
	  	{
	     	// code for IE7+, Firefox, Chrome, Opera, Safari
	  		return new XMLHttpRequest();
	  	}
		if (window.ActiveXObject)
	  	{
	 		 // code for IE6, IE5
	  		return new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		return null;
	}