<?php
	$from = $_POST['odkoho'];
	if($from == "")
	{
		$from = $_COOKIE['adresa'];
	}
	$to = $_POST['komu'];
	$subject = $_POST['predmet'];
	$message = $_POST['mess'];
	$text = str_replace("\n.", "\n..", $message);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From:' .$from."\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$sent = imap_mail($to,$subject,$text,$headers);
	if ($sent == TRUE)
	{
		header('Location: webmail.php?view=0&drobek=Email úspìšnì odeslán');
	}
	else
	{
		echo "Email nebyl odeslán";
	}					
?>
																														 