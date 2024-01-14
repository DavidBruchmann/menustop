<?php

defined ('TYPO3_MODE') || die ('Access denied.');

$tempColumns = [
	'tx_menustop_first_invisible' => [
		'exclude' => 1,		
		'label' => 'LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_first_invisible',		
		'config' => [
			'type' => 'check',
			'cols' => 3,
			'items' => [
				['LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_first_invisible.I.0', ''],
				['LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_first_invisible.I.1', ''],
				['LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_first_invisible.I.2', ''],
			],
		],
	],
	'tx_menustop_last_visible' => [
		'exclude' => 1,		
		'label' => 'LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_last_visible',		
		'config' => [
			'type' => 'check',
			'cols' => 3,
			'items' => [
				['LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_last_visible.I.0', ''],
				['LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_last_visible.I.1', ''],
				['LLL:EXT:menustop/Resources/Private/Language/locallang_db.xlf:pages.tx_menustop_last_visible.I.2', ''],
			],
		],
	],
];

// \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('pages');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_menustop_first_invisible;;;;1-1-1,tx_menustop_last_visible'); // , '', 'after:rowDescription'
