<?php

namespace Gmi\Toolkit\Sorter\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\CreationDateFileSorter;

use DateTime;
use SplFileInfo;

class CreationDateFileSorterTest extends TestCase
{
    public function testSort()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getCTime')
              ->willReturn((new DateTime('2017-10-16T14:35:16'))->format('U'));

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getCTime')
              ->willReturn((new DateTime('1998-05-01T08:39:59'))->format('U'));

        $file3 = $this->createMock(SplFileInfo::class);
        $file3->expects($this->any())
               ->method('getCTime')
               ->willReturn((new DateTime('2019-01-01T00:00:00'))->format('U'));

        $file4 = $this->createMock(SplFileInfo::class);
        $file4->expects($this->any())
               ->method('getCTime')
               ->willReturn((new DateTime('2018-12-25T16:30:21'))->format('U'));

        $files = [$file1, $file2, $file3, $file4];

        $sorter = new CreationDateFileSorter();
        $this->assertNotNull($sorter->getClosure());
        $result = $sorter->sort($files);

        $expected = [$file2, $file1, $file4, $file3];
        $this->assertSame($expected, $result);
    }
}
