<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function index(){
        return view('explorer.index');
    }
}
