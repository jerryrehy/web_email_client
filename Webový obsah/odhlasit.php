<?php
	if(isset($_COOKIE['pamatovak']))
	{
		setcookie('pamatovak',$promena, Time()- 3600);
		setcookie('adresa', $adresa, Time() - 3600);
		setcookie('jmeno', $jmeno, Time() - 3600);
		setcookie('heslo', $heslo, Time() - 3600);
		setcookie('server', $serv, Time() - 3600);
		header('Location: index.php');
		imap_close($mbox);
	}
	else
	{
		header('Location: index.php');
	}
?>