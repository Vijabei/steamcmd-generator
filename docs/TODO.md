# Open work

Last reviewed 2026-08-20, after the 1.3 announcement went live.

## Design, in a session of its own

- **More green.** The accent is used sparingly today. The view here is that a
  strong green carried through consistently is a distinctive choice few sites
  make any more, and that the dark theme already shows it works.
- **The guide's structure.** It is a carousel: five cards side by side, numbered
  buttons, one on screen at a time. The idea on the table is turning it into one
  continuous page with a table of contents and anchors.

  For a guide that is arguably the better shape - findable with Ctrl+F,
  printable, deep-linkable, better for search engines, and more natural on a
  phone. The anchors already exist. The reservation is equally real: endless
  scrolling reads as an attention-grabbing pattern. The difference is whether
  the reader can see how long the thing is, which a table of contents that
  travels with the page provides.

  Not decided. The display bug that prompted the discussion is fixed either way.

## After the SignPath certificate is issued

The wording is fixed by their terms and must appear on the **homepage** and the
**download page**, under a heading "Code signing policy":

> Free code signing provided by SignPath.io, certificate by SignPath Foundation

Put it in `includes/content/release.php` so it renders everywhere from one
place. Not before the certificate exists - saying it earlier would be untrue.

## Smaller things

- **`llms.txt` stays manual.** It is a static text file and cannot include PHP,
  so it does not follow `content/release.php` like the rest. Either leave it, or
  serve it through PHP with a rewrite - which would mean introducing a root
  `.htaccess`, and there is none today.
- **`setup-check.php` is deliberately not deployed.** It reports the PHP
  version, the available extensions and directory permissions, which is useful
  while installing and needless exposure afterwards. It stays in the repository
  for anyone installing from source; upload it by hand if the server ever needs
  diagnosing.

---

# Verified

## Deployment (2026-08-20)

The site deploys itself: a push to `main` reaches Hetzner over FTPS in about
forty seconds. The second run took 4.5 seconds because only differences move.

Worth knowing about the deploy action:

- **Excluding a file does not delete it from the server.** Excluded files are
  invisible to it. Same for anything that predates the first sync - the first
  publish reported `Server Files: 0` and deleted nothing, so six obsolete files
  had to be removed by hand. They are gone now (checked: all return 404).
- The dry run (`workflow_dispatch`, default on) reports every upload and delete
  without touching the server. Worth running after any change to the exclude
  list.
- Deployment-specific files are protected by exclusion and stay untouched:
  `config.php`, `robots.txt`, `sitemap.xml`, the search console file, and the
  contents of `logs/` and `cache/`.

## The version lookup (2026-08-20)

`content/loader.php` reads the current app version from the GitHub releases API
and caches it for an hour, with the value in `content/release.php` as the
fallback. Eight checks cover it: tag parsing including rejecting pre-releases,
the fallback paths when the lookup is disabled or the repository is unknown, the
negative cache that keeps an unreachable API from slowing every page, and a
numeric comparison so 1.10 counts as newer than 1.9.

One thing this got wrong at first and now handles: after releasing 1.3 the site
went on announcing 1.2, because the cached lookup was still inside its hour. A
higher version in `content/release.php` now invalidates the cache regardless of
its age - editing that file is how a release is announced here.

Also worth recording: the first version of this looked like it worked, but only
because the hardcoded fallback happened to hold the same number as the API would
have returned. It was proven properly by setting the fallback to a deliberately
wrong value and watching the real lookup win.

## The guide's card heights (2026-08-20)

The cards sit in a flex row, so the row was always as tall as the tallest of
them: 671 pixels of empty space below the opening card, more than 1900 below the
short support card. The height now follows the card on screen - measured across
all five, it matches exactly, and the page length varies between 1201 and 3631
pixels instead of a constant 3664. Deep links such as `#mod-manager-details`
size correctly too.

Not a bug, though it looked like one: the neighbouring card does **not** show
past the container edge. An earlier measurement suggested 80 pixels of it did,
but that compared against the viewport rather than the clipping edge. Testing
what is actually painted there returns page background, not a card.
