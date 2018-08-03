<?php

trait TraitVerification{
	
	public function isValidNames($arg){

		return preg_match('/^[a-zA-Z]{2,30}$/', $arg);
	}

	public function isValidMail($arg){
		return filter_var($arg, FILTER_VALIDATE_EMAIL);
	}

	public function isValidPostalCode($arg){
		return preg_match('/^[0-9]{5}$/', $arg);
	}

	public function isValidCity($arg){
		return preg_match('/^[a-zA-Z- ]$/', $city);
	}

	public function isValidDate($arg){
		$argX = explode("-", $arg);
		return checkdate($argX[1], $argX[2], $argX[0]);
	}
	public function isValidPassword($arg){
		if (strlen($arg) >= 8 && strlen($arg) <= 11)
			return true;
		else
			return false;
	}
}