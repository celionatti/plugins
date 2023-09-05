<?php

add_action('controller', function() {
});

add_action('after_view', function() {
    echo "<center><footer>Natti Plugins Copyright 2023</footer></center>";
});

add_action('view', function() {
});

add_action('before_view', function() {
    echo "<center><div><a href=''>Home</a> . About Us . Contact</div></center>";
});
