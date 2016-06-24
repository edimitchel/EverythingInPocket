<?php
/**
* Classe d'objet Liste
*/
class Liste extends DataBaseTable
{
	public $id;
	public $date;
	public $dateDernierChangement;
	public $libelle;
	public $type;
	public $valider;
	public $archiver;
	public $groupe;
	public $user;

	protected $table_name = "liste";

	protected $id_column = "id"; 

	function __construct($id, $date, $dateDernierChangement, $libelle, $type, $valider, $archiver, $groupe, $user)
	{
		$this->id = $id;
		$this->date = $date;
		$this->dateDernierChangement = $dateDernierChangement;
		$this->libelle = $libelle;
		$this->type = $type;
		$this->valider = $valider;
		$this->archiver = $archiver;
		$this->groupe = $groupe;
		$this->user = $user;
	}

	public function insert($values){
		$r = parent::insert($values);
		if($r !== false){
			$liste = $this->getById($r);
			return $liste;
		}
	}

	public function getById($id){
		$listeBDD = parent::getById($id);
		$liste = new Liste($listeBDD->{$this->id_column}, $listeBDD->date, $listeBDD->dateDernierChangement, $listeBDD->libelle, new Type($listeBDD->id_type,null), $listeBDD->valider, $listeBDD->archiver, new Groupe($listeBDD->id_groupe, null), new User($listeBDD->id_user, null, null, null));
		return $liste;
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