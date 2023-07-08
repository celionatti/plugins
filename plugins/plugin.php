<?php

add_filter('hero_titles', function($data) {
    $data[] = 'Help';
    $data[] = 'Menu';
    $data[] = 'Users';

    return $data;
});

add_action('images_section', function() {
    echo "<div><img src='images/image(6).jpg' alt='' style='max-width:100%;border:solid 2px red;'>This is for the Images Section</div>";
});