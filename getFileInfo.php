<?php
ob_start();
session_start();

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
		
		$informacje = '<div>
										<div class="row">
											<div class="col-8"><div onmouseover="$(\'.visibleArrow\', this).css(\'visibility\', \'visible\')"
											onmouseout="$(\'.visibleArrow\', this).css(\'visibility\', \'hidden\');"
											class="filename mpg">
											<h3>
											<i class="far fa-file"></i>

												<a class="expanderHeader downloadAction downloadContext"
													href="uploads/'.$res['FileName'].'" title="'.$res['FileName'].'" download>
													<span class="bold">'.$res['FileName'].'</span>
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

									</div>';
									
									
		 echo $informacje;	
		
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