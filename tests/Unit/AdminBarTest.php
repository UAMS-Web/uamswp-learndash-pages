<?php

/**
 * uamswp_hide_admin_bar(), with WordPress mocked.
 *
 * @see uamswp-learndash-pages.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

use function Brain\Monkey\Functions\when;

it('hides the admin bar for a user who cannot edit posts', function (): void {
    when('current_user_can')->alias(fn (string $capability): bool => $capability !== 'edit_posts');

    Functions\expect('show_admin_bar')->once()->with(false);

    uamswp_hide_admin_bar();
});

it('leaves the admin bar alone for a user who can edit posts', function (): void {
    when('current_user_can')->alias(fn (string $capability): bool => $capability === 'edit_posts');

    Functions\expect('show_admin_bar')->never();

    uamswp_hide_admin_bar();
});
