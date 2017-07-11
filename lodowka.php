
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<script type="text/javascript" src="ajax.js"></script> 
		<script type="text/javascript" src="xmlhttprequest.js"></script>
		<title>eFridge.pl</title>
		<link rel="shortcut icon" href="../favicon.ico"> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<noscript>obsługa skryptów języka JavaScript nie jest obsługiwana w Twojej przeglądarce internetowej lub została wyłączona</noscript>

<script src="js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="css/default7.css" />

		<link rel="stylesheet" type="text/css" href="css/component7.css" />
	

		
		<script src="js/modernizr.custom.js"></script>

        <title></title>
    </head>
    <body>
	
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
 
	
	
	
	
	
	
	
		 $premium=$wiersz['premium'];
		 if($premium==0)
		 {
	header("location:ban.php");exit;
	
		 }
	
	
	
if (isset($_POST['cel']))
		{
	
		$produkt= $_POST['cel'];
$sztuk=$_POST['sztuk'];

mysqli_report(MYSQLI_REPORT_STRICT);



$rezultat = @$connection->query(
		sprintf("Select * 
From 
Produkt p, uzpro u
where 
p.id_produktu=u.id_produktu 
and u.id_produktu='%s'
and u.id_uzytkownika='%s'
",	mysqli_real_escape_string($connection,$produkt),
		mysqli_real_escape_string($connection,$user)));

			$ile_takich_nickow = $rezultat->num_rows;
		if($sztuk<50 and $sztuk>0)
		{
		if($ile_takich_nickow==0)
		{	
		
mysqli_query($connection, "INSERT INTO uzpro VALUES(NULL, '$user', '$produkt','$sztuk')");
				$dodanoo=true;
		}
		
		
		
		else 
			
			{
				
				mysqli_query($connection, "
Update uzpro
SET
sztuk=sztuk+'$sztuk'
where 
id_produktu='$produkt'");
$dodanoo=true;
			}
		}
		else
		{
			$ojjj=true;
		}}
					
		
		if (isset($_POST['cel2']))
		{
	

			$produkt= $_POST['cel2'];
			$sztuk=$_POST['sztuk2'];

mysqli_report(MYSQLI_REPORT_STRICT);



$rezultat = @$connection->query(
		sprintf("Select * 
From 
Produkt p, uzpro u
where 
p.id_produktu=u.id_produktu 
and u.id_produktu='%s'
and u.id_uzytkownika='%s'
",	mysqli_real_escape_string($connection,$produkt),
		mysqli_real_escape_string($connection,$user)));

			
		$wierszz = $rezultat->fetch_assoc();
		$sztuuuk=$wierszz['sztuk'];
		if($sztuuuk<$sztuk)
		{	
		
mysqli_query($connection, "Delete from uzpro where id_produktu='$produkt'");
				$usunietoo=true;
		}
		
		
		
		else 
			
			{
				
				mysqli_query($connection, "
Update uzpro
SET
sztuk=sztuk-'$sztuk'
where 
id_produktu='$produkt'");
$usunietoo=true;
			}
		}


	
	
	
	
	if (isset($_POST['nazwa']))
		{
	
			$nazwa= $_POST['nazwa'];
			$kalorie= $_POST['kalorie'];
			$weglowodany= $_POST['weglowodany'];
			$bialko= $_POST['bialko'];
			$tluszcz= $_POST['tluszcz'];

mysqli_query($connection, "INSERT INTO Produkt_akceptuj VALUES(NULL, '$nazwa', '$kalorie', '$weglowodany','$bialko','$tluszcz')");
			
	$wlasne=true;
			
			
		}
	
	
	
	
	
				
				$connection ->close();
			

	
?>
	
	
	
	
	
	<div class="container">	
			<!-- Codrops top bar -->
			
			<header>
				<h1>Cześć!
				 <span>Oto Twoja lodówka! Co robimy dalej?</span></h1>	
			</header>
			
			
			
			
			<div class="main clearfix">
			<div class="menuuu">
				<nav id="menu" class="nav">					
					<ul>
						
						
						<li>
							<a onclick="wymienTresc('dodpro.php', 'conn', this);" >
								<span class="icon">
									<i aria-hidden="true" class="icon-plus"></i>
								</span>
								<span>Dodaj produkt</span>
							</a>
						</li>
						<li>
							<a href="#connn" onclick="wymienTresc('showpro.php', 'conn', this);" >
								<span class="icon">
									<i aria-hidden="true" class="icon-th-list"></i>
								</span>
								<span>Wyświetl lodówke</span>
							</a>
						</li>
						<li>
							<a onclick="wymienTresc('deletepro.php', 'conn', this);" >
								<span class="icon">
									<i aria-hidden="true" class="icon-minus"></i>
								</span>
								<span>Usuń prodkukt</span>
							</a>
						</li>
						<li>
							<a href="main">
								<span class="icon">
									<i aria-hidden="true" class="icon-cancel-alt-filled"></i>
								</span>
								<span>Powrót</span>
							</a>
						</li>
					</ul>
				</nav>
				</div>
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
			<div id ="conn">	
			<h1 >
				
				<span><?php
			if($dodanoo==true)
			{
				echo "INFO:";
				echo "Gratulacje, produkt został pomyślnie dodany do lodówki! ";
			}	
				?>
				
				<?php
			if($usunietoo==true)
			{
				echo "INFO:";
				echo "Gratulacje, produkt został pomyślnie usunięty z lodówki!";
			}
				?>
				<?php
			if($wlasne==true)
			{
				echo "INFO:";
				echo "Produkt został dodany do bazy tymczasowej. Jeżeli wszystko będzie ok, pojawi się w bazie produktów!";
			}	
				?>
				
				
				<?php
			if($ojjj==true)
			{
				echo "INFO:";
				echo "Przekraczasz dozwolony zasób";
			}	
				?>
				
				
				</span></h1>
				</div>
				
			</div>
			 
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