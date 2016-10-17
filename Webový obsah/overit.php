<?php
	if(isset($_POST['jmeno']) || $_POST['heslo'])
	{
		$jmeno = $_POST['jmeno'];
		$heslo = sha1($_POST['heslo']);	
		
		$connect = mysql_connect('mysql.own.cz', 'own_jmail', '891219');		
		mysql_select_db('own_jmail', $connect) or die(mysql_error());
		
		$query = "SELECT * FROM `users` WHERE `username` = '$jmeno' AND `password` = '$heslo' ";
		$vysledek = mysql_query($query) or die(mysql_error());
		
		$promena = sha1($_POST['jmeno']);
		$serv = $_POST['sel'];
		$radek = mysql_fetch_row($vysledek);
		$adresa = $radek[2];
		
		if(mysql_num_rows($vysledek) == 1)
		{
			if(isset($_POST['stay']))
			{
				setcookie('pamatovak', $promena, Time() + 86400);
				setcookie('adresa', $adresa, Time() + 86400);
				setcookie('jmeno', $jmeno, Time() + 86400);
				setcookie('heslo', $heslo, Time() + 86400);
				setcookie('server', $serv, Time() + 86400);
				
				header('Location: webmail.php?view=0&drobek=Jste pøihlášen...');			
			}
			else
			{
				setcookie('pamatovak', $promena, Time() + 60 * 5) ;
				setcookie('adresa', $adresa, Time() + 60 * 5);
				setcookie('jmeno', $jmeno, Time() + 60 * 5);
				setcookie('heslo', $heslo, Time() + 60 * 5);
				setcookie('server', $serv, Time() + 60 * 5);
				
				header('Location: webmail.php?view=0&drobek=Jste pøihlášen...');	
			}	
		}
		else
		{
			$chyba = 'Špatnì jste zadali jméno nebo heslo!';
			echo $chyba."<br>";
			echo "<a href=\"index.php\">Zpet na hlavní stranu</a>";	
		}		
	}
?>