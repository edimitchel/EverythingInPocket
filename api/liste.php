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
			$type = Controller::getData('type');
			$groupe = Controller::getData('groupe');
			$user = Controller::getData('user');

			try{
				$newListe = ListeControllerImpl::ajouter(new Liste(null,null,null,$libelle,$type,null,null,$groupe,$user));
				$retour = array("ok"=>true, "data" =>$newListe);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		case 'modifier':
			Controller::assurerConnexion();

			$id = Controller::getData('id');
			$libelle = Controller::getData('libelle');
			$type = Controller::getData('type');

			try{
				$newListe = ListeControllerImpl::modifier(new Liste($id,null,null,$libelle,$type,null,null,null,null));
				$retour = array("ok"=>true, "data" =>$newListe);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		case 'archiver':
			Controller::assurerConnexion();

			$id = Controller::getData('id');
			$archiver = Controller::getData('archiver') === "1" ? true : false;

			try{
				$newListe = ListeControllerImpl::archiver(new Liste($id,null,null,null,null,null,$archiver,null,null));
				$retour = array("ok"=>true, "data" =>$newListe);
			} catch(ControllerException $e) {
				$retour = $e->getArrayErreur();
			}
			break;
		case 'supprimer':
			Controller::assurerConnexion();

			$id = Controller::getData('id');

			try{
				$supprimer = ListeControllerImpl::supprimer(new Liste($id,null,null,null,null,null,null,null,null));
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
		$retour = array("ok"=>false, "erreur"=>"Des données doivent être transitées afin d'assurer le suivi de l'action");

	echo json_encode($retour);
?>