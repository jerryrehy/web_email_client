function reinsert(form)
{
	if(form.jmeno.value == "")
	{
		form.jmeno.value = "Vlo�teVa�eJm�no";
	}	
}

function inserting(form)
{
	form.jmeno.value = "Vlo�teVa�eJm�no";
	form.heslo.value = "";
}

function clrjmeno(form)
{
	if (form.jmeno.value == "Vlo�teVa�eJm�no")
	{ 
		form.jmeno.value = "";
	}	
}

function message()
{
	alert("Byl jste �sp�n� odhl�en...")
}

function dontletme(form)
{
	if (form.jmeno.value == "" || form.heslo.value == "")
	{
			alert("Mus�te vyplnit p�ihla�ovac� �daje...")
			return false;
	}
}