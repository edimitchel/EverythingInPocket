<?php
/**
* Classe d'association d'un User à un Groupe
*/
class UserGroupe extends DataBaseTable
{
	public $id_user;
	public $id_groupe;

	protected $table_name = "user_groupe";

	protected $id_column = array("id_user","id_groupe"); 

	function __construct($id_user, $id_groupe)
	{
		$this->id_user = $id_user;
		$this->id_groupe = $id_groupe;
	}
}
?>