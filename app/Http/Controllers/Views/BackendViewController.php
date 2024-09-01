<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendViewController extends Controller
{
    public function index()
    {
        return view("backend.index");
    }
    public function category()
    {
        return view("backend.category");
    }
}
