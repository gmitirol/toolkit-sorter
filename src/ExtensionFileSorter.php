<?php
/**
 * Sorts files by extension.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

namespace Gmi\Toolkit\Sorter;

use SplFileInfo;

/**
 * Sort files array (order by extension).
 */
class ExtensionFileSorter extends ClosureFileSorter implements FileSorterInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $extensionSorter = function (SplFileInfo $a, SplFileInfo $b) {
            return strcasecmp($a->getExtension(), $b->getExtension());
        };

        parent::__construct($extensionSorter);
    }

    /**
     * Sort files by the extension.
     *
     * @param SplFileInfo[] $fileInfos
     *
     * @return SplFileInfo[]
     */
    public function sort(array $fileInfos)
    {
        return parent::sort($fileInfos);
    }
}
