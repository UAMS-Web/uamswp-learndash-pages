# Troubleshooting

Written against v1.0.2.

- [A course or lesson page is not styled like other pages](#a-course-or-lesson-page-is-not-styled-like-other-pages)
- [A video on a quiz page is not responsive](#a-video-on-a-quiz-page-is-not-responsive)
- [A user cannot see the admin bar](#a-user-cannot-see-the-admin-bar)
- [The stylesheet change does not show after an update](#the-stylesheet-change-does-not-show-after-an-update)

## A course or lesson page is not styled like other pages

**Cause:** the `<body>` element does not carry `page-template-default`. The plugin adds it only on a single course, lesson or quiz page, so an archive or listing page (for example the course list) does not get it.

**Check:** view the page source and look for `page-template-default` in the `<body>` tag's `class` attribute.

**Fix:** confirm the plugin is active and that the page is a single `sfwd-courses`, `sfwd-lessons` or `sfwd-quiz` post. Styling for listing pages is outside what the plugin does. See [Body class](What-the-plugin-changes.md#body-class).

## A video on a quiz page is not responsive

**Cause:** the stylesheet that makes `.ld-video` responsive loads on course and lesson pages only, not on quiz pages.

**Fix:** none in the plugin as it stands; this is its current behavior. See [Stylesheet](What-the-plugin-changes.md#stylesheet).

## A user cannot see the admin bar

**Cause:** the user lacks the `edit_posts` capability. The plugin hides the admin bar for every such user on every page, whatever the user's profile setting says.

**Fix:** give the user a role that has `edit_posts` (Contributor or above) if they need the bar. See [Admin bar](What-the-plugin-changes.md#admin-bar).

## The stylesheet change does not show after an update

**Cause:** a page cache or CDN is serving a page that still names the previous version in the stylesheet's `ver` query string.

**Fix:** clear the site's page cache. The version in the URL comes from the plugin header, so a released update changes it. See [Stylesheet](What-the-plugin-changes.md#stylesheet).
