<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

/**
 * Example of how to configure a class for extension of another class:
 */

$TYPO3_CONF_VARS["FE"]["XCLASS"]["tslib/class.tslib_menu.php"]=t3lib_extMgm::extPath($_EXTKEY)."class.ux_tslib_tmenu.php";


?>