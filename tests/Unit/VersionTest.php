<?php

/**
 * The plugin header's Version is the one source of the release number.
 *
 * @see uamswp-learndash-pages.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

use function Brain\Monkey\Functions\when;

it('reads the version constant from the plugin header', function (): void {
    $header = (string) file_get_contents(__DIR__.'/../../uamswp-learndash-pages.php');
    preg_match('/^Version:\s*(\S+)$/m', $header, $matches);

    expect($matches[1])->toMatch('/^\d+\.\d+\.\d+$/')
        ->and(UAMSWP_LEARNDASH_VERSION)->toBe($matches[1]);
});

it('passes the version constant to the stylesheet enqueue', function (): void {
    when('is_singular')->justReturn(true);
    when('plugin_dir_url')->justReturn('https://example.test/plugin/');

    Functions\expect('wp_enqueue_style')
        ->once()
        ->with('uamswp-learndash', 'https://example.test/plugin//uams-2020-learndash.css', [], UAMSWP_LEARNDASH_VERSION, 'all');

    uamswp_learndash_css();
});
