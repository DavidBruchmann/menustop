<?php

########################################################################
# Extension Manager/Repository config file for ext "menustop".
#
# Auto generated 08-08-2015 13:22
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF['menustop'] = [
	'title' => 'Menu Stop',
	'description' => 'Allows to end main menu, sitemap and click path at each location. Each page can be the last visible or the first hidden one. To be configured in "page properties". It is an extended alternative to the page property checkbox "hide in menu".',
	'category' => 'fe',
	'shy' => 0,
	'version' => '11.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.3.0-11.99.99',
        ],
        'conflicts' => [
        ],
    ],
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'TYPO3_version' => '',
	'PHP_version' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Michael Sollmannm, David Bruchmann',
	'author_email' => 'sollmann@dpi-berlin.net, david.bruchmann@gmail.com',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
    'autoload' => [
        'psr-4' => [
            ['WDB\\Menustop\\' => 'Classes/']
        ]
    ],
];
