<?php

// What be yer environment URLs, matey?
$envs = [
    'dev' => ['dev.example1.com', 'dev.example2.com'],
    'stage' => 'stage.example1.com',
    'prod' => 'example.com,www.example.com',
];

/*
*   You probably don't want to edit below this line.
*
*/

// Sets yer environment. Yarr!
if (!defined('CRAFT_ENVIRONMENT')) {

    if (file_exists(dirname(__FILE__) . '/config.local.php')) {

        // Here be local config file – assume local env
        define('CRAFT_ENVIRONMENT', 'local');

    } else {

        $host = $_SERVER['SERVER_NAME'];

        foreach ($envs as $env => $hosts) {
            if (!is_array($hosts)) {
                $hosts = explode(',', preg_replace('/\s+/', '', $hosts));
            }
            if (in_array($host, $hosts)) {
                define('CRAFT_ENVIRONMENT', $env);
                break;
            }
        }

    }

    if (!defined('CRAFT_ENVIRONMENT')) {
        die('No environment defined in ' . __FILE__);
    }

}

// Set yer config path to the containing folder. Arr!
define('CRAFT_CONFIG_PATH', dirname(__FILE__) . '/');

// Ensure our urls have the right scheme
define('URI_SCHEME', (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://');

// The site url
define('CRAFT_SITE_URL', URI_SCHEME . $_SERVER['SERVER_NAME'] . '/');

// The site basepath
define('BASEPATH', realpath(dirname(__FILE__) . '/../') . '/');

// Template and plugins paths
if (isset($pluginsPath) && !defined('CRAFT_PLUGINS_PATH'))
{
    define('CRAFT_PLUGINS_PATH', rtrim($pluginsPath, '/') . '/');
}
if (isset($templatesPath) && !defined('CRAFT_TEMPLATES_PATH'))
{
    define('CRAFT_TEMPLATES_PATH', rtrim($templatesPath, '/') . '/');
}
if (isset($translationsPath) && !defined('CRAFT_TRANSLATIONS_PATH'))
{
    define('CRAFT_TRANSLATIONS_PATH', rtrim($translationsPath, '/') . '/');
}
if (isset($storagePath) && !defined('CRAFT_STORAGE_PATH'))
{
    define('CRAFT_STORAGE_PATH', rtrim($storagePath, '/') . '/');
}

// The site's public basepath - usually set in index.php, if not then just use the basepath yep
if (isset($publicPath)) {
    define('PUBPATH', rtrim($publicPath, '/') . '/');
} else {
    define('PUBPATH', BASEPATH);
}

// Fix for Valet not setting DOCUMENT_ROOT
if (CRAFT_ENVIRONMENT === 'local' && $_SERVER['DOCUMENT_ROOT'] !== PUBPATH) {
  $_SERVER['DOCUMENT_ROOT'] = PUBPATH;
}

define('HEARTY_CONFIG_VERSION', '1.1.2');
