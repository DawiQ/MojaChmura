<?php
ob_start();
session_start();

if( !empty( $_SESSION ) ){
	// łączę się z bazą
	try{
		$pdo = new PDO('sqlite:database/mojaChmura');
		$query = "INSERT INTO Categories( UserId, CategoryName, CategoryParent ) VALUES (:userId, :categoryName, :categoryParent)";
		
		$stmt = $pdo -> prepare( $query );
		$stmt -> bindParam( ':userId', $_GET['userId'] );
		$stmt -> bindParam( ':categoryParent', $_GET['categoryId'] );
		$stmt -> bindParam( ':categoryName', $_POST['newDir'] );
		
		$stmt -> execute();
	}catch(PDOException $e)
	{
		// coś tam z błędem
		echo 'Nie można połączyć się z bazą :(';
	}
}else{
	
}

header("Location: index.php?userId=".$_GET['userId']."&category=".$_GET['categoryId']);
die();


ob_end_flush();
?>