<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007 Michael Sollmann (sollmann@dpi-berlin.net)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 *
 * @author	Michael Sollmann <sollmann@dpi-berlin.net>
 *
 *
 */

class ux_tslib_tmenu extends tslib_tmenu {

	function getBannedUids() {
	        $banUidArray = array();
	
	        if (trim($this->conf['excludeUidList']))        {
	                $banUidList = str_replace('current', $GLOBALS['TSFE']->page['uid'], $this->conf['excludeUidList']);
	                $banUidArray = t3lib_div::intExplode(',', $banUidList);
	        }
			
			$select_fields = 'uid';
			$from_table = 'pages';
			
			// "Letzte sichtbare Seite"
			// Endseiten (noch sichtbar)
			// (Checkbox-Values: Main Menu: 1, Sitemap: 2, Clickpath: 4)
			switch ($this->conf['menuStopID']) {
				// Main Menu
				case 1:
				   $where_clause = 'tx_menustop_last_visible IN (1,3,5,7)';
				   break;
				// Sitemap
				case 2:
				   $where_clause = 'tx_menustop_last_visible IN (2,3,6,7)';
				   break;
				// Clickpath
				case 3:
				   $where_clause = 'tx_menustop_last_visible IN (4,5,6,7)';
				   break;
				default:
					$where_clause = '0';
					break;
			}
			$result = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows ($select_fields, $from_table, $where_clause);
			foreach ($result as $row) {
				$endPages[] = $row['uid'];
			}
			// Unterseiten (nicht sichtbar)
			if (sizeof($endPages) > 0) {
				$where_clause = 'pid in ('.implode(',',$endPages).')';		
				$result = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows ($select_fields, $from_table, $where_clause);			
				foreach ($result as $row) {
					$banUidArray[] = $row['uid'];
				}	
			}	
			
			// "Erste unischtbare Seite"
			switch ($this->conf['menuStopID']) {
				// Main Menu
				case 1:
				   $where_clause = 'tx_menustop_first_invisible IN (1,3,5,7)';
				   break;
				// Sitemap
				case 2:
				   $where_clause = 'tx_menustop_first_invisible IN (2,3,6,7)';
				   break;
				// Clickpath
				case 3:
				   $where_clause = 'tx_menustop_first_invisible IN (4,5,6,7)';
				   break;
				default:
					$where_clause = '0';
					break;				   
			}
			$result = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows ($select_fields, $from_table, $where_clause);
			foreach ($result as $row) {
				$banUidArray[] = $row['uid'];
			}						
			
			return $banUidArray;			
	}  // end function getBannedUids ($key)

} // end class extender

?>