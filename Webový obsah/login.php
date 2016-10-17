<?php
		session_start();
		if(isset($_POST['jmeno']) || $_POST['heslo'])
		{
			$username = $_POST['jmeno'];
			$password = $_POST['heslo'];
			$connect = mysql_connect('mysql.own.cz', 'own_jmail', '891219');		
			mysql_select_db('own_jmail', $connect) or die(mysql_error());
			$query = "(SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password')";
			$result = mysql_query($query) or die (mysql_error());
			if(mysql_num_rows($result) == 1)
			{
				$_SESSION = true;
    		header('Location: webmail.php');	              
    	}
    
			else
			{	
				$err = 'Špatné uživatelské jméno nebo heslo!';
				 
			}
			echo $err;
			echo '<br>';
			echo '<br>';			
			echo '<a href="index.php">Zpìt na hlavní stránku</a>';
		}	 	
?>