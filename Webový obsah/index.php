<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
  	<meta http-equiv="content-type" content="text/html; charset=windows-1250">
  	<meta name="generator" content="PSPad editor, www.pspad.com">
  	<link rel="icon" type="image/ico" href="jmail.ico">
		<link href="loginstyle.css" media="screen" rel="stylesheet" type="text/css">
		<script type="application/x-javascript" src="loginscript.js"></script>
		<title>P�ihl�en�</title>
  </head>
  
	<body onload="inserting(formular);">
  <?php
		if(!isset($_COOKIE['pamatovak']))
		{	
  		echo "<h1>P�ihl�en� do emailov� schr�nky</h1>";
		
			echo "<div id=\"login\">";
			echo "<form id=\"inside\" name=\"formular\" action=\"overit.php\" method=\"post\" onsubmit=\"return dontletme(formular);\">";
  		echo "Jm�no: <input name=\"jmeno\" id=\"name\" type=\"text\" onblur=\"reinsert(formular);\" onClick=\"clrjmeno(formular);\" title=\"Zde zadejte sv� p�ihla�ovac� jm�no\"> <br>";
  		echo "Heslo : <input name=\"heslo\" id=\"passw\" type=\"password\" title=\"Zde zadejte sv� heslo\"><br><br>";
  		echo "Z�stat p�ihl�en: <input type=\"checkbox\" name=\"stay\" value=\"stay\"><br><br>";
  		echo "Server: <select name=\"sel\">";
  		echo "<option selected=\"{imap.gmail.com:993/imap/ssl}\" value=\"{imap.gmail.com:993/imap/ssl}\">Gmail.com</option>";
  		echo "<option value=\"{imap.seznam.cz:993/imap/ssl}\">Seznam.cz</option>";
			echo "</select>";
  		echo "<input id=\"sub\" type=\"submit\" value=\"Login\" title=\"Stisknut�m tohoto tla��tka se p�ihl�s�te\">";
			echo "</form>";                                                                                                     
  	  echo "</div>";
  	}
  	else
		{
			header('Location: webmail.php?view=0&drobek=Jste p�ihl�en...');
		}
  ?>
	</body>								 
</html>