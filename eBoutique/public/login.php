<?php
include('../app/template/global/header.php');


// We verify if a form has been sent and it not empty
if (isset($_POST) && !empty($_POST)){
	$passUnHashs = $_POST['inputPassword'];
	$passHashe = md5($_POST['inputPassword']);
	

		// We create a new object User which has the values of input's login form
		$user = new User(htmlspecialchars($_POST['inputLogin']), $passHashe);
	
		// We serialize the object to put him into a new file at next step
		$userSerialize = serialize($user);
	
		// We generate a unique name for the new file.
		$time = Date("Y-m-d-H-i-s"); 
		$filename = sha1($user->_userLogin.$time);
		// We open a file which not exist, so it created. He must be create with a unique name.
		$file = fopen('../app/template/config/sessions/'.$filename, 'w');
		fwrite($file,$userSerialize);
		fclose($file);
		$_SESSION['log']['file'] = $filename;
		header('Location: secure.php'); // We redirect the user to the account page
		exit;

}
?>
<section class="container-fluid">
	<form class="col-xl-10 offset-xl-1" id="loginForm" action="login.php" method="POST">
		<label class="form-control bg-dark text-light">Votre Login :</label>
		<input type="text" id="inputLogin" name="inputLogin" class="form-control">
		<label class="form-control bg-dark text-light">Votre mot de passe :</label>
		<input type="password" id="inputPassword" name="inputPassword" class="form-control">
		<button type="submit" id="btnConnectSubmit" name="btnConnectSubmit" class="form-control btn btn-primary">Se Connecter</button>
		
	</form>
</section>
<?php
include('../app/template/global/footer.php');
?>