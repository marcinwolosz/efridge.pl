


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
	

	


$zapytanie = @mysql_query ("SELECT * 
from Produkt");




?>


<div class="form-style-8">


<form method="post">


Wybierz produkt który chcesz dodać <br/>

<select name="cel" placeholder="co chcesz dodac?" required>
		
		
			<?php
	while($option = @mysql_fetch_assoc($zapytanie)) {
echo '<option value="'.$option['id_produktu'].'">'.$option['nazwa'].'</option>';
}

	?>
	  

	</select>
	Ilość sztuk:
<input type="number" placeholder="Ilość" name="sztuk" min="1" max="50"  required><br>
    <input type="submit" value="Dodaj!" />
  </form>
 <br><br>
 <h2> Lub dodaj własny i poczekaj!</h2>
  <form method="post">
   Nazwa:
  <input type="text" placeholder="Podaj nazwe" name="nazwa" required><br>
  kalorie:
  <input type="number" placeholder="Ilość kalorii" name="kalorie" min="0" max="5000" required><br>
  welglowodany:
  <input type="number" placeholder="Węglowodany w gramach" name="weglowodany" min="0" max="5000"  required><br>
  białko:
  <input type="number" placeholder="Białko w gramach" name="bialko" min="0" max="5000"  required><br>
  tłuszcz:
  <input type="number" placeholder="Tłuszcz w gramach" name="tluszcz" min="0" max="5000"  required><br>
    <input type="submit" value="Dodaj!" />
  </form>
</div>
