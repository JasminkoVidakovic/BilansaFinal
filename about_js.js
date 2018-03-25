	function UcitajXML() 
	{
		var xhttp = new XMLHttpRequest();
	
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				PopuniTabelu(this);
			}
		};
	
		xhttp.open("GET", 'TabelaXML.xml', true);
		xhttp.send();
	}
 
 
	function PopuniTabelu(xml) 
	{
		var xmlDoc = xml.responseXML;
		
		var i, j;
		
		var rast = document.getElementById('rast');
		var ocjene = document.getElementById('ocjene');
		var prosjek = document.getElementById('prosjek');
		
		
		var x = xmlDoc.getElementsByTagName("Kriterij");
		
		for (i = 0; i <x.length; i++)  							// i = 2 , j = 3 za slucaj moje tabele sad
		{ 
			var y = x[i].getElementsByTagName("Vrijednost"); // [0].childNodes[0].nodeValue;
	
			if(i==0)
			{
				for(j=0; j < y.length; j++)
				{
					rast.getElementsByTagName('td')[j].innerHTML = "1";//y[j].childNodes[0].nodeValue;  // broj celija jednak broju j-ova
				}
			}
			
			else if(i==1)
			{
				for(j=0; j < y.length; j++)
				{
					ocjene.getElementsByTagName('td')[j].innerHTML = "2";//y[j].childNodes[0].nodeValue;
				}
			}
			
			else if(i==2)
			{
				for(j=0; j < y.length; j++)
				{
					prosjek.getElementsByTagName('td')[j].innerHTML = "3";//y[j].childNodes[0].nodeValue;
				}
			}

		}

	}
  
