<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class KebutuhanController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'kebutuhan';
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
    public function daftarPosko(Request $request)
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

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/kebutuhan', $params);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('kebutuhan.daftar_posko');
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

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/kebutuhan', $params);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('kebutuhan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/kebutuhan/create-edit', []);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('kebutuhan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/kebutuhan/store', $request->all());

        if ($response->created()) {
            return redirect()->route('kebutuhan.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/kebutuhan/create-edit', ['id' => $id]);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('kebutuhan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response  = Http::withToken(session('jwt_token'))->put(env('API_URL') . 'api/kebutuhan/update/' . $id, $request->all());

        if ($response->ok()) {
            return redirect()->route('kebutuhan.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/kebutuhan/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
