<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreController extends Controller
{
    public function createSobre()
    {
        return view('Sobre');
    }
}
