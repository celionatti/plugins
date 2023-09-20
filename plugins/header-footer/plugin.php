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
	$links = [];
    
    $link        = (object)[];
    $link->id    = 0;
    $link->title = 'Home';
    $link->slug  = 'home';
    $link->icon  = '';
    $link->permission  = '';
    $links[] = $link;

    $links = do_filter(plugin_id().'_before_menu_links',$links);
	
	require plugin_path('views/header.php');
});

add_action('after_view',function(){

	require plugin_path('views/footer.php');
});



