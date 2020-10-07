<?php

defined ("TYPO3_MODE") || die ("Access denied.");

/**
 * XClass:
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Frontend\ContentObject\Menu\TextMenuContentObject::class] = [
   'className' => WDB\Menustop\Controller\MenustopController::class
];


/** 
 * HOOK DOESN'T WORK: no access to configuration because it's protected.
 * See https://forge.typo3.org/issues/92508
 */
// $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/tslib/class.tslib_menu.php']['filterMenuPages'][] = \WDB\Menustop\Controller\MenustopController::class;

?>