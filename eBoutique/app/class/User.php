<?php
/**
 * 
 */

class User implements CrudInterface
{

	private $_userId,$_userLogin,$_userPass,$_userFName,$_userLName,$_userAdress,$_userCP,$_userCity,$_userDOB,$_userSecu,$_userRank,$_userSalaire,$_userMail;
	function __construct($userLogin,$userPass,$userMail = "",$rank=0,$id = "",$firstName ="",$lastName ="",$adress = "",$cp="",$city="",$dob="",$secu="",$salaire=""){
		$this->_userLogin = $userLogin;
		$this->_userPass = $userPass;
		$this->_userMail = $userMail;
		$this->_userRank = $rank;
		$this->_userFName = $firstName;
		$this->_userLName = $lastName;
		$this->_userAdress = $adress;
		$this->_userCP = $cp;
		$this->_userCity = $city;
		$this->_userDOB = $dob;
		$this->_userSecu = $secu;
		$this->_userSalaire = $salaire;
		$this->_userId = $id;
	}
	
	public function __get($var){
		return $this->$var;
	}

	public function __set($var,$attr){
		$this->$attr = $var;
	}

	public function authenticate($bdd){
		$auth = $bdd->prepare("SELECT * FROM `user` WHERE `user_login` = :login AND `user_password` = :pass");
		$auth->bindParam(':login', $this->_userLogin);
		$auth->bindParam(':pass', $this->_userPass);
		$exec = $auth->execute();
		if ($exec){
			echo '$exec->$bdd->execute() OK'; // Debug
		}else{
			throw new CustomException("An error occured, please check your query in User.php -> authenticate()",'0x400');
		}
		$result = $auth->rowCount();
		if ($result == 1) {
			// Creating session
			$user = $auth->fetch();
			$_SESSION['user']['ID'] = $user['user_id'];
			$_SESSION['user']['LOGIN'] = $user['user_login'];
			$_SESSION['user']['MAIL'] = $user['user_mail'];
			$_SESSION['user']['RANK'] = $user['rank_id'];
			$_SESSION['user']['CONNECT'] = Date("Y-m-d-H-i-s");
			$file = '../app/logs/connection.txt';
			$newLine = "\nConnexion : ".$_SESSION['user']['CONNECT']." - ".$_SESSION['user']['ID']." ".$_SESSION['user']['MAIL']." Statut : OK Rank :".$_SESSION['user']['RANK'];
			file_put_contents($file, $newLine, FILE_APPEND | LOCK_EX);
			
		} else {
			//$_SESSION['debug']['login'] = $this->_userLogin; // Debug
			//$_SESSION['debug']['pass'] = $this->_userPass; // Debug
			header('Location: badLogin.php');
		}
		
		
	}

	public function add($bdd){
		$addUser = $bdd->prepare("INSERT INTO `user` (`user_login`,`user_password`,`user_mail`,`user_account_create`,`rank_id`) VALUES (:login,:pass,:mail,NOW(),0)");
		$addUser->bindParam(":login",$this->_userLogin, PDO::PARAM_STR);
		$addUser->bindParam(":pass",$this->_userPass, PDO::PARAM_STR);
		$addUser->bindParam(":mail",$this->_userMail, PDO::PARAM_STR);
			//$addUser->bindParam(":rank",$rank, PDO::PARAM_INT);
			//var_dump($addUser); // Debug
		$exec = $addUser->execute();
		if ($exec){
			//echo "Add OK"; // Debug
			unset($_SESSION['register']);
			
		}else{
			throw new CustomException('An error occured, please check your query in User.php -> add()','0x400');
		}
	}

	public function read($bdd, $id){
			//Code
	}

