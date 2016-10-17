<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
  	<meta http-equiv="content-type" content="text/html; charset=windows-1250">
  	<meta name="generator" content="PSPad editor, www.pspad.com">
  	<link rel="icon" type="image/ico" href="jmail.ico">
		<link href="loginstyle.css" media="screen" rel="stylesheet" type="text/css">
		<script type="application/x-javascript" src="loginscript.js"></script>
		<title>Přihlášení</title>
  </head>
  
	<body onload="inserting(formular);">
  <?php
		if(!isset($_COOKIE['pamatovak']))
		{	
  		echo "<h1>Přihlášení do emailové schránky</h1>";
		
			echo "<div id=\"login\">";
			echo "<form id=\"inside\" name=\"formular\" action=\"overit.php\" method=\"post\" onsubmit=\"return dontletme(formular);\">";
  		echo "Jméno: <input name=\"jmeno\" id=\"name\" type=\"text\" onblur=\"reinsert(formular);\" onClick=\"clrjmeno(formular);\" title=\"Zde zadejte své přihlašovací jméno\"> <br>";
  		echo "Heslo : <input name=\"heslo\" id=\"passw\" type=\"password\" title=\"Zde zadejte své heslo\"><br><br>";
  		echo "Zůstat přihlášen: <input type=\"checkbox\" name=\"stay\" value=\"stay\"><br><br>";
  		echo "Server: <select name=\"sel\">";
  		echo "<option selected=\"{imap.gmail.com:993/imap/ssl}\" value=\"{imap.gmail.com:993/imap/ssl}\">Gmail.com</option>";
  		echo "<option value=\"{imap.seznam.cz:993/imap/ssl}\">Seznam.cz</option>";
			echo "</select>";
  		echo "<input id=\"sub\" type=\"submit\" value=\"Login\" title=\"Stisknutím tohoto tlačítka se přihlásíte\">";
			echo "</form>";                                                                                                     
  	  echo "</div>";
  	}
  	else
		{
			header('Location: webmail.php?view=0&drobek=Jste přihlášen...');
		}
  ?>
	</body>								 
</html>