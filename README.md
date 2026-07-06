# Steam Workshop Collection Downloader (Website)

![License](https://img.shields.io/badge/License-CC%20BY--NC-lightgrey.svg)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4)

The website behind [softknight.de](https://softknight.de): a free web tool that turns Steam Workshop collections into ready-to-use SteamCMD download commands. Created by gamers for gamers.

It is the companion to two other tools:

- **[Workshop Manager](https://github.com/Vijabei/SteamWorkshopManager)** - the Windows app with a built-in workshop browser and one-click installs
- **Tampermonkey script** (in [`downloads/`](downloads/)) - adds a command-generation button directly on Steam Workshop pages

## Features

- 🔗 Paste a collection URL, get a complete SteamCMD script (nested collections included)
- 🌐 Collections are resolved via the official Steam Web API - no scraping, no API key
- 👤 Works together with the Tampermonkey script for personal subscription lists
- 📚 Guide and FAQ for the whole workflow (SteamCMD, mod installation, the app)
- 🎨 Themes: Light, Dark and a Steam-inspired look - adding your own skin is a single CSS file (see `css/themes/`)
- 🔒 Privacy-friendly: IP addresses are anonymized before logging; log and feedback directories are blocked from web access

## Requirements

- PHP 8.0+ with `openssl` (for HTTPS calls to the Steam Web API) and `allow_url_fopen` enabled
- Apache with `.htaccess` support (or equivalent rules on nginx)
- Write permissions for the `logs/` and `feedback/` directories

## Setup

The guided way:

1. Copy the files to your web root.
2. Open `setup-check.php` in your browser - it verifies all requirements (PHP version, cURL, Steam API reachability, directory permissions, log protection) and creates `includes/config.php` for you.
3. Follow the remaining notes on that page, then **delete `setup-check.php`** from production.

The manual way:

1. Copy the files to your web root.
2. Copy `includes/config.sample.php` to `includes/config.php` and set `BASE_URL` to your domain.
3. Copy `sitemap.sample.xml` to `sitemap.xml` and `robots.sample.txt` to `robots.txt`, replace the example domain.
4. Make sure `logs/` and `feedback/` are writable by PHP - and verify that both are **not** reachable from the web (the included `.htaccess` files handle this on Apache).
5. Optional: adjust the endpoint URLs in `downloads/collection-downloader.user.js` if you self-host the Tampermonkey script.

## API

`generate.php` is a small JSON API - the website form, the Tampermonkey script and any third-party client (including AI agents) use the same endpoints:

**Resolve a collection** (nested collections are flattened automatically):

```
POST /generate.php
Content-Type: application/x-www-form-urlencoded

collectionURL=https://steamcommunity.com/sharedfiles/filedetails/?id=123456789
```

**Build a script from a plain mod list** (used for subscription pages):

```
POST /generate.php
Content-Type: application/x-www-form-urlencoded

modIds=["111","222","333"]&appId=294100
```

**Response** (both variants):

```json
{ "success": true, "downloadCommands": "// SteamCMD script ...", "warning": "optional note" }
{ "success": false, "error": "message" }
```

Collections are resolved via the official Steam Web API (`ISteamRemoteStorage`) - no Steam login or API key involved. Cross-origin requests are only accepted from the origins listed in `ALLOWED_ORIGINS`. An [`llms.txt`](llms.txt) with a machine-readable summary of the tools is served at the site root.

## Themes / Skins

A theme is a single CSS file in `css/themes/` that overrides the design tokens from `css/style.css` (colors, shadows, surfaces). To add one:

1. Copy `css/themes/dark.css` to `css/themes/<name>.css` and change the values under `html[data-theme="<name>"]`.
2. Link the file in `includes/header.php`.
3. Add `<name>` to the `THEMES` list in `js/theme.js` and an `<option>` to the theme selector in `includes/navigation.php`.

## Deployment via GitHub Actions

`.github/workflows/deploy.yml` contains an FTP deployment for the `staging` branch. Set the `FTP_SERVER`, `FTP_USERNAME` and `FTP_PASSWORD` secrets in your repository settings and adjust `server-dir` to your hosting path.

## Privacy notes

- Visitor IP addresses are anonymized (IPv4: last octet zeroed, IPv6: truncated to /48) before they are written to any log.
- `logs/` and `feedback/` are excluded from version control and blocked from web access - keep it that way.
- The Workshop Manager desktop app never sends data to this website; it only talks to the official Steam servers.

## License

This project is licensed under the [Creative Commons Attribution-NonCommercial 4.0 International License](https://creativecommons.org/licenses/by-nc/4.0/) - free to use, adapt and share, but not for commercial purposes.

## Support

Found a bug or have an idea? Open an issue here on GitHub or use the feedback form on the website.
