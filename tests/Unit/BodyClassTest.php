<?php

/**
 * uamswp_learndash_body_class(), with WordPress mocked.
 *
 * @see uamswp-learndash-pages.php
 */

declare(strict_types=1);

use function Brain\Monkey\Functions\when;

it('adds the default page template class on a LearnDash post type', function (string $postType): void {
    when('is_singular')->alias(fn (string $type): bool => $type === $postType);

    expect(uamswp_learndash_body_class(['single']))->toBe(['single', 'page-template-default']);
})->with([
    'course' => ['sfwd-courses'],
    'lesson' => ['sfwd-lessons'],
    'quiz' => ['sfwd-quiz'],
]);

it('leaves the classes alone on any other page', function (): void {
    when('is_singular')->justReturn(false);

    expect(uamswp_learndash_body_class(['single']))->toBe(['single']);
});
