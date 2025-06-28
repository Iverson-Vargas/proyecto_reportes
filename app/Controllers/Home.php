<?php

namespace App\Controllers;

class Home extends BaseController
{
    
    public function welcome()
    {
        return view('welcome_message');
    }
    
}
