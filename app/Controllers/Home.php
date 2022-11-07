<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->Smarty->View("welcome_message", [
            "Title" => "CodeIgniter4 With Smarty 4 - "
        ]);
    }
}
