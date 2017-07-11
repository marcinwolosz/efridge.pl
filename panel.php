
<html>
    <head>
        <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eFridge.pl</title>
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default3.css" />
		<link rel="stylesheet" type="text/css" href="css/component2.css" />
		<noscript>obsługa skryptów języka JavaScript nie jest obsługiwana w Twojej przeglądarce internetowej lub została wyłączona</noscript>

		<script type="text/javascript" src="http://ciasteczka.eu/cookiesEU-latest.min.js"></script>
	
	
	<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery.fn.cookiesEU();
});

</script>
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript">

function confirmSubmit()
{
	if (confirm('Jesteś pewiem?'))
		if (confirm('Jesteś pewien na 100%?'))
		{
		alert('Do zobaczenia');
		wait(3000);
		return true;	
		}
	return false;
}

</script>
        <title></title>
    </head>
    <body>
<div class="container">	
   <?php
    session_start();
			 $connection = @new mysqli("localhost","root", "", "baza");
    mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    

	
	

   
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    else{
       

           if (!isset($_COOKIE['id'])){header("location:index");exit;}

	
	$cz = $_SERVER['HTTP_USER_AGENT'];
	$dz = $_SERVER['REMOTE_ADDR'];		 		
	$ci = $_COOKIE['id'];
	$rezultat2=@$connection->query(sprintf("SELECT id_uzytkownika FROM sesja where id = '$ci' and Web = '$cz' AND ip = '$dz'"));
	$wiersz2 = $rezultat2->fetch_assoc();
	$user=$wiersz2['id_uzytkownika'];
		if ($rezultat = @$connection->query(sprintf("SELECT * FROM uzytkownik where id_uzytkownika='$user'")))
		{
	
				
			$ilu_userow = $rezultat->num_rows;

		
						$wiersz = $rezultat->fetch_assoc();
				//echo "Witaj  ";
			//echo $wiersz['imie_uzytkownika']; echo " ";
			//echo $wiersz['nazwisko_uzytkowinka'];
					
			}
			
$q = mysqli_fetch_assoc(mysqli_query($connection, "select id_uzytkownika from sesja where id = '$_COOKIE[id]' and Web = '$_SERVER[HTTP_USER_AGENT]' AND Ip = '$_SERVER[REMOTE_ADDR]';"));

            if (!empty($q['id_uzytkownika'])){
                   // echo "Zalogowany uzytkownik o ID: " . $q['id_uzytkownika'] ;
					
            } else {
                    header("location:index.php");exit;
            }
    }
 
	
	
	
	
	
	
	$admin=$wiersz['admin'];
		 if($admin==1)
		 {
	header("location:admin.php");exit;
	
		 }
	
	
	
	
	
	
	
	


	
	if (isset($_POST['email']))
	{
	
		
		$wszystko_OK=true;




	
		$haslox = $_POST['haslox'];		
	



		$haslox = htmlentities($haslox, ENT_QUOTES, "UTF-8");
		
		$imie = $_POST['imie'];	
		$nazwisko = $_POST['nazwisko'];
		$wiek = $_POST['wiek'];
		$waga = $_POST['waga'];
		
		
		$imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
		$nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
		$wiek = htmlentities($wiek, ENT_QUOTES, "UTF-8");		
		$waga = htmlentities($waga, ENT_QUOTES, "UTF-8");		

$_SESSION['zmiana'] = false;


		
		
	
		$haslo_hash = password_hash($haslox, PASSWORD_DEFAULT);
	
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
$_SESSION['e_mail']="Podaj poprawny adres email ";
		//	echo "Podaj poprawny adres e-mail!";
		}



		
	

		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
	
			
			
			
			
			
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
				
				

				
				
				if($wszystko_OK==true)
				{ 
					
					
					$_SESSION['zmiana'] = true;
					
					
					 $id_uz=$wiersz['id_uzytkownika'];
					 
					 
					 
					 mysqli_query($connection, "UPDATE uzytkownik set  imie_uzytkownika='$imie', nazwisko_uzytkowinka='$nazwisko', haslo_uzytkowinka='$haslo_hash',
					  email='$email' WHERE id_uzytkownika=$id_uz");
					
					header('refresh: 0;');
					
					$_SESSION['e_zmiana']="Dane zmieniono, możesz odswieżyć stronę";
					
					
				}
				
				
			}

	}
	
	
	
	if (isset($_POST['x']))
	{
		 $id_uz=$wiersz2['id_uzytkownika'];
		
		mysqli_query($connection, "Delete from uzytkownik where id_uzytkownika='$id_uz'");
		header("location:logout.php");exit;
	}
	$connection ->close();
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">	
			<!-- Codrops top bar -->
			
			
			
			
			<div class="main clearfix">
				<nav id="menu" class="nav">					
					<ul>
						<li>
							<a href="main">
								<span class="icon">
									<i aria-hidden="true" class="icon-home"></i>
								</span>
								<span>Strona Główna</span>
							</a>
						</li>
						<li>
							<a href="lodowka">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-services"></i>
								</span>
								<span>Lodówka</span>
							</a>
						</li>
						<li>
							<a href="dieta">
								<span class="icon">
									<i aria-hidden="true" class="icon-portfolio"></i>
								</span>
								<span>Dieta</span>
							</a>
						</li>
						<li>
							<a href="kontakt">
								<span class="icon">
									<i aria-hidden="true" class="icon-blog"></i>
								</span>
								<span>Kontakt</span>
							</a>
						</li>
						<li>
							<a href="panel">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>Panel użytkownika</span>
							</a>
						</li>
						<li>
							<a href="logout.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-contact"></i>
								</span>
								<span>Wyloguj się</span>
							</a>
						</li>
					</ul>
				</nav>
					<h2>
			</h2>
			<br/>
			<br/>
			
			
			
			
			
			<div class="form-style-8">
			<div class="lewa">
  <form method="post">


  
