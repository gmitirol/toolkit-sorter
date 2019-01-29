<?php
/**
 * Sorts files by creation date.
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
 * Sort files array (order by creation date).
 */
class CreationDateFileSorter extends ClosureFileSorter implements FileSorterInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $creationDateSorter = function (SplFileInfo $a, SplFileInfo $b) {
            return NumberComparator::compare($a->getCTime(), $b->getCTime());
        };

        parent::__construct($creationDateSorter);
    }

    /**
     * Sort files by the creation date.
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
