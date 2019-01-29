<?php

namespace Gmi\Toolkit\Sorter\Tests\Util;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\Util\NumberComparator;

class NumberComparatorTest extends TestCase
{
    /**
     * @dataProvider examplesProvider
     */
    public function testCompare($a, $b, $expected)
    {
        $this->assertSame($expected, NumberComparator::compare($a, $b));
    }

    public function examplesProvider()
    {
        return [
            [1, 2, -1],
            [1, 1, 0],
            [2, 1, 1],
            [1.0, 1, 0],
            [1.1, 1.0, 1],
            [3.141, 4.2, -1],
            [100, 1e2, 0],
        ];
    }
}
