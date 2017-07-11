
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
			if($ilu_userow==0) {header("location:dodajprofil");}
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
			

  <h1>Na podstawie podanych danych: </h1>

	<hr style=”color: #f00; background: #f00; width="90%"; align="left"; ”>		
<div class="just">
<b>Wiek:</b>
<?php
			
		 echo $wiersz['wiek'];
				
		?>
		
  <b>&nbsp;&nbsp;&nbsp;Wzrost: </b>
<?php
			
		 echo $wiersz['wzrost']*100;
				
		?>

  <b>&nbsp;&nbsp;&nbsp;Waga: </b>
<?php
			
		 echo $wiersz['waga'];
				
		?>
	
  <b>&nbsp;&nbsp;&nbsp;Wiek: </b>
<?php
			
		 echo $wiersz['wiek'];
				
		?>

  <b>&nbsp;&nbsp;&nbsp;Typ budowy: </b>
<?php
			
		 if($wiersz['typ_budowy']==1) echo "Ektomorfik";
			 if($wiersz['typ_budowy']==2) echo "Endomorfik";
 if($wiersz['typ_budowy']==3) echo "Mezomorfik";			 
		?>
		
		<b>&nbsp;&nbsp;&nbsp;Cel: </b>
<?php
			
		 if($wiersz['plan']==1) echo "Masa";
			 if($wiersz['plan']==2) echo "Redukcja";
 if($wiersz['plan']==3) echo "Utrzymanie";			 
		?>


	
	
	<br/>
	
	<br/>
	
</div>	
	
	
	
<b>Twoje BMI:</b>
<?php
			
				echo number_format($BMI,2,',','');echo "    ";
			
		if($BMI<16.0) echo " - Wygłodzenie";
				if($BMI>16.0 && $BMI<17.0) echo "- Wygłodzenie";
						if($BMI>16.0 && $BMI<17.0) echo " - Wychudzenie (spowodowane często przez ciężką chorobę)";
						if($BMI>17.0 && $BMI<18.5) echo " - Niedowaga";
						if($BMI>18.5 && $BMI<25.0) echo " - Wartość prawidłowa";
						if($BMI>25.0 && $BMI<30.0) echo " - Nadwaga";
						if($BMI>30.0 && $BMI<35.0) echo " - I stopień otyłości";
						if($BMI>35.0 && $BMI<40.0) echo " - II stopień otyłości";
						if($BMI>40.0) echo " - III stopień otyłości";
		

		?>
	<br/>	<br/>	
	
<b>Twoje BMR:</b>

<?php
			
				$a=$wiersz['waga']*24;
				if($wiersz['aktywnosc']==5) $a=$a*1.5;
				if($wiersz['aktywnosc']==4) $a=$a*1.4;
				if($wiersz['aktywnosc']==3) $a=$a*1.3;;
				if($wiersz['aktywnosc']==2) $a=$a*1.2;
				if($wiersz['aktywnosc']==1) $a=$a*1.1;
				if($wiersz['plan']==1) $a=$a+200;
				if($wiersz['plan']==2) $a=$a-200;
				
			
		echo number_format($a,2,',','');echo " - Tyle kcal dziennie masz spożywać! ";
		
		
		
		?>
		


		
		
<br/><br/>



<b>Obliczyliśmy rozpiętość dopuszczalnej dla Ciebie wagi na podstawie BMI i indeksu Ponderala:</b>
<br/><br/>
<?php
			
		 $b=18.5*$wiersz['wzrost']*$wiersz['wzrost'];
				$c=24.5*$wiersz['wzrost']*$wiersz['wzrost'];
			echo "<b>BMI:</b> najniższa dopuszczalna waga: ";  
			echo number_format($b,2,',',''); echo " ";
				echo "najwyższa: ";  echo number_format($c,2,',','');
			
			echo '<br/><br/>';
			
			$d=10.3*$wiersz['wzrost']*$wiersz['wzrost']*$wiersz['wzrost'];
				$e=13.9*$wiersz['wzrost']*$wiersz['wzrost']*$wiersz['wzrost'];
			echo "<b>Indeks Ponderala:</b> najniższa dopuszczalna waga: ";  
			echo number_format($d,2,',',''); echo " ";
				echo "najwyższa: ";  echo number_format($e,2,',','');
		
		?>
<br/><br/>		

<b>Twoje WHR:</b>
<?php
			
		 $q=$wiersz['obwod_pasa']/$wiersz['obwod_bioder'];
		 
		 echo " ";  echo number_format($q,2,',',''); echo " ";
				if($q<0.84)
				echo " - Figura typu gruszka";
				else
				echo " - Figura typu jabłko";
		
		?>
<br/><br/>	

<b>Wyliczny poziom tkanki tłuszczowej:</b>
<?php
			
		 $a=$wiersz['obwod_pasa']*100;
		 $b=$a/2.54;
		 $c=0.082*$wiersz['waga']*2.2;
		 $d=$b-$c-98.42;
		 $e=$wiersz['waga']*2.2;
		 $f=$d/$e;
		 
		 echo " ";  echo number_format($f,2,',',''); echo " %";
				
		
		?>
<br/><br/>

	

<button class="submit" onClick="window.location = 'dodajprofil'; return false;">Edytuj wprowadzone wcześniej przez siebie dane</button>
    </div>
	<div class="prawa"><iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffabrykasily&tabs=timeline&width=300&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="300" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>
 
</div>
			
			

			
			
			</div>
		
			<footer class="footer">
   eFridge.pl  © 2017

                
    </footer></div>	
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