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
		$stmt -> bindParam( ':fileName', $_POST['info'][1] );
		$stmt -> bindParam( ':categoryId', $_POST['info'][0] );
		
		$stmt -> execute();
		$res = $stmt -> fetch( PDO::FETCH_ASSOC );
		
		$fileId = $res['FileId'];
		
		$select = "SELECT * FROM Comments WHERE fileId = :fileId";
		$stmt = $pdo -> prepare( $select );
		
		$stmt -> bindParam( ':fileId', $fileId );
	
		$stmt -> execute();
		$res = $stmt -> fetchAll( PDO::FETCH_ASSOC );
		
		$string = '';
		if( !empty( $res ) )
			foreach( $res as $comment ){
				$select = "SELECT * FROM Users WHERE userId = :userId";
				$stmt = $pdo -> prepare( $select );
				$stmt -> bindParam( ':userId', $comment['userId'] );
				
				$stmt -> execute();
				$res = $stmt -> fetch( PDO::FETCH_ASSOC );
				
				$userName = $res['UserName'];
				
				$string .= '<div class="row"><b class="list-group-item col-2">'.$userName.'</b><p class="list-group-item  col-8 "> ' . $comment['commentValue'] . '</p></div>';
			}
		else
			$string = 'Brak komentarzy';
		
		echo $string;
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