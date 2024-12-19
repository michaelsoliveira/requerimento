<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['guest']);
    // }
    public function index()
    {
        if (Auth::check()) {
            return view('menu');  // Retorna a view 'menu'
        } else {
            return redirect()->route('auth.login');
        }
    }
}

