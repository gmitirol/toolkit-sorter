<?php
/**
 * Sorter.
 *
 * @copyright 2019 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package sorter
 */

use Sami\Sami;
use Sami\Parser\Filter\TrueFilter;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('src/')
;

$sami = new Sami($iterator, [
    'build_dir' => __DIR__ . '/build/doc',
    'cache_dir' => __DIR__ . '/build/cache',
]);

$sami['filter'] = new TrueFilter();

return $sami;
