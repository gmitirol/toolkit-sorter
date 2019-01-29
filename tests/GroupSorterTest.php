<?php

namespace Gmi\Toolkit\Sorter\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Sorter\ClosureSorterInterface;
use Gmi\Toolkit\Sorter\ExtensionFileSorter;
use Gmi\Toolkit\Sorter\GroupSorter;
use Gmi\Toolkit\Sorter\SizeFileSorter;
use Gmi\Toolkit\Sorter\SorterInterface;
use Gmi\Toolkit\Sorter\Exception\SortException;
use Gmi\Toolkit\Sorter\Util\PhpSortBridge;

use SplFileInfo;

class GroupSorterTest extends TestCase
{
    public function testSortInvalidSorter()
    {
        $mockSorter = $this->createMock(SorterInterface::class);

        $this->expectException(SortException::class);
        $this->expectExceptionMessage('The group sorter only works with closure-providing sorters!');
        new GroupSorter([$mockSorter]);
    }

    public function testSortSorterException()
    {
        $array = [1, 2, 3];

        $mockSorter = $this->createMock(ClosureSorterInterface::class);
        $mockSorter->expects($this->once())
                   ->method('getClosure')
                   ->will($this->throwException(new SortException('Exception message')));

        $sorter = new GroupSorter([$mockSorter]);

        $this->expectException(SortException::class);
        $this->expectExceptionMessage('Exception message');
        $sorter->sort($array);
    }

    public function testSortSortBridgeException()
    {
        $array = [1, 2, 3];

        $closure = function ($a, $b) {
        };

        $mockSorter = $this->createMock(ClosureSorterInterface::class);

        $mockSortBridge = $this->createMock(PhpSortBridge::class);
        $mockSortBridge->expects($this->once())
                       ->method('sortUserDefinedCompare')
                       ->with($array, $closure)
                       ->will($this->throwException(new SortException('Failed to sort!')));

        $sorter = new GroupSorter([$mockSorter], $mockSortBridge);

        $this->expectException(SortException::class);
        $this->expectExceptionMessage('Failed to sort!');
        $sorter->sort($array);
    }

    public function testSort()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getSize')
              ->willReturn(42994);
        $file1->expects($this->any())
              ->method('getExtension')
              ->willReturn('pdf');

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getSize')
              ->willReturn(37881);
        $file2->expects($this->any())
              ->method('getExtension')
              ->willReturn('xls');

        $file3 = $this->createMock(SplFileInfo::class);
        $file3->expects($this->any())
               ->method('getSize')
               ->willReturn(23692);
        $file3->expects($this->any())
              ->method('getExtension')
              ->willReturn('pdf');

        $file4 = $this->createMock(SplFileInfo::class);
        $file4->expects($this->any())
               ->method('getSize')
               ->willReturn(32169);
        $file4->expects($this->any())
              ->method('getExtension')
              ->willReturn('doc');

        $file5 = $this->createMock(SplFileInfo::class);
        $file5->expects($this->any())
               ->method('getSize')
               ->willReturn(26335);
        $file5->expects($this->any())
              ->method('getExtension')
              ->willReturn('xls');

        $files = [$file1, $file2, $file3, $file4, $file5];
        $filesOriginal = $files;

        // sort first by extension, then by size
        $sorter = new GroupSorter([new ExtensionFileSorter(), new SizeFileSorter()]);
        $this->assertNotNull($sorter->getClosure());
        $result = $sorter->sort($files);

        $expected = [$file4, $file3, $file1, $file5, $file2];
        $this->assertSame($expected, $result);
        // ensure that the original files array is not modified
        $this->assertSame($filesOriginal, $files);
    }

    public function testCompareClosureSizeEqualValues()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getSize')
              ->willReturn(12345);

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getSize')
              ->willReturn(12345);

        $sorter = new GroupSorter([new SizeFileSorter()]);
        $closure = $sorter->getClosure();
        $this->assertSame(0, $closure($file1, $file2));
    }

    public function testCompareClosureSizeALarger()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getSize')
              ->willReturn(54321);

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getSize')
              ->willReturn(12345);

        $sorter = new GroupSorter([new SizeFileSorter()]);
        $closure = $sorter->getClosure();
        $this->assertSame(1, $closure($file1, $file2));
    }

    public function testCompareClosureSizeBLarger()
    {
        $file1 = $this->createMock(SplFileInfo::class);
        $file1->expects($this->any())
              ->method('getSize')
              ->willReturn(12345);

        $file2 = $this->createMock(SplFileInfo::class);
        $file2->expects($this->any())
              ->method('getSize')
              ->willReturn(54321);

        $sorter = new GroupSorter([new SizeFileSorter()]);
        $closure = $sorter->getClosure();
        $this->assertSame(-1, $closure($file1, $file2));
    }
}
