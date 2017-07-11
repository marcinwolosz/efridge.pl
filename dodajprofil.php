
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
						$user2=$wiersz['id_uzytkownika'];
				//echo "Witaj  ";
			//echo $wiersz['imie_uzytkownika']; echo " ";
			//echo $wiersz['nazwisko_uzytkowinka'];
					
			}
			
$q = mysqli_fetch_assoc(mysqli_query($connection, "select id_uzytkownika from sesja where id = '$_COOKIE[id]' and Web = '$_SERVER[HTTP_USER_AGENT]' AND Ip = '$_SERVER[REMOTE_ADDR]';"));

            if (!empty($q['id_uzytkownika'])){
                   
					
            } else {
                    header("location:index.php");exit;
            }
    }
 
	
	
		if (isset($_POST['wiek']))
		{
	
		$wiek = $_POST['wiek'];
		$wzrost = $_POST['wzrost'];
		$waga = $_POST['waga'];
		$typ= $_POST['typ'];
		$kalorie = $_POST['kalorie'];
		$cel = $_POST['cel'];
		$aktywnosc= $_POST['aktywnosc'];
		$pas= $_POST['pas'];
		$biodra= $_POST['biodra'];
		
		
		if($_POST['typ']=='Ektomorfik')
			$x=1;
		else if($_POST['typ']=='Endomorfik')
			$x=2;
		else if($_POST['typ']=='Mezomorfik')
			$x=3;
		
		
		
		if($_POST['cel']=='Masa')
			$y=1;
		else if($_POST['cel']=='Redukcja')
			$y=2;
		else if($_POST['cel']=='Utrzymanie')
			$y=3;
		
		 
					 mysqli_query($connection, "SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
					 mysqli_query($connection, "START TRANSACTION");
		
mysqli_report(MYSQLI_REPORT_STRICT);
		

			 if ($connection->connect_error!=0) 
			{
					//echo "EEEEEEEE";
			} 
			else
			{
$id_uz=$wiersz['id_uzytkownika'];
				$rezultat3 = @$connection->query(sprintf("SELECT * FROM profil WHERE id_uzytkownika='$id_uz'"));
				
				if (!$rezultat3) 
					
				
				{
					 header("location:main.php");exit;}
				
				$ile_takich_nickow = $rezultat3->num_rows;
				$wiersz4 = $rezultat3->fetch_assoc();
					 
					
					 
					 
					 if($ile_takich_nickow==0)
					 {
					
					 
					 $error=0;
					 if(!mysqli_query($connection, "INSERT INTO profil VALUES(NULL, '$wiek', '$wzrost', '$waga', '$x', '$kalorie','$y',   '$id_uz', '$aktywnosc','$pas', '$biodra')"))
					 {
						 mysqli_query($connection,"ROLLBACK");
						 $error=1;	 
					 }
					 header("location:dieta.php");
					 }
					 else 
						 
					{
							 
					if(!mysqli_query($connection, "UPDATE profil 
					
					
					set wiek='$wiek', wzrost='$wzrost', waga='$waga',  typ_budowy='$x', kalorie='$kalorie', plan='$y', aktywnosc='$aktywnosc' 
					WHERE id_uzytkownika=$id_uz"))
					{
						 mysqli_query($connection,"ROLLBACK");
						 $error=1;	 
					 }
							 
							 header("location:dieta.php");
							 
					}
					
					if($error==1)
					{
						mysqli_query($connection,"ROLLBACK");
						
					}
					else{
						mysqli_query($connection,"COMMIT");
					}
						 
					 
					 
					 
		
					
			
				$connection ->close();
			}

		}
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
  <form method="post">


  
Najpierw uzupełnij trochę danych 
<br/><br/>

 Wiek (min 5, max 150): 
    <input type="number"  min="5" max="150" name="wiek" placeholder="wiek" required>
	
		
Wzrost (min 50, max 250): 
    <input type="number"min="50" max="250" name="wzrost" placeholder="wzrost"  required>
  
  
Waga (min 20, max 350):
    <input type="number"min="20" max="350" name="waga" placeholder="waga" required>
		
Obwód pasa (min 20, max 200):
    <input type="number"min="20" max="200" name="pas" placeholder="obwód pasa" required>
	
Obwód bioder (min 20, max 200):
    <input type="number"min="20" max="200" name="biodra" placeholder="obwód bioder" required>
  
  
  Typ bodowy (ektomorfik, endomorfik lub mezomorfik):
    <select name="typ" placeholder="typ budowy" >
		<option>Ektomorfik</option>
		<option>Endomorfik</option>
		<option>Mezomorfik</option>
	</select>
	
	
	Aktywność fizycza (1-min, 5-max)
	
	<select name="aktywnosc" placeholder="typ budowy" >
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
	</select>
	
	Zakładane przez Ciebie kalorie:
  
   <input type="number" name="kalorie" placeholder="kalorie" min="500" max="8000" required>
		
Co chce osiągnąć?

<select name="cel" placeholder="co chcesz osiągnąc?" required>
		<option>Masa</option>
		<option>Redukcja</option>
		<option>Utrzymanie</option>
	</select>




    <input type="submit" value="Dodaj!" />
  </form>
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