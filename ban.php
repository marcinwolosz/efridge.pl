
<html>
    <head>
        <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eFridge.pl</title>
<noscript>obsługa skryptów języka JavaScript nie jest obsługiwana w Twojej przeglądarce internetowej lub została wyłączona</noscript>

		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default3.css" />
		<link rel="stylesheet" type="text/css" href="css/component2.css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> 
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
		if ($rezultat = @$connection->query(sprintf("SELECT * FROM profil where id_uzytkownika='$user'")))
		{
	
				
			$ilu_userow = $rezultat->num_rows;
			
			$wiersz = $rezultat->fetch_assoc();
			if($ilu_userow==0) {header("location:dodajprofil.php");}
			else 
			{
				
			
				
				
				
				
				}		
			}
			
$q = mysqli_fetch_assoc(mysqli_query($connection, "select id_uzytkownika from sesja where id = '$_COOKIE[id]' and Web = '$_SERVER[HTTP_USER_AGENT]' AND Ip = '$_SERVER[REMOTE_ADDR]';"));

            if (!empty($q['id_uzytkownika'])){
                   // echo "Zalogowany uzytkownik o ID: " . $q['id_uzytkownika'] ;
					
            } else {
                    header("location:index.php");exit;
            }
    }
 
	$wiersz['wzrost']=$wiersz['wzrost']/100;
	$dwa=$wiersz['wzrost']*$wiersz['wzrost'];
	$BMI=($wiersz['waga'])/$dwa;
	

	
	
if (isset($_POST['sms']))
{	
	$sms2= $_POST['sms'];					
	
	$_SESSION['x'] = rand(1000,9999);
	$cc=$_SESSION['x'];
function sms_send($params, $backup = false ) {

    static $content;

    if($backup == true){
        $url = 'http://api2.smsapi.pl/sms.do';
    }else{
        $url = 'http://api.smsapi.pl/sms.do';
    }

    $c = curl_init();
    curl_setopt( $c, CURLOPT_URL, $url );
    curl_setopt( $c, CURLOPT_POST, true );
    curl_setopt( $c, CURLOPT_POSTFIELDS, $params );
    curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );

    $content = curl_exec( $c );
    $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    if($http_status != 200 && $backup == false){
        $backup = true;
        sms_send($params, $backup);
    }

    curl_close( $c );    
    return $content;
}

$params = array(
     'username' => 'marcinwoloszz@gmail.com',
     'password' => '21232f297a57a5a743894a0e4a801fc3',
     'to' => $sms2,
     'from' => 'Info',
     'message' => "kod autoryzacyjny: $cc",
);

sms_send($params);

}
			
if (isset($_POST['kod']))
{
$kod= $_POST['kod'];
if($kod==$_SESSION['x'])
{
$rezultat = @$connection->query(sprintf("UPDATE uzytkownik set premium=1 where id_uzytkownika='$user'"));
header("location:lodowka.php");exit;
}	
else 
{
$_SESSION['blad'] = '<span style="color:red"><center><br />Zły kod!</center></span>';
}
	
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
		
			
			
			
			
			<div class="form-style-8">


			
 			
			

 

<br/>	<br/>	

<h3>
Niestety użytkowniku. <br>Zostałeś zbanowany i na chwilę obecną nie możesz korzystać z naszej lodówki! <br>
Podaj nam swój nr telefonu, a odblokujemy Ci konto po podaniu zwrotnego kodu z smsa :)</h3>
<?php
if (!isset($_POST['sms']))
{?>
  <form method="post">


 
<input type="number" min="100000000" maxlength="999999999" placeholder="Numer Telefonu" value="Numer_Telefonu" name="sms"/><br>


    <input type="submit" value="Wyslij" />

  </form>
  <?php	
}
?>
  <?php
if (isset($_POST['sms']))
{?>
	
  <form method="post">


 
<input type="number" minlength="4" maxlength="4" placeholder="Podaj kod z sms'a" value="kod" name="kod"/><br>


    <input type="submit" value="Wyslij" />

  </form>
<?php	
}
?>
  
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
unset($_SESSION['blad']);
?>
  
  
 
</div>
			
			
		
			
			
			
			</div>
		
			<footer class="footer">
   eFridge.pl  © 2017

                
    </footer></div>	</div>	
		<!-- /container -->
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