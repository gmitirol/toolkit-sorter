<?php
/**
 * Interface for closure-based sorters.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

namespace Gmi\Toolkit\Sorter;

use Closure;

/**
 * Interface for sorters storing a closure for further use.
 */
interface ClosureSorterInterface
{
    /**
     * Returns the closure.
     *
     * The closure can be used e.g. as a custom sorter for the Symfony Finder.
     *
     * @return Closure
     */
    public function getClosure();
}
