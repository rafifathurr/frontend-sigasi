<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected string $menu_code;
    protected bool $can_create;
    protected bool $can_edit;
    protected bool $can_delete;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $data['menus'] = session('menus');
            $data['menu_code'] = $menu_code = $this->menu_code ?? null;

            $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/user');
            $response_body = json_decode($response->getBody(), true);

            if ($response->ok()) {
                $data['menus'] = $response_body['data']['menus'];
            }

            if (!is_null($menu_code)) {

                $filter_menus = array_filter(session('menus'), function ($row) use ($menu_code) {
                    return ($row['MenuCode'] ?? '') === $menu_code;
                });

                if (empty($filter_menus) && $menu_code != 'home') {
                    return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
                }

                $data['access'] = [
                    'can_create' => (!empty($filter_menus) && !empty(array_filter($filter_menus, function ($row) {
                        return $row['Method'] === 'POST';
                    }))),
                    'can_edit' => (!empty($filter_menus) && !empty(array_filter($filter_menus, function ($row) {
                        return $row['Method'] === 'PUT';
                    }))),
                    'can_delete' => (!empty($filter_menus) && !empty(array_filter($filter_menus, function ($row) {
                        return $row['Method'] === 'DELETE';
                    }))),
                ];
            }

            view()->share($data);

            return $next($request);
        });
    }
}
