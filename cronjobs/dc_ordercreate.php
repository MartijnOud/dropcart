<?php
/**
 * Cronjob that creates orders that don't have an external orderId yet
 */

require_once(__DIR__.'/../includes/php/dc_connect.php');
require_once(__DIR__.'/../_classes/class.database.php');
$objDB = new DB();

require_once (__DIR__.'/../includes/php/dc_config.php');
require_once (__DIR__.'/../includes/php/dc_functions.php');
require_once (__DIR__.'/../includes/php/dc_mail.php');
require_once (__DIR__.'/../_classes/class.cart.php');
require_once (__DIR__.'/../libraries/Api_Inktweb/API.class.php');// Inktweb API

// New Inktweb Api object
$Api = new Inktweb\API(API_KEY, API_TEST, API_DEBUG);

$strSQL = 
	"SELECT co.uuid,
	co.orderId
	FROM ".DB_PREFIX."customers_orders co
	WHERE co.extOrderId = 0 ";
$result = $objDB->sqlExecute($strSQL);
while($objOrder = $objDB->getObject($result)) {

	$strJsonUrl = SITE_URL . '/beheer/dc_order_manage.php?action=export&uuid='.$objOrder->uuid.'&id='.$objOrder->orderId;
	$Order = $Api->importOrder($strJsonUrl);

	/* Do not execute code below if there is no orderId avaiable */
	if( !isset($Order->orderId) )
		continue;

	$intExtOrderId = intval($Order->orderId);
	
	$strSQL = "UPDATE ".DB_PREFIX."customers_orders SET extOrderId = ".$intExtOrderId." WHERE orderId = ".$objOrder->orderId;
	$objDB->sqlExecute($strSQL);

	echo "Order created: ".$objOrder->orderId." (ext: ".$intExtOrderId.") <br />";

}
?>