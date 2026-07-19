<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class LogActivityController extends Controller
{
    public function __construct()
    {
        $this->menu_code = 'log-activity';
        parent::__construct();
        $this->middleware('auth.check');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/log-activity', ['all' => 1]);
            $response_body = json_decode($response->getBody(), true);

            return DataTables::of($response_body['data'])
                ->addIndexColumn()
                ->addColumn('created_at', function ($data) {
                    return date('d F Y H:i:s', strtotime($data['created_at']));
                })
                ->make(true);
        }

        $title = 'Daftar Log Activity';
        return view('log_activity.index', compact('title'));
    }
}
