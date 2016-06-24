<?php
/**
* Classe d'association entre Item et Liste
*/
class ItemListe extends DataBaseTable
{
	public $id_item;
	public $id_liste;
	public $date;

	protected $table_name = "item_liste";

	protected $id_column = array("id_item","id_liste"); 

	function __construct($id_item, $id_liste, $date = false)
	{
		$this->id_item = $id_item;
		$this->id_liste = $id_liste;
		$this->date = $date;
	}

	public function insert($values){
		$r = parent::insert($values);
		if($r){
			return $this;
		}
	}
}
?>