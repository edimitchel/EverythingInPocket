<?php 
/**
* 
*/
class ItemControllerImpl extends Controller implements ItemController
{
	public static function ajouter($item, $listeId)
	{
		if(Controller::mustHave($item,array('libelle')) && $listeId !== false)	{
			$result = $item->insert(array("libelle" => $item->libelle, "quantite" => $item->quantite));
			if($result){
				$itemliste = new ItemListe($result->id,$listeId);
				$resultIL = $itemliste->insert(array(
					"id_item"	=>$itemliste->id_item, 
					"id_liste"	=>$itemliste->id_liste,
					"date" 		=>DatabaseTable::nowDateTime()));
				if($resultIL){
					return $result;
				} else {
					throw new ControllerException(ControllerException::ERREUR_BDD);		
				}
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);		
			}
		}
		else 
			throw new ControllerException(ControllerException::CHAMPS_MANQUANT. " : LIBELLE OU LISTEID");
	}

	public static function modifier($item)
	{
		$mh = Controller::mustHave($item,array('id','libelle','quantite','valider'));
		if($mh === true){
			$result = $item->update($item->id, array(
				"libelle" => $item->libelle, 
				"quantite" => $item->quantite, 
				"valider" => $item->valider)
			);
			if($result){
				return $result;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);		
			}
		}
		else 
			throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}

	public static function valider($item)
	{
		$mh = Controller::mustHave($item,array('id','valider'));
		if($mh === true){
			$result = $item->update($item->id, array(
				"valider" => $item->valider)
			);
			if($result){
				return $result;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);		
			}
		}
		else 
			throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}

	public static function supprimer($item)
	{
		$mh = Controller::mustHave($item,array('id'));
		if($mh === true){
			$result = $item->remove($item->id);
			if($result == true){
				return true;
			} else {
				throw new ControllerException(ControllerException::ERREUR_BDD);		
			}
		}
		else 
			throw new ControllerException(ControllerException::CHAMPS_MANQUANT . " : " . $mh);
	}
}
?>