<?php
ob_start();
session_start();

if( empty( $_SESSION ) || !isset( $_SESSION['logged'] ) || $_SESSION['logged'] == 0 ){
	header("Location: login.php");
	die();
}

//sprawdzam czy wywołano akcję wylogowania
if( isset( $_GET['logout'] ) ){
	$_SESSION['logged'] = 0;
	session_destroy();
	
	header("Location: login.php");
	die();
}else if( isset( $_POST ) && !empty($_POST)){
	
	// łączę się z bazą
	try{
		$pdo = new PDO('sqlite:database/mojaChmura');
	}catch(PDOException $e)
	{
		// coś tam z błędem
		echo 'Nie można połączyć się z bazą :(';
	}
	//tutaj obsługujemy ewentualne formularz w taki sposób:
	// potrzebne dane pobieramy ze zemiennej $_SESSION lub $_POST lub $_GET
	// $_POST odpowiada za dane przesyłane przez formularz
	// $_GET to tablica parametrów z adresu tzn stąd http://localhost/index.php?zmienna1=wartosc&zmienna2=wartosc2
	// w $_SESSION przechowujemy informacje o zalogowanym uzytkowniku
	// do wyswietlania zawartosci poszczegolnych tablic polecam funkcje var_dump() która jako
	// parametr przyjmuje tablice do wyswietlenia
	
	// tutorial do bazy danych https://websitebeaver.com/php-pdo-prepared-statements-to-prevent-sql-injection#named-parameters
	// łączymy się z bazą przez zmienną $pdo 
	
	
	
	
	// tutaj leci kod
	
	
	
	
	
	// tutaj strona się odświeży żeby nie stracić danych o oglądanym folderze itp
	header("Refresh:0");
	die();
	
}else{
	try{
		$pdo = new PDO('sqlite:database/mojaChmura');
	}catch(PDOException $e)
	{
		// coś tam z błędem
		echo 'Nie można połączyć się z bazą :(';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Moja Chmura</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link href="css/sidebar.css" rel="stylesheet">
	<link href="css/panel.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
		integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">



	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


</head>

<body>
	<div class="d-flex" id="wrapper">

		<!-- Sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading ">

				<div class="sidebar-user-picture">
					<img alt="Avatar" id="avatar" src="<?= $_SESSION['userImage'] ?>">
				</div>

				<div class="userName">
					<span><?= $_SESSION['userName']?></span>
				</div>
			</div>
			<div class="logoutButton">
				<a href="?logout">WYLOGUJ SIĘ</a>
			</div>

			<div class="form-group has-search">
				<span class="fa fa-search form-control-feedback"></span>
				<input type="text" class="form-control mojaKlasa" placeholder="Search">
			</div>

			<div class="list-group list-group-flush">
				<?php
				
					if( !isset( $_GET['userId'] ) ){
						$query = "SELECT * FROM Users WHERE UserId = :userName";
					}
					
					$query = "SELECT UserName, UserId FROM Users";
					$stmt = $pdo -> prepare( $query );
					
					$stmt -> execute();
					$result = $stmt -> fetchAll( PDO::FETCH_ASSOC );
					
					foreach( $result as $user ){
						?>
							<a href="?userId=<?=$user['UserId']?>" class="list-group-item list-group-item-action bg-light"><?= $user['UserName']?></a>
						<?php
					}
				
				?>
				
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#"><</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">4</a></li>
						<li class="page-item"><a class="page-link" href="#">></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">

			<button class="btn btn-primary" id="menu-toggle"><i class="fas fa-expand"></i></button>
			<!--<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item active">
				  <a class="nav-link" href="#">Tutaj nie wiem czy coś dajemy? :D Może LOGOUT?</span></a>
				</li>
			  </ul>
			</div>
		  </nav>-->

			<div class="container-fluid">
			
				<?php
				
				if( $_SESSION['showedHey'] == 0 ){
					$_SESSION['showedHey'] = 1;
					?>
					
					<div class="alert alert-success goodJob" role="alert">
						<h4 class="alert-heading">Dobra robota!</h4>
						<i class="far fa-times-circle"></i>
						<p>Cześć! Właśnie zalogowałeś się na konto w systemie Moja Chmura! Dzielenie się plikami łatwiejsze
							nie będzie!</p>
						<hr>
						<p class="mb-0">Już teraz rozpocznij przygodę z naszym systemem i podziel się z nami swoimi plikami!
						</p>
					</div>
					<?php
					
				}
						
				?>

				<div id="file">

				</div>

				<?php
					if( !isset( $_GET['userId'] ) ){
						$id = $_SESSION['userId'];
					}else{
						$id = $_GET['userId'];
					}
						
					$query = "SELECT * FROM Users WHERE UserId = :userId";
					$stmt = $pdo -> prepare( $query );
					$stmt -> bindParam( ":userId", $id );
					
					$stmt -> execute();
					$result = $stmt -> fetch( PDO::FETCH_ASSOC );
				
				?>
				
				<div id="myFiles">
					<h1 class="mt-4">Pliki użytkownika <?= $result['UserName']?></h1>

					<div class="explorer" style="margin-top:30px;">
						<div class="leftPanel">
							<div class="list-group">
							<?php
							
								// pobieranie Id root'a
								$query = "SELECT * FROM Categories WHERE UserId = :userId  AND CategoryParent = 0";
								$stmt = $pdo -> prepare( $query );
								$stmt -> bindParam( ":userId", $id );
								
								$stmt -> execute();
								$rootId = $stmt -> fetch( PDO::FETCH_ASSOC );
								$rootId = $rootId['CategoryId'];
								
								$query = "SELECT * FROM Categories WHERE UserId = :userId  AND CategoryParent = :rootId";
								$stmt = $pdo -> prepare( $query );
								$stmt -> bindParam( ":userId", $id );
								$stmt -> bindParam( ":rootId", $rootId );
								
								$stmt -> execute();
								$categories = $stmt -> fetchAll( PDO::FETCH_ASSOC );
								
								if( empty( $categories ) )
									echo "Brak kategorii";
								else
									foreach( $categories as $category ){
										?>
										<a href="?userId=<?=$id?>&category=<?=$category['CategoryId']?>" class="list-group-item list-group-item-action directory"><?=$category['CategoryName']?></a>
										<?php
									}
							?>
							</div>
						</div>
						
						<div class="rightPanel">
							<div id="Dokumenty">
								<?php
									if( !isset( $_GET['category'] ) || empty( $_GET['category'] ) ){
										$folderId = $rootId;
									}else{
										$folderId = $_GET['category'];
									}
								
									$query = "SELECT * FROM Categories WHERE UserId = :userId  AND CategoryParent = :folderId AND CategoryParent != :rootId";
									$stmt = $pdo -> prepare( $query );
									$stmt -> bindParam( ":userId", $id );
									$stmt -> bindParam( ":folderId", $folderId );
									$stmt -> bindParam( ":rootId", $rootId );
									
									$stmt -> execute();
									$categories = $stmt -> fetchAll( PDO::FETCH_ASSOC );
									
										foreach( $categories as $category ){
											?>
											<div class="folder">
												<i class="far fa-folder"></i>
												<a href="?userId=<?=$id?>&category=<?=$category['CategoryId']?>"><?=$category['CategoryName'] ?></a>
											</div>
											<?php
										}
										
										if( !empty( $categories ) )
											echo '<br>';
								
									$query = "SELECT * FROM Files WHERE CategoryId = :folderId";
								
									$stmt = $pdo -> prepare( $query );
									$stmt -> bindParam( ":folderId", $folderId );
									
									$stmt -> execute();
									$files = $stmt -> fetchAll( PDO::FETCH_ASSOC );
									
										foreach( $files as $file ){
											?>
											<div class="file" class="pliczek">
												<i class="far fa-file"></i>
												<?=$file['FileName']?>
											</div>
											<?php
										}
										
										
									if( empty( $files ) && empty( $categories ) )
										echo "Brak danych";
									
								?>
							</div>
						</div>
					</div>


					<form action="upload.php?userId=<?=$id?>&categoryId=<?=$folderId?>" method="post" enctype="multipart/form-data" class="mt-3 p-3 bordering">
						<div class="form-group">
							<h5>Wybierz plik do przesłania</h5>
							
							<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
							<input type="submit" value="Dodaj plik" name="submit" class="btn btn-dark mt-1">
						</div>
					</form>

					<form method="POST" action="createFolder.php?userId=<?=$id?>&categoryId=<?=$folderId?>" class="mt-3 p-3 bordering">
						<div class="form-group">
							<h5>Nowy Folder:</h5>
							<input type="email" class="form-control" name="newDir" id="newDir" aria-describedby="emailHelp" placeholder="Nazwa folderu..">
							<small id="emailHelp" class="form-text text-muted">Gdy jesteś w korzeniu zostanie utworzona kategoria.</small>
							<button type="submit" name="uploadBtn2" class="btn btn-primary mt-1">Utwórz folder</button>
						</div>
				  </form>




					<div id = "lastActivity" class="container">
						<h1 class="mt-4">Ostatnia aktywność</h1>
						<div class="col-12" style="margin-top:30px;">
							<div class="list-group">
								<div href="#" class="list-group-item list-group-item-action">
									<div class="col-6">
										<i>Moje koncicho</i> dodał plik <i>ważneDane.pdf</i> w kategorii
										<b>Dokumenty</b>
									</div>
								</div>
								<div href="#" class="list-group-item list-group-item-action">
									<div class="col-6">
										<i>Moje koncicho</i> dodał plik <i>pliczek.txt</i> w kategorii <b>Dokumenty</b>
									</div>
								</div>
								<div href="#" class="list-group-item list-group-item-action">
									<div class="col-6">
										<i>Moje koncicho</i> utworzył folder <i>Drugi folder</i> w kategorii
										<b>Dokumenty</b>
									</div>
								</div>
								<div href="#" class="list-group-item list-group-item-action">
									<div class="col-6">
										<i>Moje koncicho</i> dodał plik <i>pliczkowo.txt</i> w kategorii <b>Folder</b>
									</div>
								</div>
								<div href="#" class="list-group-item list-group-item-action">
									<div class="col-6">
										<i>Moje koncicho</i> dodał plik <i>kolokwium.pdf</i> w kategorii <b>Filmiki</b>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id = "fileInfo" class="hidden">
					<div class="container">
						<h1 class="mt-4">Informacje o pliku</h1>

					<i class="far fa-times-circle closeFilePanel"></i>
						<div class="col-12" style="margin-top:30px;">
							<div class="list-group">
								<div href="#" class="list-group-item list-group-item-action">
									<div>
										<div class="row">
											<div class="col-8"><div onmouseover="$('.visibleArrow', this).css('visibility', 'visible')"
											onmouseout="$('.visibleArrow', this).css('visibility', 'hidden');"
											class="filename mpg">
											<h3>
											<i class="far fa-file"></i>

												<a class="expanderHeader downloadAction downloadContext"
													href="uploads/pliczek.txt" title="pliczek.txt">
													<span class="bold"> </span>
												</a>

											<i class="fas fa-cloud-download-alt downloadArrow visibleArrow"></i>

											</h3>

										</div></div>
											<div class="col-4">
												<div>&#9733;&#9733;&#9733;&#9734;&#9734; 3/5</div>
												<div><span>701,5 MB</span></div>
												<div>
													<i class="fas fa-calendar-week"></i> 10 paź 14 19:46
												</div>
											</div>
										</div>

										

										<div class="row">
											<div class="col-3">
												<img class="img-fluid" , class="img-responsive"
													src="https://marketplace.canva.com/MAB5sssN0Qw/1/thumbnail_large/canva-file--MAB5sssN0Qw.png">
											</div>
											<div class="col-9">
												<b style="font-family:normal;font-size:15px;color:#000000;">
													<br>Gatunek:PLIK,TEXT
													<br>Plik zawierający plany podbicia świata przy pomocy ogórka.
													<br></b>
												<br>
												</span>
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>


	
				<div class="container">
					<div class="col-12" style="margin-top:10px;">
						<div class="list-group">
							<div href="#" class="list-group-item list-group-item-action">
								<div>
									<div class="row">
										<form class="col-10">
											<input class="col-12 commentValue" type="text" name="LastName"
												value="" placeholder="Dodaj komentarz.."><br>
										</form>
										<input class="col-2 submitComment " type="submit" value="Wyślij">
									</div>

									<div href="#" class="list-group-item list-group-item-action comments" style="margin:5px">
										<div class="row">
											<b class="list-group-item col-2">Uzytkownik</b>
											<p class="list-group-item  col-8 "> przykładowy komentarz</p>
										</div>
										<div class="row">
											<b class="list-group-item col-2">koncicho</b>
											<p class="list-group-item  col-8 "> hehe fajny plik</p>
										</div>
										<div class="row">
											<b class="list-group-item col-2">Kamil</b>
											<p class="list-group-item  col-8 "> Beznadziejne, lepiej to usuń</p>
										</div>
									</div>



								</div>
							</div>

						</div>
					</div>
				</div>
			</div>


			</div>

			</div>


		</div>
	</div>
	</div>
	<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
		integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
		crossorigin="anonymous"></script>
	<script type="text/javascript"
		src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
	<script type="text/javascript" src="http://www.prepbootstrap.com/Content/data/fileManagerData.js"></script>

	<script src="js/sidebarScript.js"></script>
	<script src="js/explorerScript.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>