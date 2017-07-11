<?php

	session_start();
	
	if (isset($_COOKIE['id'])){header("location:main");exit;}

	if (isset($_POST['email']))
	{
	
		
		$wszystko_OK=true;

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];		
		$haslo2 = $_POST['haslo2'];	
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
		$haslo2 = htmlentities($haslo2, ENT_QUOTES, "UTF-8");		
		$imie = $_POST['imie'];	
		$nazwisko = $_POST['nazwisko'];
	
		$imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
		$nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
	
		$_SESSION['rejestracja'] = false;


		if ((strlen($login)<3) || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="login musi posiadać od 3 do 20 znaków!";
			//echo "Nick musi posiadać od 3 do 20 znaków! ";
		}
		
		if (ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="login może składać się tylko z liter i cyfr (bez polskich znaków) ";
			//echo "Nick może składać się tylko z liter i cyfr (bez polskich znaków) <br />";
		}
		if ($haslo!=$haslo2)
		{
			$wszystko_OK=false;
$_SESSION['e_pass']="Hasla są rózne ";
			//echo "Podane hasla nie sa identyczne";
		}	
		$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
	
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
$_SESSION['e_mail']="Podaj poprawny adres email ";
		//	echo "Podaj poprawny adres e-mail!";
		}


$sekret = "6LezxhAUAAAAAHcbhVnhCUjLgG5e-bvFcn3IvXpR";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
		}		

		$_SESSION['f_nick'] = $login;
		$_SESSION['f_email'] = $email;
		$_SESSION['f_haslo1'] = $haslo1;
		$_SESSION['f_haslo2'] = $haslo2;
		$_SESSION['f_imie'] = $imie;
		$_SESSION['f_nazwisko'] = $nazwisko;

		$_SESSION['f_mail'] = $email;
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
			$connection  = @new mysqli("localhost","root", "", "baza");
		//	mysqli_query($connection , "SET CHARSET utf8");
			mysqli_query($connection , "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			
			
			
			
			
			 if ($connection->connect_error!=0) 
			{
					//echo "EEEEEEEE";
			} 
			else
			{
			

			
				$rezultat = @$connection->query(
		sprintf("SELECT * FROM uzytkownik WHERE login_uzytkownika='%s'",
		mysqli_real_escape_string($connection,$login)));
				
				if (!$rezultat) echo "ERROR";
				
				$ile_takich_nickow = $rezultat->num_rows;
				
				
				//echo $ile_takich_nickow;
				if($ile_takich_nickow!=0)
				{
					$wszystko_OK=false;
$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
					echo "nie dodano, taki login jest juz zajety<br />";
				}
				
				
				if($wszystko_OK==true)
				{ 
					
					
					$_SESSION['rejestracja'] = true;
					
					
					if(mysqli_query($connection, "INSERT INTO uzytkownik VALUES(NULL, '$imie', '$nazwisko', '$login', '$haslo_hash', 1, '$email',1,0)"))
					{
					echo "DODANO";
					header("location:index.php");
						
					}
					
					
				}
				
				$connection ->close();
			}

	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>eFridge.pl</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
    <link rel="stylesheet" href="css/style2.css">
	<noscript>obsługa skryptów języka JavaScript nie jest obsługiwana w Twojej przeglądarce internetowej lub została wyłączona</noscript>

	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>



<div class="body"></div>
		<div class="grad"></div>
		
		
		<div class="header">
			<div class="title">e<span>Fridge</span></div>
		</div>

		<div class="login">
 <form method="post"> 
				<input type="text" placeholder="imie"

value="<?php
			if (isset($_SESSION['f_imie']))
			{
				echo $_SESSION['f_imie'];
				unset($_SESSION['f_imie']);
			}
		?>" 
  name="imie"><br>





				<input type="text" placeholder="nazwisko"   
value="<?php
			if (isset($_SESSION['f_nazwisko']))
			{
				echo $_SESSION['f_nazwisko'];
				unset($_SESSION['f_nazwisko']);
			}
		?>" 

name="nazwisko"><br>
				<input type="text" placeholder="login"  name="login"><br>
<?php
			if (isset($_SESSION['e_nick']))
			{
				echo $_SESSION['e_nick'];
				unset($_SESSION['e_nick']);
			}
		?>
				<input type="password" placeholder="haslo"  name="haslo"><br>

<?php
			if (isset($_SESSION['e_pass']))
			{
				echo $_SESSION['e_pass'];
				unset($_SESSION['e_pass']);
			}
		?>
				<input type="password" placeholder="powtorz haslo" name="haslo2"><br>
				<input type="email" placeholder="email"

value="<?php
			if (isset($_SESSION['f_mail']))
			{
				echo $_SESSION['f_mail'];
				unset($_SESSION['f_mail']);
			}
		?>" 


 name="email"><br>

<?php
			if (isset($_SESSION['e_mail']))
			{
				echo $_SESSION['e_mail'];
				unset($_SESSION['e_mail']);
			}
		?>
				<br>
<div class="g-recaptcha" data-sitekey="6LezxhAUAAAAAPIKkHapKQoBQ6HCwYiylIuIq3RE"></div>


<?php
			if (isset($_SESSION['e_bot']))
			{
				echo $_SESSION['e_bot'];
				unset($_SESSION['e_bot']);
			}
		?>

				<input type="submit" value="Rejestruj">
 </form>
		</div>

  

















</body>
</html>