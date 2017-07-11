	
<?php

session_start();
   

 if (isset($_COOKIE['id'])){header("location:main");exit;}
  
if ((isset($_POST['login'])) || (isset($_POST['haslo'])))
	
	{
	

	
			 $connection = @new mysqli("localhost","root", "", "baza");
//	mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    
	
	
	


    if ($connection->connect_error) {
       	echo "EEEEEEEE";
    } 
    else{

		$login = $_POST['login'];
		$password = $_POST['password'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
		
		
		if ($rezultat3 = @$connection->query(
		sprintf("SELECT * FROM 3_false WHERE login_uzytkownika='%s'",
		mysqli_real_escape_string($connection,$login))))
		
		{
			
			$ilu_userow3 = $rezultat3->num_rows;
				$wiersz3 = $rezultat3->fetch_assoc();
				$tmp3=$wiersz3['ilosc'];
		}
		

		if ($rezultat = @$connection->query(
		sprintf("SELECT * FROM uzytkownik WHERE login_uzytkownika='%s'",
		mysqli_real_escape_string($connection,$login))))    
        {
			
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow!=0)
			{
				$wiersz = $rezultat->fetch_assoc();

				if (password_verify($password, $wiersz['haslo_uzytkowinka']) and $tmp3<4)
				{

					echo $wiersz['imie_uzytkownika'];
					$id = md5(rand(-10000,10000).microtime()).md5(crc32(microtime()).$_SERVER['REMOTE_ADDR']);
					
					mysqli_query($connection, "delete from 3_false where login_uzytkownika='$wiersz[login_uzytkownika]'"); 	
					mysqli_query($connection, "delete from sesja where id = '$wiersz[id_uzytkownika]';"); 	
					mysqli_query($connection, "insert into log(id_log,ip, czas, przegladarka) values (NULL,'$_SERVER[REMOTE_ADDR]',CURRENT_TIMESTAMP,'$_SERVER[HTTP_USER_AGENT]')");
					mysqli_query($connection, "insert into sesja (id_sesji,id_uzytkownika, id, ip, web,time) values (NULL,'$wiersz[id_uzytkownika]','$id','$_SERVER[REMOTE_ADDR]','$_SERVER[HTTP_USER_AGENT]', CURRENT_TIMESTAMP)");
            
					if (! mysqli_errno($connection))
					{
						setcookie("id", $id);
						echo "zalogowano pomyślnie!";

					   header("location:main");
					} 
					else 
					{
						 	
						echo "błąd podczas logowania!";
						$_SESSION['blad'] = '<span style="color:red"><center><br />Nieprawidłowy login lub hasło!</center></span>';
						//	echo mysqli_error($connection);
					}
				
				}			

 else 
        {
			
			if ($rezultat2 = @$connection->query(
		sprintf("SELECT * FROM 3_false WHERE login_uzytkownika='%s'",
		mysqli_real_escape_string($connection,$login))))  
			
			
		{	
				$ilu_userow2 = $rezultat2->num_rows;
				$wiersz2 = $rezultat2->fetch_assoc();
				$tmp2=$wiersz2['ilosc'];

				if($ilu_userow2==0)
				{
			mysqli_query($connection, "insert into 3_false(id_false, login_uzytkownika, ilosc,time) values (NULL,'$wiersz[login_uzytkownika]', 1, CURRENT_TIMESTAMP)");
			$_SESSION['blad'] = '<span style="color:red"><center><br />Nieprawidłowy login lub hasło!</center></span>';
				}
				if($tmp2>0 and $tmp2<4)
				{
				mysqli_query($connection, "UPDATE 3_false SET ilosc=ilosc+1 WHERE login_uzytkownika='$wiersz[login_uzytkownika]'");	
				$_SESSION['blad'] = '<span style="color:red"><center><br />Nieprawidłowy login lub hasło!</center></span>';
				}
				if($tmp2>3)
				{
					$_SESSION['blad'] = '<span style="color:red"><center><br />Zbyt dużo razy podałeś błędne hasło. Prosimy wrócić za kilka minut!</center></span>';
				}
		}


	   } 
				
			}

        else 
        {
			$_SESSION['blad'] = '<span style="color:red"><center><br />Nieprawidłowy login lub hasło!</center></span>';
        } 


		}
		
		else 
        {
			$_SESSION['blad'] = '<span style="color:red"><center><br />Nieprawidłowy login lub hasło!</center></span>';
        } 
	} 
	
	
	$connection->close();
	
	}
?>




<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="http://ciasteczka.eu/cookiesEU-latest.min.js"></script>
	
	
	<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery.fn.cookiesEU();
});

</script>
<title>eFridge.pl</title>



         <link rel="stylesheet" href="css/style.css">
    
	
	
</head>

<body>





<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>e<span>Fridge</span></div>
		</div>
		<br>

		<div class="login">
		<?php
	if(($_SESSION['rejestracja'])==true)
	{
	echo "Zostałeś zarejestrowany, możesz się zalogować";
	$_SESSION['rejestracja']=false;}
?>
 <form method="post"> 
				<input type="text" placeholder="login" name="login"><br>
				<input type="password" placeholder="haslo" name="password"><br>
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
unset($_SESSION['blad']);
?>
				<input type="submit" value="Login"><br>
				<a href="rejestracja"><input type="button" value="Nie masz konta? Zarejestruj się!" /></a>

 </form>
		</div>



























     
 
</body>
</html>