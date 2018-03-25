 function suggestMe(text_box) 
 {
	var unos = text_box.value;
 
	if (unos.length == 0) 
	{ 
        document.getElementById("ovdje_se_prikazi").innerHTML = "";
        return;
    } 
	else 
	{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (this.readyState == 4 && this.status == 200) 
			{
                document.getElementById("ovdje_se_prikazi").innerHTML = this.responseText;
            }
        };
		
        xmlhttp.open("GET", "admin_search.php?upit=" + unos, true);
        xmlhttp.send();
    }
}