<?php

add_action('controller', function() {
    $arr = ['name'=>'mary','age'=>29];
    set_value($arr);
});

add_action('after_view', function() {
    echo "<center><footer>Natti Plugins Copyright 2023</footer></center>";
});

add_action('view', function() {
    dd(get_value());
});

add_action('before_view', function() {
    echo "<center><div><a href=''>Home</a> . About Us . Contact</div></center>";
});
