<?php
/**
 * Sorts array items by muliple criteria.
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

/**
 * Sort array (order by by multiple criteria using a group of inner sorters).
 *
 * The inner sorters must support closures (i.e. implement ClosureSorterInterface) for comparison.
 *
 * Note that Warnings or Exceptions within sort closures cause PHP to die immediately,
 * so make sure that all inner sorters properly support the passed array!
 */
class GroupSorter implements SorterInterface, ClosureSorterInterface
{
    /**
     * @var ClosureSorterInterface[]
     */
    private $sorters;

    /**
     * @var PhpSortBridge
     */
    protected $sortBridge;

    /**
     * Constructor.
     *
     * @param ClosureSorterInterface[] $sorters    Sorters to use.
     * @param PhpSortBridge            $sortBridge Bridge for the underlying native sort function.
     */
    public function __construct($sorters, PhpSortBridge $sortBridge = null)
    {
        foreach ($sorters as $sorter) {
            if (!$sorter instanceof ClosureSorterInterface) {
                throw new SortException('The group sorter only works with closure-providing sorters!');
            }
        }

        $this->sorters = $sorters;
        $this->sortBridge = $sortBridge ?: new PhpSortBridge();
    }

    /**
     * Sort array items by multiple criteria using the inner sorters.
     *
     * The array items must be compatible with all used sorters!
     *
     * @param array $array
     *
     * @return array
     */
    public function sort(array $array)
    {
        $closure = $this->getClosure();

        return $this->sortBridge->sortUserDefinedCompare($array, $closure);
    }

    /**
     * {@inheritdoc}
     */
    public function getClosure()
    {
        $groupSorter = function ($a, $b) {
            foreach ($this->sorters as $sorter) {
                $closure = $sorter->getClosure();
                $result = $closure($a, $b);

                if ($result > 0) {
                    return 1;
                } elseif ($result < 0) {
                    return -1;
                }
            }

            return 0;
        };

        return $groupSorter;
    }
}
