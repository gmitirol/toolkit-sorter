<?php

namespace Gmi\Toolkit\Sorter\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\ClosureFileSorter;

use SplFileInfo;

class ClosureFileSorterTest extends TestCase
{
    public function testSort()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getInode')
              ->willReturn(91534);

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getInode')
              ->willReturn(67881);

        $file3 = $this->createMock(SplFileInfo::class);
        $file3->expects($this->any())
               ->method('getInode')
               ->willReturn(235354);

        $file4 = $this->createMock(SplFileInfo::class);
        $file4->expects($this->any())
               ->method('getInode')
               ->willReturn(135740);

        $files = [$file1, $file2, $file3, $file4];

        $inodeSorter = function (SplFileInfo $a, SplFileInfo $b) {
            return ($a->getInode() > $b->getInode());
        };

        $sorter = new ClosureFileSorter($inodeSorter);
        $this->assertSame($inodeSorter, $sorter->getClosure());
        $result = $sorter->sort($files);

        $expected = [$file2, $file1, $file4, $file3];
        $this->assertSame($expected, $result);
    }
}
