<?php

/**
 * Plugin name: Header Footer
 * Author: Celio natti
 * Description: Plugin created for fun.
 * 
 * 
 **/


/** displays the view file **/
add_action('before_view',function(){

	require plugin_path('views/header.php');
});

add_action('after_view',function(){

	require plugin_path('views/footer.php');
});



