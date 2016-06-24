<?php
/**
* Classe d'objet Groupe
*/
class Groupe extends DataBaseTable
{
	public $id;
	public $libelle;

	protected $table_name = "groupe";

	protected $id_column = "id"; 

	function __construct($id, $libelle)
	{
		$this->id = $id;
		$this->libelle = $libelle;
	}
}
?>