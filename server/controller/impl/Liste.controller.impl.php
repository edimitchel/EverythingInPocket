<?php 
/**
* 
*/
class ListeControllerImpl extends Controller implements ListeController
{
	public static function creer($liste)
	{
		$mh = Controller::mustHave($liste, array('libelle','type','user','groupe'));
		if($mh === true){
			$retour = $liste->insert(array(
				"libelle" => $liste->libelle,
				"type" => $liste->type->id,
				"id_user" => $liste->user->id,
				"id_groupe" => $liste->groupe->id,
				"date" => DatabaseTable::nowDateTime()
			));
			if($retour){
				return $retour;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);
			}
		} 
		else throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}

	public static function modifier($liste)
	{
		$mh = Controller::mustHave($liste, array('id','libelle','type'));
		if($mh === true){
			$retour = $liste->update($libelle->id, array(
				"libelle" => $liste->libelle,
				"type" => $liste->type->id
			));
			if($retour){
				return $retour;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);
			}
		} 
		else throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}

	public static function archiver($liste)
	{
		$mh = Controller::mustHave($liste, array('id','archiver'));
		if($mh === true){
			$retour = $liste->update($libelle->id, array(
				"archiver" => $liste->archiver
			));
			if($retour){
				return $retour;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);
			}
		} 
		else throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}

	public static function supprimer($liste)
	{
		$mh = Controller::mustHave($liste, array('id'));
		if($mh === true){
			$retour = $liste->delete($libelle->id);
			if($retour){
				return true;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD); 
			}
		} 
		else throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}
}
?>