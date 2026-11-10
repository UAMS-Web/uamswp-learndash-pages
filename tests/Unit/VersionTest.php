<?php

/**
 * The plugin header's Version is the one source of the release number.
 *
 * @see uamswp-learndash-pages.php
 */

declare(strict_types=1);

it('reads the version constant from the plugin header', function (): void {
    $header = (string) file_get_contents(__DIR__.'/../../uamswp-learndash-pages.php');
    preg_match('/^Version:\s*(\S+)$/m', $header, $matches);

    expect($matches[1])->toMatch('/^\d+\.\d+\.\d+$/')
        ->and(UAMSWP_LEARNDASH_VERSION)->toBe($matches[1]);
});
