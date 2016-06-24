<?php
/**
* Classe d'objet d'un Type d'un item
*/
class TypeItem extends DataBaseTable
{
	public $id;
	public $libelle;

	protected $table_name = "type_item";

	protected $id_column = "id"; 

	function __construct($id, $libelle)
	{
		$this->id = $id;
		$this->libelle = $libelle;
	}
}
?>