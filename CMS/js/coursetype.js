	function getcoursetype(cid)
	{
		var xmlhttp;
		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		   //alert(xmlhttp.responseText);
		    document.getElementById("subject_area").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","ajax_subject_type.php?cid=" + cid,true);
		xmlhttp.send();
		}