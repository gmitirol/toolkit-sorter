<?php
/**
 * Sorts files by size.
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
 * Sort files array (order by aize).
 */
class SizeFileSorter extends ClosureFileSorter implements FileSorterInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $sizeSorter = function (SplFileInfo $a, SplFileInfo $b) {
            return NumberComparator::compare($a->getSize(), $b->getSize());
        };

        parent::__construct($sizeSorter);
    }

    /**
     * Sort files by the size.
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
