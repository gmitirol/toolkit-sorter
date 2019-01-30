<?php
/**
 * Bridge for PHP sort functions.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

namespace Gmi\Toolkit\Sorter\Util;

use Gmi\Toolkit\Sorter\Exception\SortException;

/**
 * Bridge for PHP sort functions such as usort() for more flexibility and easier testing.
 *
 * In addition, this bridge allows to use better alternatives in the future.
 */
class PhpSortBridge
{
    /**
     * Sorts the array with a custom compare function, assigning new keys to the result array elements.
     *
     * @see http://php.net/usort
     *
     * @param array    $array
     * @param callable $compareFunction
     *
     * @return array
     *
     * @throws SortException
     */
    public function sortUserDefinedCompare(array $array, callable $compareFunction)
    {
        $result = @usort($array, $compareFunction);

        $hasPhpUsortBug = $this->hasPhpUsortBug();

        // @codeCoverageIgnoreStart
        /**
         * According to PHP docs, usort should return false if it fails. Apart from an invalid array passed
         * (handled via type check) and a PHP5 bug (see below) there seems no apparent way to make it fail.
         *
         * @see https://stackoverflow.com/questions/5354891/why-would-sort-fail
         */
        if ($result === false && $hasPhpUsortBug === false) {
            throw new SortException('Failed to sort!');
        }
        // @codeCoverageIgnoreEnd

        return $array;
    }

    /**
     * Returns whether PHP has buggy usort() behavior.
     *
     * A bug in PHP5 causes usort() to tigger "Array was modified by the user comparison function".
     *
     * @todo This workaround should be removed after PHP5 support is dropped.
     * @see https://bugs.php.net/bug.php?id=50688
     */
    private function hasPhpUsortBug()
    {
        $bugErrorMessage = 'usort(): Array was modified by the user comparison function';
        $error = error_get_last();
        return (PHP_VERSION_ID < 70000 && !empty($error) && $error['message'] === $bugErrorMessage);
    }
}
