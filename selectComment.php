<?php
ob_start();
session_start();

/*

<form action="addComment.php" class="col-10" id="formularzKomentarz">
	<input class="col-12 commentValue" type="text" name="LastName"
		value="" placeholder="Dodaj komentarz.."><br>
	<input type="hidden" name="categoryId" value="<?=$folderId?>" />
	<input type="hidden" name="userId" value="<?=$id?>" />
	<input type="hidden" id="fileNameComment" name="fileName" value="" />
</form>

*/

if( !empty( $_SESSION ) ){
	// łączę się z bazą
	try{
		$pdo = new PDO('sqlite:database/mojaChmura');
		
		$select = "SELECT * FROM files WHERE fileName = :fileName AND categoryId = :categoryId";
		$stmt = $pdo -> prepare( $select );
		$stmt -> bindParam( ':fileName', $_POST['fileName'] );
		$stmt -> bindParam( ':categoryId', $_POST['categoryId'] );
		
		$stmt -> execute();
		$res = $stmt -> fetch( PDO::FETCH_ASSOC );
		
		$fileId = $res['FileId'];
		
		$select = "SELECT * FROM Comments WHERE fileId = :fileId";
		$stmt = $pdo -> prepare( $select );
		
		var_dump( $_POST );
		
		$stmt -> bindParam( ':fileId', $_POST['Id'] );
	
		$stmt -> execute();
		$res = $stmt -> fetch( PDO::FETCH_ASSOC );
		
		$userName = $res['UserName'];
		
		echo '<div class="row"><b class="list-group-item col-2">'.$userName.'</b><p class="list-group-item  col-8 "> ' . $_POST['commentValue'] . '</p></div>';
	}catch(PDOException $e)
	{
		// coś tam z błędem
		echo 'Nie można połączyć się z bazą :(';
	}
}else{
	echo 'blad';
}

ob_end_flush();
?>