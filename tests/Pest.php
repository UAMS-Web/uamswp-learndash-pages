<?php

/**
 * Pest configuration, for the Unit suite.
 */

declare(strict_types=1);

use Brain\Monkey\Actions;
use Brain\Monkey\Functions;

use function Brain\Monkey\Filters\expectAdded;
use function Brain\Monkey\Functions\when;
use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

/*
 * Brain Monkey around every test.
 *
 * setUp() defines WordPress' hook functions and arms Patchwork; tearDown()
 * verifies every expectation the test set and removes every mock, so nothing
 * leaks into the next test.
 *
 * The plugin file is loaded here, by the first test of the process, not by the
 * bootstrap. Its file-scope statements (the version constant and the hook
 * registrations) then run inside a test, where coverage and mutation testing
 * can see them, and the expectations set just before the load fail that test
 * when a registration or the version constant is wrong. Later tests find the
 * file already loaded.
 *
 * The assertion count: Brain Monkey's expectations are Mockery expectations,
 * which PHPUnit does not count. Without adding them, a test whose only check is
 * `Functions\expect(...)->once()` reports as risky, and failOnRisky fails it.
 */
uses()
    ->beforeEach(function (): void {
        setUp();

        // get_file_data() is WordPress'; stand in for it by reading the plugin header the same way.
        when('get_file_data')->alias(function (string $file, array $headers): array {
            $source = (string) file_get_contents($file);
            $data = [];

            foreach ($headers as $key => $label) {
                preg_match('/^\s*'.preg_quote($label, '/').':\s*(.*)$/mi', $source, $matches);
                $data[$key] = trim($matches[1] ?? '');
            }

            return $data;
        });

        $firstLoad = ! function_exists('uamswp_learndash_body_class');

        if ($firstLoad) {
            expectAdded('body_class')->once()->with('uamswp_learndash_body_class');
            Actions\expectAdded('wp_enqueue_scripts')->once()->with('uamswp_learndash_css');
            Actions\expectAdded('set_current_user')->once()->with('uamswp_hide_admin_bar');
        }

        require_once __DIR__.'/../uamswp-learndash-pages.php';

        if ($firstLoad) {
            $this->assertMatchesRegularExpression('/^\d+\.\d+\.\d+$/', UAMSWP_LEARNDASH_VERSION);
        }
    })
    ->afterEach(function (): void {
        $this->addToAssertionCount(Mockery::getContainer()->mockery_getExpectationCount());

        tearDown();
    })
    ->in('Unit');
