<?php
require '../app/template/global/addtop.php';
if ( (isset($_SESSION['log']) && !empty($_SESSION['log'])) || (isset($_SESSION['register']) && !empty($_SESSION['register'])) || (isset($_SESSION['user']) && !empty($_SESSION['user'])) ){
		// See the file name stored in $_SESSION
		if (isset($_SESSION['log']['file']) && !empty($_SESSION['log']['file'])){
			//print_r($_SESSION['log']['file']); //Debug
			$loginInfos = file_get_contents('../app/template/config/sessions/'.$_SESSION['log']['file']);
			$userLogin = unserialize($loginInfos);
			try{
				//echo "<br>Login entré : ".$userLogin->_userLogin; //Debug
				//echo "<br>MDP entré : ".$userLogin->_userPass; //Debug
				$userLogin->authenticate($bdd);
				header('Location:account.php');
			}catch (CustomException $e){
				die ("<br /><strong>Error ! Details : </strong><br>".$e->getMessage());
			}
			
		}
		
		// See if a registration has been maked
		if (isset($_SESSION['register']) && !empty($_SESSION['register']))  {
			//print_r($_SESSION['register']); //Debug
			try{
				$user = new User($_SESSION['register']['Login'],$_SESSION['register']['Pass'],$_SESSION['register']['Email']);
				$user->add($bdd);
				header('Location: login.php');
			}catch (CustomException $e){
				die ("<br /><strong>Error ! Details : </strong><br>".$e->getMessage());
			}
			
		}
	}