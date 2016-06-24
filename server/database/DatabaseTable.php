<?php
if(!defined("API_SERVER")) exit;

/**
* Classe de définition d'une table dans la base de données
*/
class DataBaseTable
{
	protected $table_name = null;

	protected $id_column = "id";

	public final static function nowDateTime(){
		return date("Y-m-d h:i:s");
	}

	public final static function nowDate(){
		return date("Y-m-d");
	}

	public function insert($values){
		$query = DataBase::getInstance()->prepare("INSERT INTO ".$this->table_name."(".$this->getTableColumns($values).") values(".$this->getBindValues($values).")");
		$this->bindValue($query, $values);
		try {
			$r = $query->execute();
		} catch(PDOException $e){
			throw new ControllerException($e->getMessage());
		}

		if(is_array($this->id_column) && $r) // Si c'est une table à plusieurs clé primaire
			return true;
		else
			return $r ? DataBase::getInstance()->lastInsertId() : false;
	}

	public function getById($id){
		$query = DataBase::getInstance()->prepare("SELECT * from ".$this->table_name." WHERE ".$this->getPrimaryCondition());
		$this->bindValue($query, $id, "id");
		try{
			$query->execute();
		} catch(PDOException $e){
			throw new ControllerException($e->getMessage());
		}
		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function update($id, $array){
		$query = DataBase::getInstance()->prepare("UPDATE ".$this->table_name." SET ".$this->getUpdateSet($array)." WHERE ".$this->getPrimaryCondition());
		$this->bindValue($query, $array);
		$this->bindValue($query, $id, "id");
		$query->execute();
		return $query;
	}

	public function delete($id){
		$query = DataBase::getInstance()->prepare("DELETE FROM ".$this->table_name." WHERE ".$this->getPrimaryCondition());
		$this->bindValue($query, $id, "id");
		$query->execute();
		return $query;
	}

	private final function getPrimaryCondition(){
		if(is_array($this->id_column)){
			$r = "";
			foreach($this->id_column AS $n => $v){
				if($n > 0)
					$r .= "AND ";
				$r .= $v . " = :" . $v;
				if($n < sizeof($this->id_column)-1)
					$r .= " ";
			}
		} else {
			$r = $this->id_column . " = :" . $this->id_column;
		}
		return $r;
	}

	private final function getUpdateSet($values){
		$r = "";
		foreach(array_keys($values) AS $n => $v){
			if($values[$v] !== null) {
				if($n > 0) $r .= ", ";
				$r .= $v . " = :" . $v;
				if($n < sizeof($this->id_column)-1)
					$r .= " ";
				$n++;
			}
		}
		return $r;
	}

	private final function getTableColumns($values){
		$r = ""; $i = 0;
		foreach($values AS $col => $val){
			if($val !== null) {
				$r .= $col;
				$i++;
				if($i < sizeof($values))
					$r .= ", ";
			}
		}
		return $r;
	}

	private final function getBindValues($values){
		$r = ""; $i = 0;
		foreach($values AS $col => $val){
			if($val !== null){
				$r .= ":".$col;
				$i++;
				if($i < sizeof($values))
					$r .= ", ";
			}
		}
		return $r;
	}

	private final function bindValue($q, $value, $bindName = false){
		if(is_array($value)){
			foreach($value AS $col => $val){
				if($val !== null)
					$q->bindValue(":".$col, $val);
			}
		} else if($bindName !== false){
			return $q->bindValue(":".$bindName, $value);
		} else {
			throw new Exception("Il faut passer un nom au binding pour bindé une valeur seule", 1);
		}
	}
}

?>