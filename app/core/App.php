<?php

namespace Core;

class App
{
    public function index()
    {
        echo "<pre>";
        print_r(URL());
    }
}