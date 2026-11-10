<?php

/**
 * Unit bootstrap.
 *
 * The Unit suite runs with no WordPress: WordPress functions are mocked per
 * test with Brain Monkey.
 */

declare(strict_types=1);

use function Brain\Monkey\Functions\when;
use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

require_once __DIR__.'/../vendor/autoload.php';

/*
 * Patchwork first: it can only redefine functions declared in files loaded
 * after it.
 */
require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';

/*
 * The plugin file registers its hooks at file scope, and Brain Monkey's
 * add_action() and add_filter() exist only between setUp() and tearDown().
 * Load the file inside that window so its functions are defined for every test
 * and the registration calls hit Brain Monkey instead of failing.
 */
setUp();

/*
 * get_file_data() is WordPress'; stand in for it by reading the plugin header
 * the same way, so the version constant resolves to the real header value.
 */
when('get_file_data')->alias(function (string $file, array $headers): array {
    $source = (string) file_get_contents($file);
    $data = [];

    foreach ($headers as $key => $label) {
        preg_match('/^\s*'.preg_quote($label, '/').':\s*(.*)$/mi', $source, $matches);
        $data[$key] = trim($matches[1] ?? '');
    }

    return $data;
});

require_once __DIR__.'/../uamswp-learndash-pages.php';
tearDown();
