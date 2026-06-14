<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class DonaturController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'donatur';
        parent::__construct();
        $this->middleware('auth.check');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/donatur', ['all' => 1]);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('donatur.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donatur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/donatur/store', $request->all());

        if ($response->created()) {
            return redirect()->route('donatur.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/donatur/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('donatur.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response  = Http::withToken(session('jwt_token'))->put(env('API_URL') . 'api/donatur/update/' . $id, $request->all());

        if ($response->ok()) {
            return redirect()->route('donatur.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/donatur/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
