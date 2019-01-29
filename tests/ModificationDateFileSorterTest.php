<?php

namespace Gmi\Toolkit\Sorter\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\ModificationDateFileSorter;

use DateTime;
use SplFileInfo;

class ModificationDateFileSorterTest extends TestCase
{
    public function testSort()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getMTime')
              ->willReturn((new DateTime('2019-01-17T10:20:33'))->format('U'));

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getMTime')
              ->willReturn((new DateTime('2019-01-17T10:21:16'))->format('U'));

        $file3 = $this->createMock(SplFileInfo::class);
        $file3->expects($this->any())
               ->method('getMTime')
               ->willReturn((new DateTime('2018-12-23T22:39:52'))->format('U'));

        $file4 = $this->createMock(SplFileInfo::class);
        $file4->expects($this->any())
               ->method('getMTime')
               ->willReturn((new DateTime('2018-12-31T23:59:59'))->format('U'));

        $files = [$file1, $file2, $file3, $file4];

        $sorter = new ModificationDateFileSorter();
        $this->assertNotNull($sorter->getClosure());
        $result = $sorter->sort($files);

        $expected = [$file3, $file4, $file1, $file2];
        $this->assertSame($expected, $result);
    }
}
