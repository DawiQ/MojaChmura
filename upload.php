
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
    $uploadOk = 0;
}

$name = uniqid("file_").'.'.$imageFileType;

 // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$name)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		try{
			$pdo = new PDO('sqlite:database/mojaChmura');
			$query = 'insert into Files(CategoryId, FileName) Values (:categoryId,:name)';
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(':categoryId',$_GET['categoryId']);
			$stmt->bindParam(':name',$name);
			$stmt->execute();
		}catch(PDOException $e)
		{
			// coś tam z błędem
			echo 'Nie można połączyć się z bazą :(';
		}
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

header("Location: index.php?userId=".$_GET['userId']."&category=".$_GET['categoryId']);
die();
?>
