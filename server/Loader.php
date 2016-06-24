<?php
if(!isset($serverPath))
	$serverPath = "./";

define("API_SERVER","");

/**
 * REQUIRED
**/
	
require_once $serverPath."core/Controller.class.php";
require_once $serverPath."database/Database.php";
require_once $serverPath."database/DatabaseTable.php";

/**
 * MODELS
**/

require_once $serverPath."model/item.class.php";
require_once $serverPath."model/groupe.class.php";
require_once $serverPath."model/itemliste.class.php";
require_once $serverPath."model/liste.class.php";
require_once $serverPath."model/typeitem.class.php";
require_once $serverPath."model/user.class.php";
require_once $serverPath."model/usergroupe.class.php";


/**
 * CONTROLLER
**/

require_once $serverPath."controller/Item.controller.php";
require_once $serverPath."controller/Utilisateur.controller.php";
require_once $serverPath."controller/Liste.controller.php";

/* Implémentation */

require_once $serverPath."controller/impl/Item.controller.impl.php";
require_once $serverPath."controller/impl/Utilisateur.controller.impl.php";
require_once $serverPath."controller/impl/Liste.controller.impl.php";


?>