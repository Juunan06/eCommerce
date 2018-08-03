<?php
/**
 * Class Personne, has an interface implementation. Abstract class
 * @id : int (max length 11)
 * @firstName,lastName,mail,city : string
 * @postalCode : int (max length 5)
 * @dateOfBirth : date (international pattern : yyyy-mm-dd)
 */

abstract class Personne implements CrudInterface{

	protected $_id;
	protected $_firstName;
	protected $_lastName;
	protected $_mail;
	protected $_postalCode;
	protected $_city;
	protected $_dateOfBirth;

	public abstract function infoModifier(array $arg);
	
	public function __get($var){
		return $this->$var;
	}

	public function __set($attr,$var){
		$this->$attr = $var;
	}
	
}