<?php
/**
 * Compares two numbers.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

namespace Gmi\Toolkit\Sorter\Util;

/**
 * Compares two numbers for number-based sort implementations.
 *
 * This class may be removed in favor of the spaceship operator after PHP5 support is dropped.
 */
class NumberComparator
{
    /**
     * Compares two numbers.
     *
     * @param float $a
     * @param float $b
     *
     * @return int
     */
    public static function compare($a, $b)
    {
        // loose comparison, as integer and float with the same value should be treated as equal
        if ($a == $b) {
            return 0;
        }

        return ($a > $b) ? 1 : -1;
    }
}
