<?php
ob_start();
session_start();

// sprawdzam czy użytkownik nie jest czasem zalogowany
// jeżeli tak to wyjazd na strone główną
if( isset( $_SESSION['logged'] ) ){
	header("Location: index.php");
	die('Przekierowywanie..');
// tutaj sprawdzam czy wysłano formularz
}else if( isset( $_POST ) && !empty($_POST) ){
	try{
		$pdo = new PDO('sqlite:database/mojaChmura');
		
		// formularz logowania
		if( isset( $_POST['btnConfirmLogin'] ) ){
			$query = "SELECT * FROM Users WHERE UserName = :userName AND UserPassword = :userPassword";
			$stmt = $pdo -> prepare( $query );
			$stmt -> bindParam( ":userName", $_POST['login'] );
			$stmt -> bindParam( ":userPassword", $_POST['password'] );
			
			$stmt -> execute();
			$result = $stmt -> fetchAll( PDO::FETCH_ASSOC );
			
			if( !empty( $result ) ){
				$_SESSION['logged'] = 1;
				$_SESSION['userName'] = $result['UserName'];
				$_SESSION['userImage'] = $result['UserImage'];
				
				header("Location: index.php");
				die('Zalogowano');
			}
		// formularz rejstracji
		}else{
			echo 'Rejestracja';
		}
	}catch(PDOException $e)
	{
		// coś tam z błędem
		echo 'Nie można połączyć się z bazą :(';
	}
}

?>
<!DOCTYPE html>
<html lang="pl">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
        <link rel="stylesheet" href="css/loginStyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
		<title>Hello, world!</title>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    </head>
    <body>

        <div class="row no-gutters">

            <div id = "container" class="col-3">

				<div class="loginBox">
					<form action="login.php" method="POST">
						<div class = "row">
							<div class="col-1"></div>
							<div class = "col-10">
								<input id="login" name="login" type="text" placeholder="Nazwa użytkownika.." required pattern="[A-Za-z0-9]{1-20}" />
							</div>
						</div>

						<div class = "row">
							<div class="col-1"></div>
							<div class = "col-10">
								<input id="password" name="password" type="password" placeholder="Hasło.." required pattern="[A-Za-z0-9]{1-20}" />
							</div>
						</div>

						<div class = "row">
							<div class="col-5"></div>
							<div class = "col-6">
								<input id = "btnConfirm" name="btnConfirmLogin" type="submit" value="Zaloguj">
							</div>
						</div>
					</form>
				</div>
				
				<div class="registrationBox">
					<form action="login.php" method="POST">
						<div class = "row">
							<div class="col-1"></div>
							<div class = "col-10">
								<input id="userName" name="userName" type="text" placeholder="Nazwa użytkownika.." required pattern="[A-Za-z0-9]{1-20}" />
							</div>
						</div>
						
						<div class = "row">
							<div class="col-1"></div>
							<div class = "col-10">
								<input id="email" name="email" type="email" placeholder="E-mail.."  required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  />
							</div>
						</div>

						<div class = "row">
							<div class="col-1"></div>
							<div class = "col-10">
								<input id="password" name="password" type="password" placeholder="Hasło.." required pattern="[A-Za-z0-9]{1-20}" />
							</div>
						</div>

						<div class = "row">
							<div class="col-1"></div>
							<div class = "col-10">
								<input id="password2" name="password2" type="password" placeholder="Powtórz hasło.." required pattern="[A-Za-z0-9]{1-20}" />
							</div>
						</div>

						<div class = "row">
							<div class="col-5"></div>
							<div class = "col-6">
								<input id = "btnConfirm" name="btnConfirmRegistration" type="submit" value="Utwórz konto">
							</div>
						</div>
					</form>
				</div>

                <div class = "row no-gutters">
                        <input class = "col-12" id = "btnAction" type="button" value="Rejestracja" >
                </div>

            </div>

        </div>
		
		<script src="js/loginScript.js" type="text/javascript"></script>
        
    </body>
</html>
<?php
ob_end_flush();
?>
