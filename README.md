PHP Toolkit - Sorter
====================

This library provides simple abstractions for sort operations.

In version 1.0, toolkit-sorter provides easy sorting of files by various criteria.
Files are passed as `SplFileInfo` objects, e.g. as retrieved from Symfony the Finder component.

Additonal sort algorithms for reuse will be added in later releases.

The current build status and code analysis can be found here:
  * [Travis CI](https://travis-ci.org/gmitirol/toolkit-sorter)
  * [Scrutinizer CI](https://scrutinizer-ci.com/g/gmitirol/toolkit-sorter/)

Requirements
------------
* PHP 5.6.0 or higher

Installation
------------
The recommended way to install toolkit-sorter is via composer.
```json
"require": {
    "gmi/toolkit-sorter": "1.0.*"
}
```

Usage examples
--------------

Sorting of SplFileInfo objects
```php
use Gmi\Toolkit\Sorter\NaturalFileSorter;

$files = ['file1.pdf', 'file2.pdf'];
$fileInfos = [];
foreach ($files as $file) {
    $fileInfos[] = new SplFileInfo($file);
}

$sorter = new NaturalFileSorter();
$sorter->sort($fileInfos);
```

Sorting of SplFileInfo objects by multiple criteria
```php
use Gmi\Toolkit\Sorter\GroupSorter;
use Gmi\Toolkit\Sorter\ExtensionFileSorter;
use Gmi\Toolkit\Sorter\SizeFileSorter;

$files = ['file1.pdf', 'file2.pdf', 'file3.pdf', 'file1.jpg', 'file4.pdf', 'file2.jpg'];
$fileInfos = [];
foreach ($files as $file) {
    $fileInfos[] = new SplFileInfo($file);
}

$sorter = new GroupSorter([new ExtensionFileSorter(), new SizeFileSorter()]);
$sorter->sort($fileInfos);
```

Sorting Symfony Finder results
```php
use Symfony\Component\Finder\Finder;
use Gmi\Toolkit\Sorter\SizeFileSorter;

$finder = new Finder();
$finder->files()->name('/\.jpg$/i')->in($folder);
$files = iterator_to_array($finder);

$sorter = new SizeFileSorter();
$sorter->sort($files);
```

Direct sorting with Symfony Finder
```php
use Symfony\Component\Finder\Finder;
use Gmi\Toolkit\Sorter\ModificationDateFileSorter;

$finder = new Finder();
$finder->files()->name('/\.jpg$/i')->in($folder);

$sorter = new ModificationDateFileSorter();
$finder->sort($sorter->getClosure());
```

Tests
-----
The test suite can be run with `vendor/bin/phpunit tests`.
