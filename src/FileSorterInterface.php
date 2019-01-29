<?php
/**
 * Interface for file sorters.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

namespace Gmi\Toolkit\Sorter;

use Gmi\Toolkit\Sorter\Exception\SortException;

use SplFileInfo;

/**
 * Interface for file sorters.
 */
interface FileSorterInterface extends SorterInterface
{
    /**
     * Sort files.
     *
     * @param SplFileInfo[] $fileInfos
     *
     * @return SplFileInfo[]
     *
     * @throws SortException
     */
    public function sort(array $fileInfos);
}
