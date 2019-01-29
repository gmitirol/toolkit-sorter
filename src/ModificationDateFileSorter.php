<?php
/**
 * Sorts files by modification date.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

namespace Gmi\Toolkit\Sorter;

use Gmi\Toolkit\Sorter\Util\NumberComparator;

use SplFileInfo;

/**
 * Sort files array (order by modification date).
 */
class ModificationDateFileSorter extends ClosureFileSorter implements FileSorterInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $modificationDateSorter = function (SplFileInfo $a, SplFileInfo $b) {
            return NumberComparator::compare($a->getMTime(), $b->getMTime());
        };

        parent::__construct($modificationDateSorter);
    }

    /**
     * Sort files by the modification date.
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
