<?php
ob_start();
session_start();

if( !empty( $_SESSION ) ){
	// łączę się z bazą
	try{
		$pdo = new PDO('sqlite:database/mojaChmura');
		$query = "INSERT INTO Categories( UserId, CategoryName ) VALUES (:userId, :categoryId)";
		
		$stmt = $pdo -> prepare( $query );
		$stmt -> bindParam( ':userId', $_GET['userId'] );
		$stmt -> bindParam( ':categoryId', $_GET['categoryId'] );
		
		$stmt -> execute();
	}catch(PDOException $e)
	{
		// coś tam z błędem
		echo 'Nie można połączyć się z bazą :(';
	}
}else{
	
}

//header("Location: index.php?userId=".$_GET['userId']."&categoryId=".$_GET['categoryId']);
die();


ob_end_flush();
?>