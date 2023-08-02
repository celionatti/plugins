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

    if(is_numeric($key) || !empty($key))
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
    $loaded = false;
    foreach ($plugins_folders as $folders) {
        $file = 'plugins/' . $folders . '/plugin.php';
        if(file_exists($file)) {
            require $file;
            $loaded = true;
        }
    }

    return $loaded;
}

function add_action(string $hook, mixed $func): bool
{
    global $ACTIONS;

    $ACTIONS[$hook] = $func;

    return true;
}

function do_action(string $hook, array $data = [])
{
    global $ACTIONS;

    if(!empty($ACTIONS[$hook])) {
        $ACTIONS[$hook]($data);
    }
}

function add_filter()
{
    
}

function do_filter()
{

}

function dd($data)
{
    echo "<div style='margin:1px;background-color:#444; color:#fff; padding:5px 10px;'>";
    print_r($data);
    echo "</div>";
}

function page()
{
    return URL(0);
}

function redirect($url)
{
    header("Location: " . ROOT . '/' . $url);
    die;
}
