<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'user-management';
        parent::__construct();
        $this->middleware('auth.check');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/user-management', ['all' => 1]);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->addColumn('roleName', function ($data) {
                    return $data['roles'][0]['name'] ?? '-';
                })
                ->addColumn('created_at', function ($data) {
                    return date('d F Y H:i:s', strtotime($data['created_at']));
                })
                ->make(true);
        }

        $title = 'Daftar Pengguna';
        return view('user_management.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pengguna';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/user-management/create-edit', []);
        $response_body = json_decode($response->getBody());
        $roles = $response_body->data->roles;

        return view('user_management.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/user-management/store', $request->all());
        
        if ($response->created()) {
            return redirect()->route('user-management.index')->with('success', "Data berhasil disimpan.");
        }

        return redirect()->back()->with('error', "Internal server error.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Pengguna';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/user-management/create-edit', ['id' => $id]);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('user_management.view', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Pengguna';
        $response =  Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/user-management/create-edit', ['id' => $id]);
        $response_body = json_decode($response->getBody());
        $data = $response_body->data;

        return view('user_management.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/user-management/update/' . $id, $request->all());

        if ($response->ok()) {
            return redirect()->route('user-management.index')->with('success', "Data berhasil diperbarui.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::withToken(session('jwt_token'))->delete(env('API_URL') . 'api/user-management/delete/' . $id, []);

        if ($response->ok()) {
            return redirect()->back()->with('success', "Data berhasil dihapus.");
        }

        return redirect()->back()->with('error', "Internal server error.")->withInput();
    }
}
