<?php
include('../app/template/global/header.php');
if (isset($_POST) && !empty($_POST)) {
	if ($_POST['inputPass'] == $_POST['inputPassConfirm']){
		$_SESSION['register']['Login'] = htmlspecialchars($_POST['inputLogin']);
		$_SESSION['register']['Pass'] = md5($_POST['inputPass']);
		$_SESSION['register']['Email'] = htmlspecialchars($_POST['inputEmail']);
		header('Location: login.php');
	}else{
		$_POST = [];
		header('Location: register.php');
	}
}
?>
<section class="container-fluid">
	<form class="col-xl-10 offset-xl-1"  id="connectForm" action="register.php" method="POST">
		<label class="form-control bg-dark text-light">Login :</label>
		<input type="text" name="inputLogin" class="form-control">
		<label class="form-control bg-dark text-light">Mot de passe :</label>
		<input type="password" name="inputPass" class="form-control">
		<label class="form-control bg-dark text-light">Confirmation de mot de passe :</label>
		<input type="password" name="inputPassConfirm" class="form-control">
		<label class="form-control bg-dark text-light">Email :</label>
		<input type="email" name="inputEmail" class="form-control">
		<button type="submit" id="btnRegisterSubmit" name="btnRegisterSubmit" class="form-control btn btn-primary">S'enregistrer</button>
	</form>
	
</section>
<?php
include('../app/template/global/footer.php');
?>	