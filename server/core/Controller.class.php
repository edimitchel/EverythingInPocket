<?php 
if(!defined("API_SERVER")) exit;

/**
* Classe de définition du controlleur	
*/

class Controller
{
	public static function assurerConnexion(){
		// TODO Vérifier la connexion
		return true;
	}

	public static function getData($paramName){
		if(isset($_GET[$paramName]))
			return $_GET[$paramName];
		else return false;
	}

	public static function postData($paramName){
		if(isset($_POST[$paramName]))
			return $_POST[$paramName];
		else return false;
	}

	public static function mustHave($objet, $arrayChamp){
		$str = "";
		foreach ($arrayChamp as $k => $champ) {
			if($objet->{$champ} === false && empty($objet->{$champ})){
				if(!empty($str)) $str .= ', ';
				$str .= strtoupper($champ);
			}
		}

		if(empty($str))
			return true;
		else return $str;
	}
} 


class ControllerException extends Exception 
{ 
	const CHAMPS_MANQUANT = "Champ(s) manquant(s).";

	const ERREUR_BDD = "Erreur lors de l'interaction avec la base de données.";

	protected $message;

	public function __construct($erreurMessage){
		$this->message = $erreurMessage;
	}

	public function getErreur(){
		return $this->message;
	}

	public function getArrayErreur(){
		return array("ok"=>false, "erreur"=>$this->message);
	}
}

?>