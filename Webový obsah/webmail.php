<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  	<meta http-equiv="content-type" content="text/html; charset=windows-1250">
  	<meta name="generator" content="PSPad editor, www.pspad.com">
  	<link rel="icon" type="image/ico" href="jmail.ico">
		<link href="mailstyle.css" media="screen" rel="stylesheet" type="text/css">
		<script type="application/x-javascript" src="loginscript.js"></script>
		<title>Emailov� schr�nka</title>
  </head>
  <body>
		<div id="page">	
			<?php	
  			if(isset($_COOKIE['pamatovak']))
				{
					$jmeno = $_COOKIE['jmeno'];
					$heslo = $_COOKIE['heslo'];
				
					$connect = mysql_connect('mysql.own.cz', 'own_jmail', '891219');		
					mysql_select_db('own_jmail', $connect) or die(mysql_error());
				
					$query = "SELECT * FROM `users` WHERE `username` = '$jmeno' AND `password` = '$heslo' ";
					$vysledek = mysql_query($query) or die(mysql_error());
					$radek = mysql_fetch_row($vysledek);
				
					$username = $_COOKIE['adresa'];
					$password = $radek[4];
				
					$odesl= "";				
				
					$server = $_COOKIE['server'];
					
					if ($server == "{imap.gmail.com:993/imap/ssl}")
					{
						$odesl = '[Gmail]/Odeslan&AOE- po&AWE-ta';
					}
					if ($server == "{imap.seznam.cz:993/imap/ssl}")
					{
						$odesl = 'Sent';
					}
					
					imap_open($server, $username, $password, OP_HALFOPEN) or die(imap_errors());
				
					$drobek = $_GET["drobek"]; 
				
					echo "<h1>V�tejte ve sv� schr�nce !</h1>";	
  				echo "<div id=\"navi\">";
					echo "<div id=\"adresa\">$radek[0]</div>";
  				echo "<div id=\"back\"><a>U�iv. jm�no: $username</a></div>";
  				echo "<div id=\"next\">Adresa: $radek[2]</div>";
  				echo "</div>";
  				echo "<div id=\"menu\">";
					echo "<ul>";
					echo "<li><a href=\"webmail.php?view=5&drobek=Nov� email\">Nov� email</a></li>";
					//	echo "<li><a href=\"\">Smazat email</a></li>";
					echo "<li><a href=\"webmail.php?view=1&drobek=P�ijat�\">P�ijat� po�ta</a></li>";
					echo "<li><a href=\"webmail.php?view=4&drobek=Odeslan�\">Odeslan� po�ta</a></li>";
					echo "<li><a href=\"webmail.php?view=3&drobek=Seznam adres���\">Seznam slo�ek</a></li>";
					echo "</ul>";
					echo "</div>";
  				echo "<div id=\"drobek\">$drobek</div>";
  				echo "<div id=\"emails\">";
				
					$view = $_GET['view'];
				
					if ($view == 0){}
												
					if($view == 1)
					{	 
						$mbox = imap_open($server."INBOX", $username, $password) or die(imap_errors()); 
						$hlavicky = imap_search($mbox, 'ALL');
						$a = 0;
						if ($hlavicky != null){
							foreach($hlavicky as $headers)
							{
			    			$a = $a + 1;
			    			$b = $a - 1;
								$zprava = imap_fetch_overview($mbox, $headers);
								$from = $zprava[0] -> from;
								$from = imap_mime_header_decode($from);
								$from = $from[0] -> text;
								$subjekt = $zprava[0] -> subject;
								$subjekt = imap_mime_header_decode($subjekt);
								$subjekt = $subjekt[0] -> text;
							  echo "<a href=\"webmail.php?view=2&email_id=$hlavicky[$b]&drobek=Emaily&mbox=INBOX\">Od: $from,  P�edm�t: $subjekt </a><br>";				
							}
						}       
					}	
					
					if($view == 2)
					{
						$neco = $_GET['mbox'];
						if($neco == 1)
						{
							$neco = $odesl;
						}
						$mbox = imap_open("$server$neco", $username, $password);
						$email_id = $_GET['email_id'];
						$vypis = imap_headerinfo($mbox, $email_id, 20, 100);
						$adresa = $vypis -> fromaddress;
						$adresa = imap_mime_header_decode($adresa);
						$adresa = $adresa[0] -> text; 
						if(!isset($vypis -> subject))
						{
							$vypis -> subject = "Bez p�edm�tu";
						}
						$predmet = $vypis -> subject;
						$predmet = imap_mime_header_decode($predmet);
						$predmet = $predmet[0] -> text;
						$telo = imap_fetchbody($mbox,$email_id,'1.2');
						setlocale(LC_CTYPE, 'cs_CZ.UTF-8');
						$telo = iconv("ISO-8859-2", "ISO-8859-1//TRANSLIT", $telo);			
						$telo = imap_mime_header_decode($telo);
						$telo = $telo[0] -> text;
						if ($telo == null)
						{
							$telo = imap_fetchbody($mbox, $email_id, '1');
							setlocale(LC_CTYPE, 'cs_CZ.UTF-8');
							$telo = iconv("ISO-8859-2", "ISO-8859-1//TRANSLIT", $telo);
							$telo = imap_mime_header_decode($telo);
							$telo = $telo[0] -> text;
						}
						echo "<b>Od:</b> $adresa <br>";
						echo "<b>P�edm�t:</b> $predmet <br>";
						echo "<b>Zpr�va:</b><br> $telo <br>";
						if($neco == $odesl)
						{
							echo "<a href=\"webmail.php?view=4&drobek=Odeslan�\">Zpet na emaily</a>";
						}
						else
						{
							echo "<a href=\"webmail.php?view=1&drobek=P�ijat�\">Zpet na emaily</a>";
						}	
					}
					
					if($view == 3)
					{
						$serv = strtok($server, '/');
						$mbox = imap_open($server, $username, $password, OP_HALFOPEN) or die(imap_errors());
						$list = imap_listmailbox($mbox, "$serv[0].}", "*");
						foreach($list as $seznam)
						{
							setlocale(LC_CTYPE, 'cs_CZ.UTF-8');
							$seznam = mb_convert_encoding($seznam, 'ISO-8859-1', 'UTF7-IMAP');
							$seznam = iconv("ISO-8859-2", "ISO-8859-1//TRANSLIT", $seznam);
							echo $seznam."<br>";
						}
					}
					
					if($view == 4)
					{
						$mbox = imap_open("$server$odesl", $username, $password) or die(imap_errors());
						$hlavicky = imap_search($mbox, 'ALL');
						$a = 0;
						foreach ($hlavicky as $headers)
						{
							$a = $a + 1;
			    		$b = $a - 1;
							$zprava = imap_fetch_overview($mbox, $headers);
							$from = $zprava[0] -> from;
							$from = imap_mime_header_decode($from);
							$from = $from[0] -> text;
							if(!isset($zprava[0] -> subject))
							{
								$zprava[0] -> subject = "Bez p�edm�tu";
							}
							$subjekt = $zprava[0] -> subject;
							$subjekt = imap_mime_header_decode($subjekt);
							$subjekt = $subjekt[0] -> text;
							echo "<a href=\"webmail.php?view=2&email_id=$hlavicky[$b]&drobek=Emaily&mbox=1\">Od: $from,  P�edm�t: $subjekt </a><br>";			
						}				 
					}
				
					if($view == 5)
					{
						echo "<form name=\"sendmail\" method=\"post\" action=\"odeslatemail.php\">";
						echo "From: <input name=\"odkoho\" type=\"text\">";
						echo "To: <input name=\"komu\" type=\"text\">";
						echo "Subject: <input name=\"predmet\" type=\"text\"><br><br>";
						echo "Message: <textarea rows=\"10\" cols=\"80\" name=\"mess\" id=\"mesag\" type=\"text\"></textarea><br><br>";
						echo "<input type=\"submit\" value=\"Odeslat\">";
						echo "</form>";
					}
								
					echo "</div>";
  				echo "<div id=\"carka\"></div>";
					echo "<div id=\"zapati\">";
					echo "<div id=\"logout\"><a href=\"odhlasit.php\" onclick=\"message();\">ODHL��EN�</a></div>";
					echo "<div id=\"copyright\">COPYRIGHT Jaroslav �eh�k [TUL, FM, IT, 2011]</div>";
					echo "</div>";
				}
				else			
				{
					header('Location: index.php');
				}		
			?>
		</div>			
  </body>
</html>