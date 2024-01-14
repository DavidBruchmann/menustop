<?php

namespace WDB\Menustop\Controller;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\Menu\TextMenuContentObject;
use WDB\Menustop\Domain\Repository\MenustopRepository;

/**
 * Menu Stop Controller
 */
class MenustopController extends TextMenuContentObject
{

    /**
     * @var \WDB\Menustop\Domain\Repository\MenustopRepository
     */
    protected $menustopRepository;

    /**
     * Collects banned page-Uids in an array
     *
     */
	public function getBannedUids()
    {
        if (!$this->menustopRepository) {
            $this->menustopRepository = GeneralUtility::makeInstance(MenustopRepository::class);
        }

        $banUidArray = parent::getBannedUids();
        $endPages = [];

        if (trim($this->conf['excludeUidList']))        {
            $banUidList = str_replace('current', $GLOBALS['TSFE']->page['uid'], $this->conf['excludeUidList']);
            $banUidArray = array_merge($banUidArray, GeneralUtility::intExplode(',', $banUidList));
        }

        $lastVisibles = $this->menustopRepository->findLastVisible($this->conf);
        foreach ($lastVisibles as $lastVisible) {
            $endPages[] = $lastVisible['uid'];
        }

        // Subpages (not visible)
        if (sizeof($endPages) > 0) {
            $hiddenSubpages = $this->menustopRepository->findHiddenSubpages($endPages);
            if (!empty($hiddenSubpages)) {
                foreach ($hiddenSubpages as $hiddenSubpage) {
                    $banUidArray[] = $hiddenSubpage['uid'];
                }
            }
        }

        // First invisible page
        $firstInvisibles = $this->menustopRepository->findFirstInvisible($this->conf);
        foreach ($firstInvisibles as $firstInvisible) {
            $banUidArray[] = $firstInvisible['uid'];
        }

        return $banUidArray;
	}
}