<?php
			if (isset($_SESSION['e_zmiana']))
			{
				    echo 'Dane zostały zmienione';
				unset ($_SESSION['e_zmiana']);
			}
		?>
<br/><br/>

  imie: 
    <input type="text" name="imie" placeholder="imie" value="<?php
			if (isset($wiersz['imie_uzytkownika']))
			{
				echo $wiersz['imie_uzytkownika'];
				unset($wiersz['imie_uzytkownika']);
			}
		?>" >
		
		
		nazwisko: 
    <input type="text" name="nazwisko" placeholder="nazwisko" value="<?php
			if (isset($wiersz['nazwisko_uzytkowinka']))
			{
				echo $wiersz['nazwisko_uzytkowinka'];
				unset($wiersz['nazwisko_uzytkowinka']);
			}
		?>" >
  
  
 login: 
    <input type="text" name="login" placeholder="login" value="<?php
			if (isset($wiersz['login_uzytkownika']))
			{
				echo $wiersz['login_uzytkownika'];
				unset($wiersz['login_uzytkownika']);
			}
		?>"  readonly>
		
		haslo: 
    <input type="password" name="haslox" placeholder="haslo" required>
  
  
  email: 
    <input type="email" name="email" placeholder="email" value="<?php
			if (isset($wiersz['email']))
			{
				echo $wiersz['email'];
				unset($wiersz['email']);
			}
		?>" >
BAN:

    <input type="text" name="premium" placeholder="premium" value="<?php
			if (isset($wiersz['premium']))
			{
				
				
				if($wiersz['premium']==0)
				{
				echo "Tak";
				}
				else  echo "nie";
			}
		?>" readonly>
		
		

    <input type="submit" value="Zmień dane" />	
  </form>
  
  
  
  
  
  
    <form method="post" onsubmit="return confirmSubmit(this)">
	
	<input type="submit" value="Usun konto" name="x"/>	
	</form>
</div>


<div class="prawy">

</div>

</div>
			
			
		
			
			
			
			</div>
			
				<footer class="footer">
   eFridge.pl  © 2017

                
    </footer>
		</div><!-- /container -->
		<script>
			//  The function to change the class
			var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};	

			//  Creating our button in JS for smaller screens
			var menuElements = document.getElementById('menu');
			menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

			//  Toggle the class on click to show / hide the menu
			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}

			// http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
			document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}
		</script>

	
	
	
	
    </body>
</html>
</html>