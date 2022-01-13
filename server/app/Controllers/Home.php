<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return json_encode([
            "message" => "selamat datang di api saya"
        ]);
    }
}
