var validName = false;
var validTel = false;
var validMail = false;
var validMsg = false;
var validGrade = false;

var regName = /^[a-zA-Z ]+$/;
var regTel = /^\(?[0]{1}[0-9]{2}(\/|\)) ?[0-9]{3}-[0-9]{3}$/; 
var regMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,8}$/; 
var regGrade = /^[0-5]{1}$/; 
var regMsg = /^^(?!\s*$).+$/;


function ValidateName()
{	
	CheckName();
	CheckPhone();
	CheckMail();
	CheckGrade();
	CheckMsg();

	if(validName==true && validTel == true && validMail == true && validMsg == true && validGrade == true)
	{	
		alert("Poruka uspješno poslana!");
		return true;
	}
	
	else 
	{
		alert("Popravite greške u unosima!");
		return false;
	}
}

function CheckName()
{
	var ime = document.getElementById('ime');
	
	if(regName.test(ime.value)==true)
	{	
		ime.style.backgroundColor="white";
		ime.setCustomValidity("");
		validName = true;
	}
	
	else
	{
		ime.style.backgroundColor="red";
		ime.setCustomValidity("Ovo polje može sadržavati samo velika/mala slova i razmak!");
		validName = false;
	}
	
}

function CheckPhone()
{
	var tel = document.getElementById('tel');
	
	if(regTel.test(tel.value)==true)
	{	
		tel.style.backgroundColor="white";
		tel.setCustomValidity("");
		validTel = true;
	}
	
	else
	{
		tel.style.backgroundColor="red";
		tel.setCustomValidity("Broj telefona u formatu 0xx/xxx-xxx, x moze biti samo cifra 0-9");
		validTel = false;
	}
	
}

function CheckMail()
{
	var mail = document.getElementById('email');
	
	if(regMail.test(mail.value)==true)
	{	
		mail.style.backgroundColor="white";
		mail.setCustomValidity("");
		validMail = true;
	}
	
	else
	{
		mail.style.backgroundColor="red";
		mail.setCustomValidity("Unesite validnu email adresu");
		validMail = false;
	}
	
}

function CheckGrade()
{
	var grade = document.getElementById('ocjena');
	
	if(regGrade.test(grade.value)==true)
	{	
		grade.style.backgroundColor="white";
		grade.setCustomValidity("");
		validGrade = true;
	}
	
	else
	{
		grade.style.backgroundColor="red";
		grade.setCustomValidity("Unesite brojeve 0-5");
		validGrade = false;
	}
}

function CheckMsg()
{
	var msg = document.getElementById('poruka');
	
	if(regMsg.test(msg.value)==true || msg.value.length != 0)
	{	
		msg.style.backgroundColor="white";
		msg.setCustomValidity("");
		validMsg = true;
	}
	
	else
	{
		msg.style.backgroundColor="red";
		msg.setCustomValidity("Unesite neku poruku");
		validMsg = false;
	}
}




