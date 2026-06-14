<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'home';
        parent::__construct();
        $this->middleware('auth.check');
    }

    public function index()
    {
        $data['role'] = session('role');
        $data['name'] = session('name');
        return view('home', $data);
    }
}
