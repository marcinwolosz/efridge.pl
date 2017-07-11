
<html>
    <head>
        <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>eFridge.pl</title>
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default3.css" />
		<link rel="stylesheet" type="text/css" href="css/component2.css" />
		<script src="js/modernizr.custom.js"></script>
<noscript>obsługa skryptów języka JavaScript nie jest obsługiwana w Twojej przeglądarce internetowej lub została wyłączona</noscript>

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
 
	
	
	
	
	
	$link = @mysql_connect("localhost","root", "", "baza")or die('Błąd: Nie można połączyć z MySQL!');
@mysql_select_db("baza", $link)
    or die('Nie mogę połączyć się z bazą danych');
mysqli_query($link, "SET CHARSET utf8");
    mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	
	$zapytanie = @mysql_query ("SELECT * FROM uzytkownik where premium=1 and admin=0");
	$zapytanie2 = @mysql_query ("SELECT * FROM uzytkownik where premium=0 and admin=0");

		if (isset($_POST['ban']))
	
	{
		
		
		$ban=$_POST['ban'];
			$zapytanie = @mysql_query ("UPDATE uzytkownik set premium=0 where id_uzytkownika='$ban'");
			$zbanowany=true;
	}
	
	if (isset($_POST['ban2']))
	
	{
		
		
		$ban=$_POST['ban2'];
			$zapytanie = @mysql_query ("UPDATE uzytkownik set premium=1 where id_uzytkownika='$ban'");
			$odzbanowany=true;
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
			<h1> Witaj adminstratorze</h1><br>  <hr style="”color:" #f00;="" background:="" ;="" ”="" align="left" width="90%">
			BAN:
  <form method="post">


 

Wybierz użytkownika, który dostanie bana: 
    <select name="ban" placeholder="co chcesz dodac?" required>
		
		
		
		<?php
		
	while($option = @mysql_fetch_assoc($zapytanie)) {
echo '<option value="'.$option['id_uzytkownika'].'">'.$option['login_uzytkownika'].'</option>';
}

	?>
		  

	</select>
		
		
	
		

    <input type="submit" value="Banuj!" />
	<?php
	if($zbanowany==true)
	{
		echo "Uzytkownik zbanowany";
	}
	?>
  </form>
  
  
  
   <form method="post">


 

Wybierz użytkownika, któremu chcesz zdjąć bana:

    <select name="ban2" placeholder="co chcesz dodac?" required>
		
		
		
		<?php
		
	while($option = @mysql_fetch_assoc($zapytanie2)) {
echo '<option value="'.$option['id_uzytkownika'].'">'.$option['login_uzytkownika'].'</option>';
}

	?>
		  

	</select>
		
		
	
		

    <input type="submit" value="Odbanuj!" />
	<?php
	if($odzbanowany==true)
	{
		echo "Uzytkownik odbanowany";
	}
	?>
  </form>
  

  
Zaakceptuj bądż odrzuć!<br>
  
  <table>
  
  
  <?php
  
  
  
  $wynik = @mysql_query("SELECT * 
from produkt_akceptuj")
or die('Błąd zapytania');




if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
     echo "<tr>";
        echo "<th>NAZWA</th>";
        echo "<th>KCL</th>";
	echo "<th>WĘGLOWODANY</th>";
        echo "<th>BIAŁKO</th>";
	echo "<th>TŁUSZCZ</th>";
	echo "<th>+/-</th>";
	echo "<th>+/-</th>";

        echo "</tr>";
		
    while($r = mysql_fetch_assoc($wynik)) {
		echo '<form action="qq.php" method="post" >';
        echo "<tr>";
        echo "<td ><input type='text' id='admin_przyciski' size=15 name='nazwa_produkt' value=".$r['nazwa']."></td>";
 	echo "<td ><input type='text' id='admin_przyciski' size=5 name='kalorie_produkt' value=".$r['kalorie']."></td>";
   	 echo "<td ><input type='text' id='admin_przyciski' size=5 name='weglowodany_produkt' value=".$r['weglowodany']."></td>";
	 echo "<td ><input type='text' id='admin_przyciski' size=5 name='bialka_produkt' value=".$r['bialko']."></td>";
         echo "<td ><input type='text' id='admin_przyciski' size=5 name='tluszcz_produkt' value=".$r['tluszcz']."></td>";
		echo "<td><input name='przycisk'id='admin_przyciski' type='submit' value='DODAJ'></td>";
		echo "<td><input name='przycisk'id='admin_przyciski' type='submit' value='USUN'></td>";

        echo "</tr>";
		echo "</form>";
    }
   
}
?>
  
  
  
  
  
  </table>
  
  
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