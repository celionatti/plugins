<?php

define('DEBUG', true);
define('APP_NAME', 'pluginPHP Framework');
define('APP_DESCRIPTION', 'The best plugin php framework');

/**
 * ============================
 * DATABASE CONFIGURATION =====
 * ============================
 */

if ($_SERVER['SERVER_NAME'] === "localhost") {
    define("ROOT", 'http://plugins.test');
    define('DB_NAME', 'pluginphp_db');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('DB_DRIVER', 'mysql');
} else {
    define('DB_NAME', 'pluginphp_db');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('DB_DRIVER', 'mysql');
    define("ROOT", 'https://yourwebsite.com');
}
