function reinsert(form)
{
	if(form.jmeno.value == "")
	{
		form.jmeno.value = "VložteVašeJméno";
	}	
}

function inserting(form)
{
	form.jmeno.value = "VložteVašeJméno";
	form.heslo.value = "";
}

function clrjmeno(form)
{
	if (form.jmeno.value == "VložteVašeJméno")
	{ 
		form.jmeno.value = "";
	}	
}

function message()
{
	alert("Byl jste úspìšnì odhlášen...")
}

function dontletme(form)
{
	if (form.jmeno.value == "" || form.heslo.value == "")
	{
			alert("Musíte vyplnit pøihlašovací údaje...")
			return false;
	}
}