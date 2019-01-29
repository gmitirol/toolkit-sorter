<?php

namespace Gmi\Toolkit\Sorter\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\SizeFileSorter;

use SplFileInfo;

class SizeFileSorterTest extends TestCase
{
    public function testSort()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getSize')
              ->willReturn(42);

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getSize')
              ->willReturn(67881);

        $file3 = $this->createMock(SplFileInfo::class);
        $file3->expects($this->any())
               ->method('getSize')
               ->willReturn(2354);

        $file4 = $this->createMock(SplFileInfo::class);
        $file4->expects($this->any())
               ->method('getSize')
               ->willReturn(32568);

        $files = [$file1, $file2, $file3, $file4];

        $sorter = new SizeFileSorter();
        $this->assertNotNull($sorter->getClosure());
        $result = $sorter->sort($files);

        $expected = [$file1, $file3, $file4, $file2];
        $this->assertSame($expected, $result);
    }
}
