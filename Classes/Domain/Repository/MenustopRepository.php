<?php

namespace WDB\Menustop\Domain\Repository;

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Michael Sollmann (sollmann@dpi-berlin.net)
*  (c) 2020 David Bruchmann (david.bruchmann@gmail.com)
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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Menu Stop Repository
 */
class MenustopRepository
{

    /**
     * Finds last visible pages as menu entries (End-pages that are still visible)
     *
     * @param array $conf
     *
     * @return array of pids
     */
    public function findLastVisible(array $conf = []) : array
    {
        $lastVisible = [];
        if (!empty($conf['menuStopID'])) {
            $idArray = $this->getIdArray($conf['menuStopID']);
            $lastVisible = $this->findPageUidsByFieldValues('tx_menustop_last_visible', $idArray);
        }
        return $lastVisible;
    }

    /**
     * Find hidden pages of pages with submitted uids
     *
     * @param array $pageUids
     *
     * @return array of pids
     */
    public function findHiddenSubpages(array $pageUids) : array
    {
        $hiddenSubpages = [];
        if (!empty($pageUids)) {
            $hiddenSubpages = $this->findPageUidsByFieldValues('pid', $pageUids);
        }
        return $hiddenSubpages;
    }

    /**
     * Find the first invisible pages
     *
     * @param array $conf
     *
     * @return array of pids
     */
    public function findFirstInvisible(array $conf = []) : array
    {
        $firstInvisible = [];
        if (!empty($conf['menuStopID'])) {
            $idArray = $this->getIdArray($conf['menuStopID']);
            $firstInvisible = $this->findPageUidsByFieldValues('tx_menustop_first_invisible', $idArray);
        }
        return $firstInvisible;
    }

    /**
     * Query the 'pages' table for values of '$idArray' in field '$byField'
     * and return the uids of the found records.
     *
     * @param string $byField    field where to search for the values
     * @param array  $idArray    values to search for
     *
     * @return array of pids
     */
    protected function findPageUidsByFieldValues($byField, $idArray) : array
    {
        if (!empty($idArray)) {
            $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
            $connection     = $connectionPool->getConnectionForTable('pages');
            $queryBuilder   = $connectionPool->getQueryBuilderForTable('pages');
            $pageUids = $queryBuilder
                ->select('uid')
                ->from('pages')
                ->where(
                    $queryBuilder->expr()->in(
                        $byField,
                        $queryBuilder->createNamedParameter($idArray, $connection::PARAM_INT_ARRAY)
                    )
                )
                ->execute()
                ->fetchAll();
            return $pageUids;
        }
        return [];
    }

    /**
     * Get possible field-values related to checkbox-selection
     * and based on $menuStopID
     *
     * @param int  $menuStopID    value to search for
     *
     * @return array of pids
     */
    public function getIdArray(int $menuStopID) : array
    {
        // Checkbox-Values:
        //   - Main Menu: 1
        //   - Sitemap: 2
        //   - Clickpath: 4
        switch ($menuStopID) {
            // Main Menu
            case 1:
               $idList = '1,3,5,7';
               break;
            // Sitemap
            case 2:
               $idList = '2,3,6,7';
               break;
            // Clickpath
            case 3:
               $idList = '4,5,6,7';
               break;
            default:
               // value of $idList for case 'default' was '0', but that's probably
               // wrong, nevertheless this case shouldn't be triggered here anyway.
               $idList = '';
               break;
        }
        return explode(',', $idList);
    }
}
