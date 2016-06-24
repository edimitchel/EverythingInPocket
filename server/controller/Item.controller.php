<?php 
/**
* 
*/
interface ItemController
{
	public static function ajouter($item, $listeId);

	public static function modifier($item);

	public static function valider($item);

	public static function supprimer($item);
}
?>