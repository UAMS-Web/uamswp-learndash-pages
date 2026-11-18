# UAMS 2020 - LearnDash

Adds classes for the UAMS 2020 theme to LearnDash pages.

What the plugin changes, page by page, and how to troubleshoot it are in the [wiki](https://github.com/UAMS-Web/uamswp-learndash-pages/wiki). Its pages are written in [`docs/wiki/`](docs/wiki/Home.md) and published from there.

## Tests

The unit suite runs on Pest 5 with Brain Monkey, so it needs no database and no WordPress checkout. It is developed on PHP 8.4.27 (`config.platform.php` in `composer.json`).

```bash
composer install
composer test
```

The suite also runs through the shared local CI runner, which a pull request needs before it opens:

```bash
node .claude/skills/local-ci/local-ci.mjs
```

## Credits

Developed and maintained by UAMS Web Services.

Developers:

- Josh Daugherty
- Todd McKee
