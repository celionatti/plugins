<?php

/**
 * Split URL
 *
 * @param [type] $url
 * @return void
 */
function split_url($url)
{
    return explode("/", trim($url, '/'));
}

/**
 * Get the URL stings.
 *
 * @param string $key
 * @return void
 */
function URL($key = '')
{
    global $APP;

    if(!empty($key))
    {
        if(!empty($APP['URL'][$key])) {
            return $APP['URL'][$key];
        }
    } else {
        return $APP['URL'];
    }
    
    return '';
}

/**
 * Read folders from the plugins folder.
 *
 * @return array
 */
function get_plugins_folders():array
{
    $plugins_folders = "plugins/";
    $res = [];
    $folders = scandir($plugins_folders);
    foreach ($folders as $folder) {
        if($folder != '.' && $folder != '..' && is_dir($plugins_folders . $folder)) {
            $res[] = $folder;
        }
    }

    return $res;
}

/**
 * Loads the Plugins from the plugins folder.
 *
 * @param array $plugins_folders
 * @return boolean
 */
function load_plugins(array $plugins_folders):bool
{
    $found = false;
    foreach ($plugins_folders as $folders) {
        $found = true;
    }

    return $found;
}