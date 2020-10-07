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
     * Finds last visible pages as menu entries
     *
     * @param array $conf
     *
     * @return array of pids
     */
    public function findLastVisible($conf = [])
    {
        // "last visible page" (End-pages that are still visible)
        if (empty($conf['menuStopID'])) {
            $lastVisible = [];
        } else {
            $idList = $this->getIdList($conf['menuStopID']);
            if ($idList) {
                $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
                $connection     = $connectionPool->getConnectionForTable('pages');
                $queryBuilder   = $connectionPool->getQueryBuilderForTable('pages');
                $lastVisible    = $queryBuilder
                    ->select('uid')
                    ->from('pages')
                    ->where(
                        $queryBuilder->expr()->in(
                            'tx_menustop_last_visible',
                            $queryBuilder->createNamedParameter(explode(',', $idList), $connection::PARAM_INT_ARRAY) // implode(',', $idList)
                        )
                    )
                    ->execute()
                    ->fetchAll();
            }
        }
        return $lastVisible;
    }

    public function findHiddenSubpages($endPages)
    {
        $hiddenSubpages = [];
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $connection     = $connectionPool->getConnectionForTable('pages');
        $queryBuilder   = $connectionPool->getQueryBuilderForTable('pages');
        $hiddenSubpages = $queryBuilder
            ->select('uid')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->in(
                    'pid',
                    $queryBuilder->createNamedParameter($endPages, $connection::PARAM_INT_ARRAY)
                )
            )
            ->execute()
            ->fetchAll();

        return $hiddenSubpages;
    }

    public function findFirstInvisible($conf)
    {
        if (empty($conf['menuStopID'])) {
            $firstInvisible = [];
        } else {
            $idList = $this->getIdList($conf['menuStopID']);
            if ($idList) {
                $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
                $connection     = $connectionPool->getConnectionForTable('pages');
                $queryBuilder   = $connectionPool->getQueryBuilderForTable('pages');
                $firstInvisible = $queryBuilder
                    ->select('uid')
                    ->from('pages')
                    ->where(
                        $queryBuilder->expr()->in(
                            'tx_menustop_first_invisible',
                            $queryBuilder->createNamedParameter(explode(',', $idList), $connection::PARAM_INT_ARRAY)
                        )
                    )
                    ->execute()
                    ->fetchAll();
            }
        }
        return $firstInvisible;
    }

    public function getIdList($menuStopID)
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
               // $where_clause = '0';
               $idList = '';
               break;
        }
        return $idList;
    }
}
