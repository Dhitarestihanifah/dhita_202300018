<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'page' => 'v_home',
        ];
        return view('v_template', $data);
    }
}
