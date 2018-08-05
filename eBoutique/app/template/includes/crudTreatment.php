<?php
// Adding Database Connexion
require '../global/addTopApp.php';

// Treatment for user add form
if (isset($_POST['submitAddUser']) && !empty($_POST['submitAddUser'])){
	$user = new User(htmlspecialchars($_POST['addUserLogin']),md5($_POST['addUserPassword']),htmlspecialchars($_POST['addUserEmail']));
	$user->add($bdd);
	header('Location:/../eBoutique/public/account.php');
}

if (isset($_POST['submitUpUser']) && !empty($_POST['submitUpUser'])) {
	$user = new User(htmlspecialchars($_POST['updUserLogin']),
		"",
		htmlspecialchars($_POST['updUserMail']),
		htmlspecialchars($_POST['updUserRank']),
		htmlspecialchars($_POST['updUserId']),
		htmlspecialchars($_POST['updUserFirstName']),
		htmlspecialchars($_POST['updUserLastName']),
		htmlspecialchars($_POST['updUserAdress']),
		htmlspecialchars($_POST['updUserPostalCode']),
		htmlspecialchars($_POST['updUserCity']),
		htmlspecialchars($_POST['updUserDob']),
		htmlspecialchars($_POST['updUserSecu']),
		htmlspecialchars($_POST['updUserSalaire']));
	try{
		echo "<pre>";
		$user->update($bdd);
		echo "</pre>";
	}catch (CustomException $e){
		die ("<br /><strong>Error ! Details : </strong><br>".$e->getMessage());
	}
	
	header('Location:/../eBoutique/public/account.php');
}

if (isset($_POST['submitDelUser']) && !empty($_POST['submitDelUser'])) {
	$user = new User ("","","","",htmlspecialchars($_POST['delUserId']));
	$user->delete($bdd,$user->_userId);
	header('Location:/../eBoutique/public/account.php');
}

if (isset($_POST['submitAddProduct']) && !empty($_POST['submitAddProduct'])) {
	// Verify id an image has been selected
	if (isset($_FILES['addProdImg']) && !empty($_FILES['addProdImg'])){
		// Allowed extension array
		$allowedExt = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		// Format the uploaded extension
		$uploadedExt = strtolower(substr(strrchr($_FILES['icone']['name'],'.'),1));
		// Verify if the uploaded extension match with one in the array
		if (in_array($uploadedExt,$allowedExt)){
			//$lastID = $bdd->query("SELECT `article_id` FROM `article` ORDER BY `article_id` DESC LIMIT 1");
			//$newId = $lastID+1;
			//$newFileName = "/app/uploadedImg/".$newId.".".$uploadedExt;
			$dest = '../uploadedImg/';
			$execMove = move_uploaded_file($_FILES['addProdImg']['tmp_name'],$dest);
		}

	}
	//if (!isset($newFileName) || empty($newFileName)){
		//$newFileName = "";
	//}
	$product = new Article(htmlspecialchars($_POST['addProdName']),
		htmlspecialchars($_POST['addProdDesc']),
		htmlspecialchars($_POST['addProdPrice']),
		$dest.$_FILES['addProdImg']['tmp_name'],
		htmlspecialchars($_POST['addProdCat']),
		htmlspecialchars($_POST['addProdQte'])
	);
	$product->add($bdd);
	header('Location: /../eBoutique/public/account.php');	

}