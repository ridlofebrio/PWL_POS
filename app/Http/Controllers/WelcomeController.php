<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumbs =(object) [
            'title' => 'Welcome',
            'list' => ['Home','Welcome']
        
        ];
        $activeMenu = 'dashboard';
        return view('welcome', ['breadcrumb' => $breadcrumbs, 'activeMenu' => $activeMenu]);
    }
    
}
