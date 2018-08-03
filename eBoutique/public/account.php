<?php
include('../app/template/global/header.php');
?>
<section class="container-fluid">
	
	<?php


		// If a session user was created
	if(isset($_SESSION['user']['ID']) && !empty($_SESSION['user']['ID'])){ 
		// If user isn't employee or admin
		if ($_SESSION['user']['RANK'] < 1){
			?>
			<p>Bienvenu <strong><i> <?= $_SESSION['user']['LOGIN'] ?></i></strong></p>
			<div class="row">
				<aside class=" col-xl-3">
					<ul class="list-group">
						<li class="list-group-item">Mes informations</li>
						<li class="list-group-item">Mes commandes en cours</li>
						<li class="list-group-item">Support/SAV</li>
						<li class="list-group-item">Mes archives</li>
						<li class="list-group-item">Se déconnecter</li>
					</ul>
				</aside>
				<article class=" col-xl-9">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					<br />
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</article>
				
			</div>
			<?php
		}
		// If user is Admin, he would have to handle users
		if ($_SESSION['user']['RANK'] > 1){
			?>
			<h2>CRUD User :</h2>
			<div class="row">
				<button class="col-xl-4 offset-xl-4 btn btn-success" data-toggle="modal" data-target="#modalAddUser"><span class="fas fa-plus">&nbsp;</span>Ajouter un utilisateur</button>
			</div>
			<!-- MODAL TO ADD USER -->
			<!-- Modal Start -->
			<div class='modal fade' id='modalAddUser' tabindex='-1' role="dialog" aria-labelledby="modalAddUserLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalAddUserLabel">Ajouter un utilisateurs</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="../app/template/includes/crudTreatment.php">
								<label class="form-control bg-dark text-light">Login :</label>
								<input type="text" name="addUserLogin" class="form-control">
								<label class="form-control bg-dark text-light">Mot de passe :</label>
								<div class="row form-control">
									<input type="text" name="addUserPassword" id="addUserPassword"class="col-xl-6">
									<button type="button" id="generatePassword" class="col-xl-3 offset-xl-1 btn btn-secondary">Générer un pass</button>
								</div>
								<label class="form-control bg-dark text-light">Confirmation de mot de passe</label>
								<input type="password" name="addUserPasswordConfirm" class="col-xl-6">
								<label class="form-control bg-dark text-light">Email :</label>
								<input type="email" name="addUserEmail" class="form-control">							

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<input type="submit" name="submitAddUser" class="btn btn-primary" value="Add User">
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal End -->
			<table class="table" id="crudUserTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Login</th>
						<th>Mail</th>
						<th>Rank</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					User::getAllUsers($bdd);
					?>

				</tbody>
			</table>
			<?php 
		} 
		// If User is an employee or an admin, he should handle products and products categories
		if ($_SESSION['user']['RANK'] > 0){
			?>
			<h2>CRUD Produit :</h2>
			<div class="row">
				<button class="col-xl-4 offset-xl-4 btn btn-success"><span class="fas fa-plus">&nbsp;</span>Ajouter un produit</button>
			</div>
			<table class="table" id="crudProductTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Desc</th>
						<th>Tarif</th>
						<th>Category</th>
						<th>Qté</th>
						<th>Options</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						<td>0</td>
						<td>Costume gland</td>
						<td>Un costume si joli</td>
						<td>50</td>
						<td>Toys</td>
						<td>20</td>
						<td><button class="btn btn-warning"><span class="fas fa-pen"></span></button>&nbsp;<button class="btn btn-danger"><span class="fas fa-ban"></span></button></td>
					</tr>
				</tbody>
			</table>

			<h2>CRUD Category :</h2>

			<div class="row">
				<button class="col-xl-4 offset-xl-4 btn btn-success"><span class="fas fa-plus">&nbsp;</span>Ajouter une catégorie</button>
			</div>
			<table class="table" id="crudCategoryTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Desc</th>
						<th>Options</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						<td>0</td>
						<td>Toys</td>
						<td>Desc</td>
						<td><button class="btn btn-warning"><span class="fas fa-pen"></span></button>&nbsp;<button class="btn btn-danger"><span class="fas fa-ban"></span></button></td>
					</tr>
				</tbody>
			</table>
			<?php
		}
	}else{
		header('Location: badLogin.php');
	}
	?>	
	
</section>
<!-- Génération de mot de passe -->
<script type="text/javascript">

	function genererPassword(champ_cible) {
		var ok = 'azertyupqsdfghjkmwxcvbn123456789AZERTYUPQSDFGHJKMWXCVBN&~#{([-`_^)]}=';
		var pass = '';
		longueur = 16;
		for(i=0;i<longueur;i++){
			var wpos = Math.round(Math.random()*ok.length);
			pass+=ok.substring(wpos,wpos+1);
		}
		document.getElementById(champ_cible).value = pass;
	}

	document.getElementById('generatePassword').addEventListener('click',function($e){
		genererPassword('addUserPassword');
	})

    /*
       <input name="password" id="password" type="text" />
       <input type="button" name="generer" value="Générer" onclick="javascript:generer_password('password');" />
       */
   </script>
   <?php
   include('../app/template/global/footer.php');
   ?>