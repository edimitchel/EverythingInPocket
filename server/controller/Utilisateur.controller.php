<?php 
/**
* 
*/
interface UtilisateurController
{
	public static function connexion($user, $motdepasse);

	public static function creer($user);

	public static function creerGroupe($nom, $listeUser);

	public static function ajouter($userId, $groupId);
}
?>