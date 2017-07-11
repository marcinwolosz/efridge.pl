<div id ="conn">	

<?php
session_start();


 $connection = @new mysqli("localhost","root", "", "baza");
    mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

$connection = @mysql_connect("localhost","root", "", "baza")or die('Błąd: Nie można połączyć z MySQL!');
$db = @mysql_select_db("baza", $connection)
    or die('Nie mogę połączyć się z bazą danych');
	
	
	mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");


?>


<div class="form-style-8">


<form method="post">


Wybierz produkt który chcesz dodać <br/>

<select name="cel" placeholder="co chcesz dodac?" required>
		
		
		
		<?php
		$zapytanie = @mysql_query ("SELECT * FROM produkt");
	while($option = @mysql_fetch_assoc($zapytanie)) {
echo '<option value="'.$option['id_produktu'].'">'.$option['nazwa'].'</option>';
}





?> 
	  

	</select>
	Ilość sztuk:
<input type="number" placeholder="Ilość" name="sztuk" required><br>
    <input type="submit" value="Dodaj!" />
  </form>
 <br><br>
 <h2> Lub dodaj własny i poczekaj!</h2>
  <form method="post">
   Nazwa:
  <input type="text" placeholder="Podaj nazwe" name="nazwa" required><br>
  kalorie:
  <input type="number" placeholder="Ilość kalorii" name="kalorie" required><br>
  welglowodany:
  <input type="number" placeholder="Węglowodany w gramach" name="weglowodany" required><br>
  białko:
  <input type="number" placeholder="Białko w gramach" name="bialko" required><br>
  tłuszcz:
  <input type="number" placeholder="Tłuszcz w gramach" name="tluszcz" required><br>
    <input type="submit" value="Dodaj!" />
  </form>
</div>
</div>