<?php

namespace Gmi\Toolkit\Sorter\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\ExtensionFileSorter;

use SplFileInfo;

class ExtensionFileSorterTest extends TestCase
{
    public function testSort()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getExtension')
              ->willReturn('xls');

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getExtension')
              ->willReturn('doc');

        $file3 = $this->createMock(SplFileInfo::class);
        $file3->expects($this->any())
               ->method('getExtension')
              ->willReturn('xlsx');

        $file4 = $this->createMock(SplFileInfo::class);
        $file4->expects($this->any())
               ->method('getExtension')
              ->willReturn('pdf');

        $files = [$file1, $file2, $file3, $file4];

        $sorter = new ExtensionFileSorter();
        $this->assertNotNull($sorter->getClosure());
        $result = $sorter->sort($files);

        $expected = [$file2, $file4, $file1, $file3];
        $this->assertSame($expected, $result);
    }
}
