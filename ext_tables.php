<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$tempColumns = Array (
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
);


t3lib_div::loadTCA("pages");
t3lib_extMgm::addTCAcolumns("pages",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("pages","tx_menustop_last_visible;;;;1-1-1,tx_menustop_first_invisible");

?>