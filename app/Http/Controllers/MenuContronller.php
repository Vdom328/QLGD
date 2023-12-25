<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuContronller extends Controller
{
    public function index()
    {
        return view('pages.menu.list');
    }
}
