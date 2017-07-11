
<html>
    <head>
        <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eFridge.pl</title>
		<link rel="shortcut icon" href="../favicon.ico"> 
			<noscript>obsługa skryptów języka JavaScript nie jest obsługiwana w Twojej przeglądarce internetowej lub została wyłączona</noscript>

		<link rel="stylesheet" type="text/css" href="css/default2.css" />
		<link rel="stylesheet" type="text/css" href="css/component2.css" />
		<script src="js/modernizr.custom.js"></script>

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
		if ($rezultat = @$connection->query(sprintf("SELECT * FROM notatka where id_uzytkownika='$user'")))
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
 
	
		
		if (isset($_POST['xx']))
		{
			$x=nl2br(htmlspecialchars($_POST['xx']));
			if($ilu_userow==0)
			{
			mysqli_query($connection, "INSERT into notatka values(NULL, '$user', '$x') ");
			}
			if($ilu_userow>=1)
			{
				mysqli_query($connection, "UPDATE notatka set notatka='$x' WHERE id_uzytkownika='$user'");
			}
	header('refresh: 0;');
			
		}
		
		
		
		
		
		if (isset($_POST['mail1']))
	{
		
		
// Tworzymy zmienną dla imienia i nazwiska
$name = $_POST['name1'];
$mail = $_POST['mail1'];
// Tworzymy zmienną dla adresu email

$subject = $_POST['subject1'];
// Tworzymy zmienną dla wiadomości
$message = $_POST['message1'];

// Podajesz adres email z którego ma być wysłana wiadomość


// Podajesz adres email na który chcesz otrzymać wiadomość
$dokogo = "marcinwoloszz@gmail.com";

// Podajesz tytuł jaki ma mieć ta wiadomość email


// Przygotowujesz treść wiadomości
$wiadomosc = "";
$wiadomosc .= "Imie i nazwisko: " . $name . "\n";
$wiadomosc .= "Email: " . $mail . "\n";
$wiadomosc .= "Wiadomosc: \n" . $message . "\n";

// Wysyłamy wiadomość
$sukces = mail($dokogo, $subject, $wiadomosc);

// Przekierowywujemy na potwierdzenie
if ($sukces){
	$_SESSION['e_sent']="Wiadomość wysłana";

}
else{
	$_SESSION['e_sent']="Wiadomość nie została wysłana";

}

			
			
			
	}
			
			
			
		
		   
		
    
    ?>
	
	
	
	<div class="container">	
		
			
			
			
			
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
				
				
				
				
				<br/>	
				<br/>
				<br/>
			
			
			<div class="lewa">	
				 Masz pytania? Wyślij wiadomość!
				 
				 <br/>
				 
			
			
			
				  <?php
			if (isset($_SESSION['e_sent']))
			{
				echo $_SESSION['e_sent'];
				unset ($_SESSION['e_sent']);
			}
		?>
			
				<div class="inner contact">
                <!-- Form Area -->
                <div class="contact-form">
				
				
                   
                    <form id="contact-us" method="post" >
                        
                        <div class="col-xs-6 wow animated slideInLeft" data-wow-delay=".5s">
                            
                            <input type="text" name="name1" id="name" required="required" class="form" placeholder="Imie" />
                           
                            <input type="email" name="mail1" id="mail" placeholder="email" 
			 class="form"  />
                        
						
						
						
						
						
                            <input type="text" name="subject1" id="subject" required="required" class="form" placeholder="Temat" />
                        </div>
                   
                        <div class="col-xs-6 wow animated slideInRight" data-wow-delay=".5s">
                
                            <textarea name="message1" id="message" class="form textarea"  placeholder="Wiadomość"></textarea>
                        </div>
            
                        <div class="relative fullwidth col-xs-12">
                
                            <input type="submit" id="submit" name="submit1" class="form-btn semibold"> </button> 
                        </div>
                   
                        <div class="clear"></div>
                    </form>

         
                   
                </div>
            </div>
				
				
			
			</div>
			
			<div class = "prawa">
			<center>
			<h1>Notatka </h1>
			 <form id="contact-us" method="post" >
			 
			 
			 
			 
			 <textarea style="width:70%; height:150px;" name="xx" id="message" class="form textarea"  placeholder="Stwórz notatkę"></textarea></button> <br/>
			<input type="submit" id="submit" name="submit2" class="form-btn semibold" value="Stwórz notatkę"> 
			 </form>
			 <?php
			if (isset($wiersz['notatka']))
			{
				echo $wiersz['notatka'];
				unset($wiersz['notatka']);
			}
		?>
			</div>
			
			</center>
			
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