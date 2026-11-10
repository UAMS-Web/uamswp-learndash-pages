<?php

/**
 * uamswp_learndash_css(), with WordPress mocked.
 *
 * @see uamswp-learndash-pages.php
 */

declare(strict_types=1);

use function Brain\Monkey\Functions\expect;
use function Brain\Monkey\Functions\when;

it('enqueues the stylesheet on a course or lesson', function (string $postType): void {
    when('is_singular')->alias(fn (string $type): bool => $type === $postType);
    when('plugin_dir_url')->justReturn('https://example.test/plugin/');

    expect('wp_enqueue_style')
        ->once()
        ->with('uamswp-learndash', 'https://example.test/plugin//uams-2020-learndash.css', [], UAMSWP_LEARNDASH_VERSION, 'all');

    uamswp_learndash_css();
})->with([
    'course' => ['sfwd-courses'],
    'lesson' => ['sfwd-lessons'],
]);

it('does not enqueue the stylesheet on a quiz or any other page', function (string $postType): void {
    when('is_singular')->alias(fn (string $type): bool => $type === $postType);
    when('plugin_dir_url')->justReturn('https://example.test/plugin/');

    expect('wp_enqueue_style')->never();

    uamswp_learndash_css();
})->with([
    'quiz' => ['sfwd-quiz'],
    'other' => ['page'],
]);
