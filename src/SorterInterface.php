<?php
/**
 * Interface for generic sorters.
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

/**
 * Interface for generic sorters.
 */
interface SorterInterface
{
    /**
     * Sort array elements.
     *
     * @param array $array Unsorted array elements
     *
     * @return array       Sorted array elements with newly assigned array keys
     *
     * @throws SortException
     */
    public function sort(array $array);
}
