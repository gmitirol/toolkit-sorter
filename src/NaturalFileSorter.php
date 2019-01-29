<?php
/**
 * Sorts files naturally.
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
 * Sort files array (natural sorting of file path, case insensitive).
 */
class NaturalFileSorter extends ClosureFileSorter implements FileSorterInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $naturalSorter = function (SplFileInfo $a, SplFileInfo $b) {
            return strnatcasecmp($a->getRealPath(), $b->getRealPath());
        };

        parent::__construct($naturalSorter);
    }

    /**
     * Sort files using natural order.
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
