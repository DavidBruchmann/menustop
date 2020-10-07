<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$tempColumns = Array (
	"tx_menustop_first_invisible" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_first_invisible",		
		"config" => Array (
			"type" => "check",
			"cols" => 3,
			"items" => Array (
				Array("LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_first_invisible.I.0", ""),
				Array("LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_first_invisible.I.1", ""),
				Array("LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_first_invisible.I.2", ""),
			),
		),	
	),
	"tx_menustop_last_visible" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_last_visible",		
		"config" => Array (
			"type" => "check",
			"cols" => 3,
			"items" => Array (
				Array("LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_last_visible.I.0", ""),
				Array("LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_last_visible.I.1", ""),
				Array("LLL:EXT:menustop/locallang_db.xml:pages.tx_menustop_last_visible.I.2", ""),
			),
		),
	),
);


// \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA("pages");
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("pages",$tempColumns,1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("pages","tx_menustop_first_invisible;;;;1-1-1,tx_menustop_last_visible");

?>