<div id ="conn">	
	<table>
	  <?php
    session_start();
			 $connection = @new mysqli("localhost","root", "", "baza");
    mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    

	
	

   
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    else{
        foreach ($_COOKIE as $k=>$v) {
	$_COOKIE[$k] = mysqli_real_escape_string($connection, $v);
}

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

	
	
	
	
	
	
	
	



	

$connection = @mysql_connect("localhost","root", "", "baza")
    or die('Brak połączenia z serwerem MySQL');
 $db = @mysql_select_db("baza", $connection)
    or die('Nie mogę połączyć się z bazą danych');
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	

	
	
	
	
$wynik = @mysql_query("SELECT * 
from Produkt P, uzpro u
where 
P.id_produktu=u.id_produktu and id_uzytkownika='$user'
Order by P.id_produktu")
or die('Błąd zapytania');




if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
     echo "<tr>";
        echo "<th>NAZWA</th>";
        echo "<th>KCL</th>";
	echo "<th>WĘGLOWODANY</th>";
        echo "<th>BIAŁKO</th>";
	echo "<th>TŁUSZCZ</th>";
	echo "<th>SZTUK</th>";
        echo "</tr>";
    while($r = mysql_fetch_assoc($wynik)) {
        echo "<tr>";
        echo "<td>".$r['nazwa']."</td>";
        echo "<td>".$r['kalorie']."</td>";
	echo "<td>".$r['weglowodany']."</td>";
        echo "<td>".$r['bialko']."</td>";
	echo "<td>".$r['tluszcz']."</td>";
	echo "<td>".$r['sztuk']."</td>";
        echo "</tr>";
    }
   
}
else echo "<h1>LODÓWKA JEST NIESTETY PUSTA. Studencie :)</h1>";

?> 
			
</table>
	
	</div>
 