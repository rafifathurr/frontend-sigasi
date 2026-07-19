<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'dashboard';
        parent::__construct();
        $this->middleware('auth.check');
    }

    public function index()
    {
        $data['role'] = session('role');
        $data['name'] = session('name');

        if (in_array(session('role'), ['kecamatan', 'posko-utama', 'bansos'])) {
            
            $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/dashboard', []);
            $response_body = json_decode($response->getBody());

            $data['distribusi_bantuan'] = $response_body->data->distribusi_bantuan;
            $data['bantuan'] = $response_body->data->bantuan;
            $data['penduduk'] = $response_body->data->penduduk;
            $data['barang'] = $response_body->data->barang;
        } 

        $data['title'] = 'Dashboard';
        return view('dashboard.index', $data);
    }
}
