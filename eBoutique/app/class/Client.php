<?php

/**
 * Class Client, extends from Class Personne which has an interface implementation
 * @id : int (max length 11)
 * @firstName,lastName,mail,city,password : string
 * @postalCode : int (max length 5)
 * @dateOfBirth,dateCreateAccount : date (international pattern : yyyy-mm-dd)
 */
class Client extends Personne

{

	use TraitVerification; // Implement a specific trait for verifications

	private $_password;
	private $_dateCreateAccount;
	
	function __construct($id,$firstName,$lastName,$mail,$postalCode,$city,$dateOfBirth,$password)
	{
		// Handling verification and increment the error's counter if needed
		$errorCount = 0;
		$dobX = explode('-', $dateOfBirth); // transform a string to an array
		if (!isValidName($firstName)){
			$errorCount++;
		}else if (!isValidName($lastName)){
			$errorCount++;
		}else if (!isValidMail($mail)){
			$errorCount++;
		}else if(!isValidPostalCode($postalCode)){
			$errorCount++;
		}else if (!isValidCity($city)){
			$errorCount++;
		}else if (!isValidDate($dateOfBirth)){
			$errorCount++;
		}else if (!isValidPassword($password)){
			$errorCount++;
		}

		// If we have any error, we generate a custom exception before creating object, else we create it
		if ($errorCount > 0){
			throw new CustomExeption('At least one of __construct() parameter has an issue');
		}else{
			$this->_id = $id;
			$this->_firstName = $firstname;
			$this->_lastName = $lastName;
			$this->_mail = $mail;
			$this->_postalCode = $postalCode;
			$this->_city = $city;
			$this->_dateOfBirth = $dateOfBirth;
			$this->_password = $password;
			$this->_dateCreateAccount = new Date();
		}
				
	}
	//Accesseurs

		public function getPassword(){
			return $this->_password;
		}

		public function getDateCreateAccount(){
			return $this->_dateCreateAccount;
		}

		//Mutateurs

		public function setPassword($pass){
			$this->_password = $pass;
		}

		//Method

		public function add($bdd){
			//Code
		}

		public function read($bdd, $id){
			//Code
		}

		public function update($bdd){
			//code
		}

		public function delete($bdd, $id){
			//code
		}

		public function authenticationClient(){
			//Code 
		}

		public function infoModifier(array $arg){
			
		}
}