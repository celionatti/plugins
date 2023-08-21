<?php

$user = new User();

add_action('controller', function() {
    dd($_POST);
});

add_action('after_view', function() {
    echo "<center><footer>Natti Plugins Copyright 2023</footer></center>";
});

add_action('view', function() {
    echo "<center><form style='width:400px;margin:auto;text-align:center;margin-top:15px;' method='post'>
    <h4>Login</h4>
    <input type='email' name='email' placeholder='E-mail'/><br>
    <input type='password' name='password' placeholder='Password'/><br><br>
    <button>Login</button>
    </form></center>";
});

add_action('before_view', function() {
    echo "<center><div><a href=''>Home</a> . About Us . Contact</div></center>";
});
