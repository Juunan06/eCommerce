<?php
/**
 * 
 */
class Database
{
	
	private static $_bdd;
	private static $_host = 'localhost';
	private static $_name = 'eboutique';
	private static $_login = 'root';
	private static $_pass = '';

	private static function setBdd(){
		try {
            self::$_bdd = new PDO('mysql:host='.self::$_host.';dbname='.self::$_name.';charset=utf8',self::$_login, self::$_pass);
            //self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
        	 die("<div><strong>Database Connexion Error !</strong><br> It seems you have an error with your Database connexion, check your Database.php file.<br />".$e->getMessage()."</div>");
        }
	}

	public static function getBdd(){

		if(empty(self::$_bdd)){
			self::setBdd();
		}

		return self::$_bdd;
	}
}