	public function update($bdd){
		$upUser = $bdd->prepare("UPDATE `user` SET `user_login` = :login,`user_first_name` = :firstname,`user_last_name` = :lastname,`user_mail` = :mail,`user_adress` = :adress,`user_postal_code` = :cp,`user_city` = :city,`user_date_of_birth` = :dob,`rank_id` = :rank,`user_secu` = :secu,`user_salaire` = :salaire WHERE `user_id` = :id");
		$upUser->bindParam(':id',$this->_userId, PDO::PARAM_INT);
		$upUser->bindParam(':login',$this->_userLogin);
		$upUser->bindParam(':firstname',$this->_userFName);
		$upUser->bindParam(':lastname',$this->_userLName);
		$upUser->bindParam(':mail',$this->_userMail);
		$upUser->bindParam(':adress',$this->_userAdress);
		$upUser->bindParam(':cp',$this->_userCP, PDO::PARAM_INT);
		$upUser->bindParam(':city',$this->_userCity);
		$upUser->bindParam(':dob',$this->_userDOB);
		$upUser->bindParam(':rank',$this->_userRank, PDO::PARAM_INT);
		$upUser->bindParam(':secu',$this->_userSecu);
		$upUser->bindParam(':salaire',$this->_userSalaire);
		var_dump($this);
		$exec = $upUser->execute();
		if (!$exec){
			$upUser->debugDumpParams ();
			throw new CustomException('An error occured, please check your query in User.php -> update()','0x400');
		}

	}

	public function delete($bdd, $id){
		$delUser = $bdd->query('DELETE FROM `user` WHERE user_id = '.$id);
	}

