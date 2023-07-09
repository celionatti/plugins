<?php

use Core\App;

session_start();

$minPHPVersion = "8.0";

if(phpversion() < $minPHPVersion)
    die("You need a minimum PHP version of $minPHPVersion to run this app");



define('DS', DIRECTORY_SEPARATOR);
define('ROOTPATH', __DIR__. DIRECTORY_SEPARATOR);

require 'config.php';
require 'app'. DS . 'core' . DS . 'init.php';

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$ACTIONS = [];
$FILTERS = [];
$APP['URL'] = split_url($_GET['url'] ?? 'home');

/**
 * ========================
 * 
 * Load Plugins ===========
 * 
 * ========================
 */

 $PLUGINS = get_plugins_folders();
 if(!load_plugins($PLUGINS))
    die("<center><h1 style='font-family:tahoma;margin-top:15px;'>No plugins were found!, Please put atleast one plugin in the Plugins folder</h1></center>");

$app = new \Core\App();
$app->index();