<?php

// functions.php
// A simplified implementation of the add_action function

class ActionManager {
    private static $actions = array();

    public static function add_action($hook, $callback, $priority = 10, $args_count = 1) {
        if (!isset(self::$actions[$hook])) {
            self::$actions[$hook] = array();
        }

        self::$actions[$hook][] = array(
            'callback' => $callback,
            'priority' => $priority,
            'args_count' => $args_count
        );
    }

    public static function do_action($hook, ...$args) {
        if (isset(self::$actions[$hook])) {
            // Sort actions based on priority
            usort(self::$actions[$hook], function ($a, $b) {
                return $a['priority'] - $b['priority'];
            });

            foreach (self::$actions[$hook] as $action) {
                $callback = $action['callback'];
                $args_count = $action['args_count'];

                // Call the action callback with the appropriate number of arguments
                if ($args_count == 0) {
                    $callback();
                } elseif ($args_count == 1) {
                    $callback($args[0]);
                } else {
                    $callback(...$args);
                }
            }
        }
    }
}

// Example usage:

// Registering an action
ActionManager::add_action('my_custom_action', 'my_callback_function', 10, 2);

function my_callback_function($arg1, $arg2) {
    echo "Callback function called with args: $arg1, $arg2";
}

// Triggering the action
ActionManager::do_action('my_custom_action', 'Hello', 'World');
