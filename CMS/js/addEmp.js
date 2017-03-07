/**
 * @author DEV_15
 */
 function showEmail(str)
	{
		//alert(str);
		var xmlhttp; 
		var useremail = document.getElementById('user_name').value;
		if(useremail=""){
			alert('Please Provide your User Loginid');
		 	document.getElementById("user_name").focus();
		 	return false;
		}
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
		 var showdata = xmlhttp.responseText;
		 if(showdata == 0){
		 	document.getElementById("user_password").focus();
		 }
		 else{
			alert('Someone has already this User Loginid...');
		 	document.getElementById("user_name").focus();
		    document.getElementById("user_name").value ="";
		 }
		}
	  }
	xmlhttp.open("GET","getmail.php?email="+str ,true);
		xmlhttp.send();
	}
	// For Previoue working 
   function pvswrkvalue(str)
	{ 
		var comp_name=document.getElementById("comp_name").value;
		var work_desiganation=document.getElementById("work_desiganation").value;  
		var from_dt=document.getElementById("from_dt").value;
		var to_dt=document.getElementById("to_dt").value;
		var res_of_lvng=document.getElementById("res_of_lvng").value;
		if(comp_name=="")
			{
				alert("Please Type Company Name");
				document.getElementById("comp_name").focus(); 
				return false;
			}
		if(work_desiganation=='')
			{
				alert("Please Enter Designation"); 
				document.getElementById("work_desiganation").focus(); 
				return false;
			}
		if(from_dt=='')
			{
				alert("Please select From Date");
				document.getElementById("from_dt").focus();  
				return false;
			}
		if(to_dt=='')
			{
				alert("Please select To Date");
				document.getElementById("to_dt").focus();  
				return false;
			}
		// if(desc=='')
			// {
				// alert("Please Enter Description");
				// document.getElementById("description").focus();  
				// return false;
			// }

		//alert("Index: " + y[x].index + " is " + y[x].text);
		//alert(str);
		//alert(yer);
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
		 		document.getElementById("pvswrk").innerHTML=xmlhttp.responseText;
				document.getElementById("comp_name").value=""; 
				document.getElementById("work_desiganation").value=""; 
				document.getElementById("from_dt").value=""; 
				document.getElementById("to_dt").value=""; 
				document.getElementById("res_of_lvng").value=""; 
		}
	  }
		xmlhttp.open("GET","pvswrk.php?comp_name=" + comp_name + "&work_desiganation=" + work_desiganation + "&from_dt=" + from_dt + "&to_dt=" + to_dt + "&res_of_lvng=" + res_of_lvng ,true);
		xmlhttp.send();
	}
	// For qualification
   function qulivalue(str)
	{ 
		
		var x=document.getElementById("education33").selectedIndex;
		var y=document.getElementById("education33").options;
		var edu=y[x].text;
		var x1=document.getElementById("year_of_pass").selectedIndex;
		var y1=document.getElementById("year_of_pass").options;
		var yer=y1[x1].text;
		var div=document.getElementById("divission").value;  
		var sub=document.getElementById("subject").value;
		var desc=document.getElementById("description").value;
		if(edu=="")
			{
				alert("Please Choose Qualification");
				return false;
			}
		if(yer=='')
			{
				alert("Please Choose Year of Passing"); 
				return false;
			}
		if(div=='')
			{
				alert("Please Enter your Division");
				document.getElementById("divission").focus();  
				return false;
			}
		if(sub=='')
			{
				alert("Please Enter Subject Name");
				document.getElementById("subject").focus();  
				return false;
			}
		// if(desc=='')
			// {
				// alert("Please Enter Description");
				// document.getElementById("description").focus();  
				// return false;
			// }

		//alert("Index: " + y[x].index + " is " + y[x].text);
		//alert(str);
		//alert(yer);
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
		 		document.getElementById("quli").innerHTML=xmlhttp.responseText;
				document.getElementById("divission").value=""; 
				document.getElementById("subject").value=""; 
				document.getElementById("description").value=""; 
		}
	  }
		xmlhttp.open("GET","qulification.php?edu=" + edu + "&yer=" + yer + "&div=" + div + "&sub=" + sub + "&desc=" + desc ,true);
		xmlhttp.send();
	}
	// Delete For Qualification 
   function delvalue(str)
	{ 
		//var x=document.getElementById("education33").selectedIndex;

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
		 		 document.getElementById("quli").innerHTML=xmlhttp.responseText;
		}
	  }
		xmlhttp.open("GET","del.php?delid=" + str,true);
		xmlhttp.send();
	}
	// Delete for Previous work
   function delpvsvalue(str)
	{ 
		//var x=document.getElementById("education33").selectedIndex;

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
		 		 document.getElementById("pvswrk").innerHTML=xmlhttp.responseText;
		}
	  }
		xmlhttp.open("GET","delpvs.php?delid=" + str,true);
		xmlhttp.send();
	}