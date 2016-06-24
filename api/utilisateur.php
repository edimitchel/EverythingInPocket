<?php 
	header('Content-type: application/json');
	$serverPath = "../server/";
	include $serverPath."Loader.php";

	$action = Controller::getData('action');

	$retour = null;

	switch ($action) {
		case 'ajouter':
			# code...
			break;
		
		default:
 			$retour = array("erreur"=>"L'action est introuvable pour ce service.");

			break;
	}

	if($retour == null)
		$retour = array("ok"=>false, "erreur"=>"Des données doivent être transitées afin d'assurer le suivi de l'action");

	echo json_encode($retour);
?>