<?php
/**
 * Sorts files using a closure.
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
use Gmi\Toolkit\Sorter\Util\PhpSortBridge;

use Closure;
use SplFileInfo;

/**
 * Sort files using a closure for the actual sorting.
 */
class ClosureFileSorter implements FileSorterInterface, ClosureSorterInterface
{
    /**
     * @var Closure
     */
    protected $closure;

    /**
     * @var PhpSortBridge
     */
    protected $sortBridge;

    /**
     * Constructor.
     *
     * @param Closure       $closure    Anonymous function which can be used by uasort().
     * @param PhpSortBridge $sortBridge Bridge for the underlying native sort function.
     */
    public function __construct(Closure $closure, PhpSortBridge $sortBridge = null)
    {
        $this->closure = $closure;
        $this->sortBridge = $sortBridge ?: new PhpSortBridge();
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
        return $this->sortBridge->sortUserDefinedCompare($fileInfos, $this->closure);
    }

    /**
     * {@inheritdoc}
     */
    public function getClosure()
    {
        return $this->closure;
    }
}
