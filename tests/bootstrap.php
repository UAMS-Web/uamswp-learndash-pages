<?php

/**
 * Unit bootstrap.
 *
 * The Unit suite runs with no WordPress: WordPress functions are mocked per
 * test with Brain Monkey. The plugin file is loaded by the first test (see
 * tests/Pest.php).
 */

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

/*
 * Patchwork first: it can only redefine functions declared in files loaded
 * after it.
 */
require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';
