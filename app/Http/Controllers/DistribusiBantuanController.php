<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class DistribusiBantuanController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'distribusi-bantuan';
        parent::__construct();
        $this->middleware('auth.check');

        $this->middleware(function ($request, $next) {

            if (session('role') == 'posko' && is_null(session('posko'))) {
                return redirect()->route('home')->with('error', 'Anda belum diassign sebagai posko!');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $params['all'] = 1;

            if (session('role') == 'posko') {
                $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/posko', ['all' => 1, 'user' => session('user_id')]);
                $response_body = json_decode($response->getBody());

                if (!is_null($response_body->data) && !empty($response_body->data)) {
                    $params['posko'] = $response_body->data[0]->IDPosko;
                }
            } else {
                if (isset($request->posko)) {
                    $params['posko'] = $request->posko;
                }
            }

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/distribusi-bantuan', $params);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->addColumn('TanggalDistribusi', function ($data) {
                    return date('d F Y', strtotime($data['TanggalDistribusi']));
                })
                ->make(true);
        }

        $title = 'Daftar Distribusi Bantuan';
        return view('distribusi_bantuan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Distribusi Bantuan';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/distribusi-bantuan/create-edit', []);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('distribusi_bantuan.create', compact('title', 'data'));
    }

    public function bantuan(Request $request)
    {
        $url_request = env('API_URL') . 'api/bantuan';

        $bantuan = [];

        if ($request->bantuan_id) {
            $response =  Http::withToken(session('jwt_token'))->get("{$url_request}/show/{$request->bantuan_id}", []);
            $response_body = json_decode($response->getBody());
            $bantuan = $response_body->data;
        } else {
            $response =  Http::withToken(session('jwt_token'))->get("{$url_request}", []);
            $response_body = json_decode($response->getBody());
            $bantuan = $response_body->data;
        }

        return response()->json($bantuan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/distribusi-bantuan/store', $request->all());

        if ($response->created()) {
            return redirect()->route('distribusi-bantuan.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Distribusi Bantuan';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/distribusi-bantuan/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $distribusi_bantuan = $response_body->data;

        return view('distribusi_bantuan.view', compact('title', 'distribusi_bantuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Distribusi Bantuan';
        $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/distribusi-bantuan/create-edit', ['id' => $id]);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('distribusi_bantuan.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response  = Http::withToken(session('jwt_token'))->put(env('API_URL') . 'api/distribusi-bantuan/update/' . $id, $request->all());

        if ($response->ok()) {
            return redirect()->route('distribusi-bantuan.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/distribusi-bantuan/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
