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

    if (is_numeric($key) || !empty($key)) {
        if (!empty($APP['URL'][$key])) {
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
function get_plugins_folders(): array
{
    $plugins_folders = "plugins/";
    $res = [];
    $folders = scandir($plugins_folders);
    foreach ($folders as $folder) {
        if ($folder != '.' && $folder != '..' && is_dir($plugins_folders . $folder)) {
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
function load_plugins(array $plugins_folders): bool
{
    global $APP;

    $loaded = false;

    foreach ($plugins_folders as $folder) {
        $file = 'plugins/' . $folder . '/config.json';

        if (file_exists($file)) {
            $json = json_decode(file_get_contents($file));
            if (is_object($json) && isset($json->id)) {
                if (!empty($json->active)) {
                    $file = 'plugins/' . $folder . '/plugin.php';
                    if (file_exists($file) && valid_route($json)) {
                        $json->index_file = $file;
                        $json->path = 'plugins/' . $folder . '/';
                        $json->http_path = ROOT . '/' . $json->path;
                        $APP['plugins'][] = $json;
                    }
                }
            }
        }
    }

    if (!empty($APP['plugins'])) {
        foreach ($APP['plugins'] as $json) {
            if (file_exists($json->index_file)) {
                require $json->index_file;
                $loaded = true;
            }
        }
    }

    return $loaded;
}

function valid_route(object $json): bool
{
    if (!empty($json->routes->off) && is_array($json->routes->off)) {
        if (in_array(page(), $json->routes->off))
            return false;
    }

    if (!empty($json->routes->on) && is_array($json->routes->on)) {
        if ($json->routes->on[0] == "all")
            return true;

        if (in_array(page(), $json->routes->on))
            return true;
    }

    return false;
}

function add_action(string $hook, mixed $func, int $priority = 10): bool
{
    global $ACTIONS;

    while (!empty($ACTIONS[$hook][$priority])) {
        $priority++;
    }
    $ACTIONS[$hook][$priority] = $func;

    return true;
}

function do_action(string $hook, array $data = [])
{
    global $ACTIONS;

    if (!empty($ACTIONS[$hook])) {
        ksort($ACTIONS[$hook]);
        foreach ($ACTIONS[$hook] as $key => $func) {
            $func($data);
        }
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
    echo "<pre><div style='margin:1px;background-color:#444; color:#fff; padding:5px 10px;'>";
    print_r($data);
    echo "</div></pre>";
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

function plugin_dir()
{
    $called_from = debug_backtrace();

    $key = array_search(__FUNCTION__, array_column($called_from, 'function'));

    return get_plugins_dir(debug_backtrace()[$key]['file']);
}

function plugin_http_dir()
{
    $called_from = debug_backtrace();

    $key = array_search(__FUNCTION__, array_column($called_from, 'function'));

    return ROOT . DIRECTORY_SEPARATOR . get_plugins_dir(debug_backtrace()[$key]['file']);
}

function get_plugins_dir(string $filepath): string
{
    $path = "";
    
    $basename = basename($filepath);
    $path = str_replace($basename, "", $filepath);

    if(strstr($path, DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR)) {
        $parts = explode(DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR, $path);
        $path = $parts[1];
        $path = 'plugins' . DIRECTORY_SEPARATOR . $parts[1];
    }
    return $path;
}