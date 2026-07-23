<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class RencanaAnggaranController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'rencana-anggaran';
        parent::__construct();
        $this->middleware('auth.check');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $params['all'] = 1;

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/rencana-anggaran', $params);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->addColumn('TanggalRencana', function ($data) {
                    return date('d F Y', strtotime($data['TanggalRencana']));
                })
                ->addColumn('created_at', function ($data) {
                    return date('d F Y H:i:s', strtotime($data['created_at']));
                })
                ->addColumn('updated_at', function ($data) {
                    return date('d F Y H:i:s', strtotime($data['updated_at']));
                })
                ->make(true);
        }

        $title = 'Daftar Rencana Anggaran';
        return view('rencana_anggaran.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Rencana Anggaran';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/rencana-anggaran/create-edit', []);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('rencana_anggaran.create', compact('title', 'data'));
    }

    public function bantuan(Request $request)
    {
        $url_request = env('API_URL') . 'api/bantuan';

        $result = [];

        if ($request->bantuans) {

            foreach ($request->bantuans as $bantuan_id) {
                $response =  Http::withToken(session('jwt_token'))->get("{$url_request}/show/{$bantuan_id}", []);
                $response_body = json_decode($response->getBody());
                $bantuan = $response_body->data;
                $result[] = $bantuan;
            }
        } else {
            $response =  Http::withToken(session('jwt_token'))->get("{$url_request}", []);
            $response_body = json_decode($response->getBody());
            $result = $response_body->data;
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/rencana-anggaran/store', $request->all());

        if ($response->created()) {
            return redirect()->route('rencana-anggaran.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Rencana Anggaran';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/rencana-anggaran/show/' . $id, []);
        $response_body = json_decode($response->getBody());
        $rencana_anggaran = $response_body->data;

        return view('rencana_anggaran.view', compact('title', 'rencana_anggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Distribusi Bantuan';
        $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/rencana-anggaran/create-edit', ['id' => $id]);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;
        $bantuan_ids = array_unique(collect($data->rencana_anggaran->rencana_anggaran_items)->pluck('IDBantuan')->toArray());

        return view('rencana_anggaran.edit', compact('title', 'data', 'bantuan_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response  = Http::withToken(session('jwt_token'))->put(env('API_URL') . 'api/rencana-anggaran/update/' . $id, $request->all());

        if ($response->ok()) {
            return redirect()->route('rencana-anggaran.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response =  Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/rencana-anggaran/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