	// Static funciton to get All User in Database
	public static function getAllUsers($bdd){
		$getUsers = $bdd->query("SELECT * FROM `user`");
		$return = "";
		if ($getUsers->rowCount() > 0){
			$listUsers = $getUsers->fetchAll();
			foreach ($listUsers as $key => $value) {

				// Generate a new  update modal for each line linked to the ID
				$upModal = "<!-- MODAL TO Update USER -->
				<!-- Modal Start -->
				<div class='modal fade' id='modalUpdUser".$value['user_id']."' tabindex='-1' role='dialog' aria-labelledby='modalUpdUser".$value['user_id']."Label' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
				<div class='modal-content'>
				<div class='modal-header'>
				<h5 class='modal-title' id='modalUpdUserLabel'>Modifier un utilisateurs</h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
				</div>
				<div class='modal-body'>
				<form method='POST' action='../app/template/includes/crudTreatment.php'>
				<!-- USER ID - SR ONLY -->
				<input type='text' class='sr-only' name='updUserId' value='".$value['user_id']."'>
				<!-- USER LOGIN -->
				<label class='form-control bg-dark text-light'>Login :</label>
				<input type='text' name='updUserLogin' class='form-control' value='".$value['user_login']."'>
				<!-- USER FIRST NAME -->
				<label class='form-control bg-dark text-light'>First Name :</label>
				<input type='text' name='updUserFirstName' class='form-control' value='".$value['user_first_name']."'>
				<!-- USER LAST NAME -->
				<label class='form-control bg-dark text-light'>Last Name :</label>
				<input type='text' name='updUserLastName' class='form-control' value='".$value['user_last_name']."'>
				<!-- USER MAIL -->
				<label class='form-control bg-dark text-light'>Email :</label>
				<input type='text' name='updUserMail' class='form-control' value='".$value['user_mail']."'>
				<!-- USER ADRESS -->
				<label class='form-control bg-dark text-light'>Adress :</label>
				<input type='text' name='updUserAdress' class='form-control' value='".$value['user_adress']."'>
				<!-- USER POSTAL CODE -->
				<label class='form-control bg-dark text-light'>Postal Code :</label>
				<input  type='text' name='updUserPostalCode' class='form-control' value='".$value['user_postal_code']."'>
				<!-- USER CITY -->
				<label class='form-control bg-dark text-light'>City :</label>
				<input type='text' name='updUserCity' class='form-control' value='".$value['user_city']."'>
				<!-- USER DOB -->
				<label class='form-control bg-dark text-light'>Date of Birth :</label>
				<input type='date' name='updUserDob' class='form-control' value='".$value['user_date_of_birth']."'>
				<!-- RANK ID -->
				<label class='form-control bg-dark text-light'>Rank :</label>
				<input type='number' min='0' max='2' name='updUserRank' class='form-control' value='".$value['rank_id']."'>
				<!-- USER SECU -->
				<label class='form-control bg-dark text-light'>N° Secu :</label>
				<input type='text' name='updUserSecu' class='form-control' value='".$value['user_secu']."'>
				<!-- USER SALAIRE -->
				<label class='form-control bg-dark text-light'>Salaire :</label>
				<input type='text' name='updUserSalaire' class='form-control' value='".$value['user_salaire']."'>					

				</div>
				<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
				<input type='submit' name='submitUpUser' class='btn btn-primary' value='Update User'>
				</form>
				</div>
				</div>
				</div>
				</div>
				<!-- Modal End -->";

			// Generate a new delete modal for each line linked to the ID

				$delModal = "<!-- MODAL TO Delete USER -->
				<!-- Modal Start -->
				<div class='modal fade' id='modalDelUser".$value['user_id']."' tabindex='-1' role='dialog' aria-labelledby='modalDelUserLabel".$value['user_id']."Label' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
				<div class='modal-content'>
				<div class='modal-header'>
				<h5 class='modal-title' id='modalDelUserLabel".$value['user_id']."'>Supprimer un utilisateurs</h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
				</div>
				<div class='modal-body'>
				<form method='POST' action='../app/template/includes/crudTreatment.php'>
				<!-- USER ID - SR ONLY -->
				<input type='text' class='sr-only' name='delUserId' value='".$value['user_id']."'>
				<!-- USER LOGIN -->
				<label class='form-control bg-dark text-light'>Login :</label>
				<input type='text' name='delUserLogin' class='form-control' value='".$value['user_login']."'  readonly>
				<!-- USER FIRST NAME -->
				<label class='form-control bg-dark text-light'>First Name :</label>
				<input type='text' name='delUserFirstName' class='form-control' value='".$value['user_first_name']."' readonly>
				<!-- USER LAST NAME -->
				<label class='form-control bg-dark text-light'>Last Name :</label>
				<input type='text' name='delUserLastName' class='form-control' value='".$value['user_last_name']."' readonly>
				<!-- USER MAIL -->
				<label class='form-control bg-dark text-light'>Email :</label>
				<input type='text' name='delUserMail' class='form-control' value='".$value['user_mail']."' readonly>
				<!-- USER CITY -->
				<label class='form-control bg-dark text-light'>City :</label>
				<input type='text' name='delUserCity' class='form-control' value='".$value['user_city']."' readonly>
				<!-- RANK ID -->
				<label class='form-control bg-dark text-light'>Rank :</label>
				<input type='number' min='0' max='2' name='delUserRank' class='form-control' value='".$value['rank_id']."' readonly>		

				</div>
				<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
				<input type='submit' name='submitDelUser' class='btn btn-danger' value='Delete User'>
				</form>
				</div>
				</div>
				</div>
				</div>
				<!-- Modal End -->";
				// Generate a new array line
				echo "<tr><td>".$value['user_id']."</td><td>".$value['user_login']."</td><td>".$value['user_mail']."</td><td>".$value['rank_id']."</td><td><button class='btn btn-warning' data-toggle='modal' data-target='#modalUpdUser".$value['user_id']."'><span class='fas fa-pen'></span></button>&nbsp;".$upModal.$delModal."<button class='btn btn-danger' data-toggle='modal' data-target='#modalDelUser".$value['user_id']."'><span class='fas fa-ban'></span></button></td></tr>";

			}
		}else{
			return 'Aucun utilisateur trouvé';
		}
	}
}