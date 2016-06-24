<?php 
	header('Content-type: application/json');
	$serverPath = "../server/";
	include $serverPath."Loader.php";

	$action = Controller::getData('action');

	$retour = null;
	switch ($action) {
		case 'ajouter':
			Controller::assurerConnexion();

			$libelle = Controller::getData('libelle');
			$quantite = Controller::getData('qt');
			$listeId = Controller::getData('lstId');

			try{
				$newItem = ItemControllerImpl::ajouter(new Item(null,$libelle,$quantite,null), $listeId);
				$retour = array("ok"=>true, "data" =>$newItem);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		case 'modifier':
			Controller::assurerConnexion();

			$id = Controller::getData('id');
			$libelle = Controller::getData('libelle');
			$quantite = Controller::getData('qt');
			$valider = Controller::getData('valider');

			try{
				$newItem = ItemControllerImpl::modifier(new Item($id,$libelle,$quantite,$valider));
				$retour = array("ok"=>true, "data" =>$newItem);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		case 'valider':
			Controller::assurerConnexion();

			$id = Controller::getData('id');
			$valider = Controller::getData('valid') === "1" ? true : false;

			try{
				$newItem = ItemControllerImpl::valider(new Item($id,null,null,$valider));
				$retour = array("ok"=>true, "data" =>$newItem);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		case 'supprimer':
			Controller::assurerConnexion();

			$id = Controller::getData('id');

			try{
				$supprimer = ItemControllerImpl::supprimer(new Item($id,null,null,null));
				$retour = array("ok"=>true, "data" => false);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		default:
 			$retour = array("ok"=>false, "erreur"=>"L'action est introuvable pour ce service.");
			break;
	}

	if($retour == null)
		$retour = array("ok"=>false, "erreur"=>"Des données doivent être transitées afin d'assurer le suivi de l'action.");

	echo json_encode($retour);
?>