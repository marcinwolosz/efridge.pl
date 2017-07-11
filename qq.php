<?php
	session_start();
	

	$nazwa_produkt= $_POST['nazwa_produkt']; 
	$kalorie_produkt= $_POST['kalorie_produkt']; 
	$weglowodany_produkt= $_POST['weglowodany_produkt']; 
	$bialka_produkt= $_POST['bialka_produkt']; 
	$tluszcz_produkt= $_POST['tluszcz_produkt'];
	$przycisk= $_POST['przycisk'];
	
	try
	{
	if($przycisk =='DODAJ' ){
		
		
		mysql_connect("localhost","root", "") or die("cannot connect to database\n");
		mysql_select_db("baza") or die(mysql_error());
		mysql_query("SET AUTOCOMMIT=0");
		mysql_query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		mysql_query("START TRANSACTION");
		
		
		$a=mysql_query("INSERT INTO produkt VALUES(NULL, '$nazwa_produkt', '$kalorie_produkt', '$weglowodany_produkt', '$bialka_produkt', '$tluszcz_produkt')") or die(mysql_error());
		
		$b=mysql_query("Delete from produkt_akceptuj Where nazwa='$nazwa_produkt'");
		if($a and $b)
		{mysql_query("COMMIT");}
		else
		{mysql_query("ROLLBACK");}
	
	
		header("Location: admin.php");
		
		

		


		mysql_close();


		
}else{

$polaczenie=new mysqli("localhost","root", "", "baza");

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		
		if($polaczenie->query("
		Delete From 
produkt_akceptuj 
Where
nazwa='$nazwa_produkt'"))
		{
		header("Location: admin.php");
		
		}else
                    {
                        throw new Exception($polaczenie->error);
                    }

		}


		$polaczenie->close();

}
	}
	catch(Exception $e)
	{
		echo ' BLAD SERWERA PROSZE LOGOWAC SIE W INNYM TERMINIE ';
	}


		
	







	
	
		
?>
