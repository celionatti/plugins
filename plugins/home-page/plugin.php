<?php

require plugin_dir() . 'includes/view.php';

add_action('view', function() {
    dd("This is from the homepage view hook");
});

add_action('controller', function() {
    
});