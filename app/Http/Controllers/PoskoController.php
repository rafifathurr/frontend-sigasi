<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class PoskoController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'posko';
        parent::__construct();
        $this->middleware('auth.check');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/posko', ['all' => 1]);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->make(true);
        }

        $title = 'Daftar Posko';
        return view('posko.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Posko';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/posko/create-edit', []);
        $response_body = json_decode($response->getBody());
        $users = $response_body->data->users;

        return view('posko.create', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/posko/store', $request->all());

        if ($response->created()) {
            return redirect()->route('posko.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Posko';
        $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/posko/create-edit', ['id' => $id]);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('posko.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response  = Http::withToken(session('jwt_token'))->put(env('API_URL') . 'api/posko/update/' . $id, $request->all());

        if ($response->ok()) {
            return redirect()->route('posko.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/posko/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
