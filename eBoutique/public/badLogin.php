<?php
include('../app/template/global/header.php');
?>
<h1>Bad Login</h1>
<p>
	 Ups ! Something goes wrong ! <br />
	Please sign-up <a href="register.php">here</a> or if you are already registered sign-in <a href="login.php">here</a>
	<br>
	Login envoyé : <?= $_SESSION['debug']['login'] // Debug?>
	<br>
	MDP envoyé : <?= $_SESSION['debug']['pass'] // Debug ?>
</p>
<?php
include('../app/template/global/footer.php');
?>