<?php
/**
 * Everything that changes when a release ships.
 *
 * This is the only file you need to edit for a new version. The banner, the
 * footer, the announcement on the front page and the download page all read
 * from here, so a version number cannot go stale in one corner of the site
 * while being current in another.
 *
 * Placeholders: write {site_version} and {app_version} instead of repeating
 * the numbers. They are substituted everywhere, including inside the texts.
 *
 * The texts are rendered as HTML so they can carry links and bold. They are
 * site content written by the operator, never user input - do not put anything
 * here that came from a visitor.
 */

return [

    // ---------------------------------------------------------------
    // Versions
    // ---------------------------------------------------------------

    /** Version of this website, shown in the footer. */
    'site_version' => '2.6',

    /**
     * Version of the Windows app, as "major.minor".
     *
     * This is the fallback. The live value is read from the GitHub releases
     * API and cached, so it stays right even if this file is forgotten - but
     * whenever GitHub cannot be reached, this is what visitors see. Keep it
     * updated anyway.
     */
    'app_version' => '1.3',

    // ---------------------------------------------------------------
    // Links
    // ---------------------------------------------------------------

    'links' => [
        'repo'     => 'https://github.com/Vijabei/SteamWorkshopManager',
        'releases' => 'https://github.com/Vijabei/SteamWorkshopManager/releases',
        'latest'   => 'https://github.com/Vijabei/SteamWorkshopManager/releases/latest',

        /**
         * Where people report problems. Feedback runs through GitHub issues
         * so a report has a public thread, a status and a place to reply -
         * split by topic, because the app and the website are two projects.
         */
        'issues_app'  => 'https://github.com/Vijabei/SteamWorkshopManager/issues',
        'issues_site' => 'https://github.com/Vijabei/steamcmd-generator/issues',

        /**
         * "owner/repo" for the releases API used to read the current version.
         * Leave empty to switch the lookup off and always use 'app_version'.
         */
        'api_repo' => 'Vijabei/SteamWorkshopManager',
    ],

    // ---------------------------------------------------------------
    // Announcement banner, shown at the top of every page
    // ---------------------------------------------------------------

    'banner' => [
        'title' => '&#127881; Version {site_version} - Workshop Manager {app_version} is out',
        'intro' => 'Hey gaming fans! What\'s new:',
        'items' => [
            '<b>Workshop Manager {app_version} is out</b>, with two new options for people who keep mods rather than just play them. Both are off by default, because both are wrong when you are simply feeding a game.',
            '<b>Name folders after the mod</b>, not after its Workshop number. Much easier to find your way around a collection of kept mods - just leave it on the number when you install for a game, because that is what games expect.',
            '<b>Keep the publication date on the files.</b> Downloading normally stamps everything with today. This puts back the date the version was actually published on the Workshop, and both dates are now noted for every mod as well.',
            '<b>Already running an older version?</b> Just start the app - it offers the update by itself and installs it with one click. Nothing to download by hand.',
            '<b>Want the new stuff early from now on?</b> There is a beta channel in the settings. Switch it on once and future test builds arrive the same way.',
            'Found a problem or have an idea? Open an issue on GitHub - for the app under <a href="https://github.com/Vijabei/SteamWorkshopManager/issues" target="_blank" rel="noopener">SteamWorkshopManager</a>, for this site and the browser script under <a href="https://github.com/Vijabei/steamcmd-generator/issues" target="_blank" rel="noopener">steamcmd-generator</a>. You will get a notification when it is answered.',
        ],
    ],

    // ---------------------------------------------------------------
    // Announcement card on the front page
    // ---------------------------------------------------------------

    'announcement' => [
        'title' => 'Workshop Manager {app_version}',
        'lead'  => 'A complete mod manager - browse the Steam Workshop, pick a collection and install everything with one click. No command files needed, and it keeps itself up to date.',
        'items' => [
            'Built-in Steam Workshop browser - import collections and your subscribed items directly',
            'Resolves collections locally via the official Steam Web API (nested collections included)',
            'One-click SteamCMD setup and reliable batched downloads with retries',
            'Shows mod titles, sizes and update status - and skips what is already installed',
            'Shows each mod\'s preview, description and required mods or DLC',
            'Keeps a local library, so mod details survive being removed from the Workshop',
            'Optional archiving mode: folders named after the mod, files dated by the Workshop',
            'Updates itself: new versions are offered and installed with one click',
            'Free and open source (Apache 2.0)',
        ],
    ],

    // ---------------------------------------------------------------
    // Footer
    // ---------------------------------------------------------------

    'changelog' => 'Latest: Workshop Manager {app_version} - optional archiving mode with folders named after the mod and files dated by the Workshop, plus previews, descriptions and requirements for every mod.',

];
