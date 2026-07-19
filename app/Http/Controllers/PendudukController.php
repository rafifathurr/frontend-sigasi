<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'penduduk';
        parent::__construct();
        $this->middleware('auth.check');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/penduduk', ['all' => 1]);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->make(true);
        }

        $title = 'Daftar Penduduk';
        return view('penduduk.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Penduduk';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/penduduk/create-edit', []);
        $response_body = json_decode($response->getBody()); 
        $kelompoks = $response_body->data->kelompok;

        return view('penduduk.create', compact('title', 'kelompoks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/penduduk/store', $request->all());

        if ($response->created()) {
            return redirect()->route('penduduk.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Penduduk';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/penduduk/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $penduduk = $response_body->data;

        return view('penduduk.view', compact('title', 'penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Penduduk';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/penduduk/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $penduduk = $response_body->data;

        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/kelompok', []);
        $response_body = json_decode($response->getBody());
        $kelompoks = $response_body->data->data;

        return view('penduduk.edit', compact('title', 'penduduk', 'kelompoks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/penduduk/update/' . $id, $request->all());

        if ($response->ok()) {

            return redirect()->route('penduduk.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/penduduk/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
