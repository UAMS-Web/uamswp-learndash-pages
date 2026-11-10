<?php

/**
 * Unit bootstrap.
 *
 * The Unit suite runs with no WordPress: WordPress functions are mocked per
 * test with Brain Monkey.
 */

declare(strict_types=1);

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
require_once __DIR__.'/../uamswp-learndash-pages.php';
tearDown();
