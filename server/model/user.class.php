<?php
/**
* Classe d'objet Item
*/
class User extends DataBaseTable
{
	public $id;
	public $pseudo;
	public $motdepasse;
	public $dateConnexion;

	protected $table_name = "user";

	protected $id_column = "id"; 

	function __construct($id,$pseudo,$motdepasse,$dateConnexion)
	{
		$this->id = $id;
		$this->pseudo = $pseudo;
		$this->motdepasse = $motdepasse;
		$this->dateConnexion = $dateConnexion;
	}
}
?>