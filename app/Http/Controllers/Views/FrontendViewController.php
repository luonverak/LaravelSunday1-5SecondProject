<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendViewController extends Controller
{
    public function index(){
        return view("frontend.frontend_master");
    }
}
