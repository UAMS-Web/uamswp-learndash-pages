# What the plugin changes

Written against v1.0.2.

The plugin makes three changes, each through a standard WordPress hook in `uamswp-learndash-pages.php`. It has no settings screen and stores nothing in the database: activating it applies all three, and deactivating it removes them.

| Change | Hook | Applies to | Effect |
| --- | --- | --- | --- |
| Body class | `body_class` filter | Single course, lesson and quiz pages | Adds `page-template-default` to the `<body>` classes |
| Stylesheet | `wp_enqueue_scripts` action | Single course and lesson pages | Enqueues `uams-2020-learndash.css` |
| Admin bar | `set_current_user` action | Every request, for a user without `edit_posts` | Hides the admin bar |

The page types are LearnDash's post types: `sfwd-courses` (courses), `sfwd-lessons` (lessons) and `sfwd-quiz` (quizzes). A page is matched with `is_singular()`, so archive and listing pages are not affected.

## Body class

The UAMS 2020 theme styles a page by its `<body>` classes. LearnDash course, lesson and quiz pages are custom post types, so the theme's rules for ordinary pages do not reach them. The plugin adds `page-template-default`, the class WordPress gives a page on the default template, so those rules apply to the LearnDash pages too.

The class is added to the classes WordPress already built; none is removed. On any other page the list is returned unchanged.

## Stylesheet

On a single course or lesson page the plugin enqueues one stylesheet:

| Property | Value |
| --- | --- |
| Handle | `uamswp-learndash` |
| File | `uams-2020-learndash.css`, in the plugin folder |
| Dependencies | none |
| Version | the plugin's version, read from the `Version` line of the plugin header |
| Media | `all` |

The stylesheet makes an embedded LearnDash video (`.ld-video`) responsive: the container keeps a 16:9 shape at the full width of the content area, and the `iframe` inside it fills the container.

Quiz pages do not load it.

Because the version comes from the plugin header, a new release changes the `ver` query string on the stylesheet's URL, so browsers fetch the new file rather than a cached copy.

## Admin bar

When WordPress sets the current user, the plugin hides the admin bar for anyone who lacks the `edit_posts` capability, for example a learner with the Subscriber role. Editors, authors, contributors and administrators keep it.

**Note:** this applies to every page on the site, not only LearnDash pages, because it runs for every request.

## Requirements

The plugin header declares WordPress 6.8 or later and PHP 8.2 or later. LearnDash and the UAMS 2020 theme are what the changes are for, but the plugin does not check for either: without LearnDash no page matches, and without the theme the body class has no rules to apply.
