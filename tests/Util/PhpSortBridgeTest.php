<?php

namespace Gmi\Toolkit\Sorter\Tests\Util;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\Util\PhpSortBridge;

class PhpSortBridgeTest extends TestCase
{
    public function testSortUserDefinedCompare()
    {
        $numbers = [15, 23, 8, 16, 42, 4];
        $closure = function ($a, $b) {
            return $a > $b;
        };

        $sortBridge = new PhpSortBridge();
        $result = $sortBridge->sortUserDefinedCompare($numbers, $closure);

        $this->assertSame([ 4, 8, 15, 16, 23, 42], $result);
    }
}
