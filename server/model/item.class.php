<?php
/**
* Classe d'objet Item
*/
class Item extends DataBaseTable
{
	public $id;
	public $libelle;
	public $quantite;
	public $valider;

	protected $table_name = "item";

	protected $id_column = "id"; 

	public function __construct($id, $libelle, $quantite, $valider)
	{
		$this->id = $id;
		$this->libelle = $libelle;
		$this->quantite = $quantite;
		$this->valider = $valider;
	}

	public function insert($values){
		$r = parent::insert($values);
		if($r !== false){
			$item = $this->getById($r);
			return $item;
		}
	}

	public function getById($id){
		$itemBDD = parent::getById($id);
		$item = new Item($itemBDD->{$this->id_column}, $itemBDD->libelle, $itemBDD->quantite, $itemBDD->valider);
		return $item;
	}

	public function update($id, $array){
		$r = parent::update($id, $array);
		if($r !== false){
			return $this->getById($id);
		}
		return false;
	}

	public function delete($id){
		return parent::delete($id);
	}
}
?>