<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BantuanController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'bantuan';
        parent::__construct();
        $this->middleware('auth.check');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/bantuan', []);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data->data;

        return view('bantuan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/donatur', []);
        $response_body = json_decode($response->getBody());
        $donaturs = $response_body->data->data;

        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/barang', []);
        $response_body = json_decode($response->getBody());
        $barangs = $response_body->data->data;

        return view('bantuan.create', compact('donaturs', 'barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/bantuan/store', $request->all());

        if ($response->created()) {
            return redirect()->route('bantuan.index')->with('success', 'Bantuan Berhasil Di-input');
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/bantuan/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $bantuan = $response_body->data;

        return view('bantuan.view', compact('bantuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/donatur', []);
        $response_body = json_decode($response->getBody());
        $donaturs = $response_body->data->data;

        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/barang', []);
        $response_body = json_decode($response->getBody());
        $barangs = $response_body->data->data;

        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/bantuan/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $bantuan = $response_body->data;

        return view('bantuan.edit', compact('bantuan', 'barangs', 'donaturs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::withToken(session('jwt_token'))->put(env('API_URL') . 'api/bantuan/update/' . $id, $request->all());

        if ($response->ok()) {

            return redirect()->route('bantuan.index')->with('success', 'Bantuan Berhasil Di-Update');
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/bantuan/delete/' . $id, []);

        if ($response->ok()) {

            return redirect()->route('bantuan.index')->with('success', 'Bantuan Berhasil Di-Hapus');
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
