<?php
define('SITE_TITLE', 'Steam Workshop Collection Downloader');
define('SITE_DESCRIPTION', 'Download Steam Workshop Collections easily');
$isSubDirectory = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false;
$cssPath = $isSubDirectory ? '../css' : './css';
$faviconPath = $isSubDirectory ? '../favicon.png' : './favicon.png';
?>
