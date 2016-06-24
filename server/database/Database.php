<?php 
if(!defined("API_SERVER")) exit;

class DataBase
{
	protected static $db_instance = null;	

	public final function getInstance(){
		if(self::$db_instance == null){
			self::$db_instance = new PDO("mysql:dbname=EverythingInPocket;host=localhost","root","root");
		}
		return self::$db_instance;
	}

	private function __construct(){
	}
}

?>