<?php

namespace App\Exports\RencanaAnggaran;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RencanaAnggaranExport implements FromView, ShouldAutoSize
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('rencana_anggaran.export', [
            'rencana_anggaran' => $this->data
        ]);
    }
}
