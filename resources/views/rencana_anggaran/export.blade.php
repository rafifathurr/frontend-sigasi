<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Rencana Anggaran</title>
</head>

<body>

    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th colspan="14"
                    style="text-align:center;font-size:18px;font-weight:bold;height:35px;">
                    LAPORAN RENCANA ANGGARAN
                </th>
            </tr>

            <tr style="background:#D9EAD3;font-weight:bold;">
                <th align="center">No</th>
                <th align="center">Tanggal Rencana</th>
                <th align="center">Nilai Anggaran</th>
                <th align="center">Keterangan</th>
                <th align="center">Disusun Oleh</th>
                <th align="center">Tanggal Disusun</th>
                <th align="center">Diperbarui Oleh</th>
                <th align="center">Tanggal Diperbarui</th>
                <th align="center">Kebutuhan</th>
                <th align="center">Nama Barang</th>
                <th align="center">Jenis Barang</th>
                <th align="center">Harga Satuan</th>
                <th align="center">Jumlah</th>
                <th align="center">Total Harga</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($rencana_anggaran['data'] as $rencana)

                @php
                    $items = $rencana['rencana_anggaran_items'] ?? [];
                    $rowspan = max(count($items), 1);
                @endphp

                @if(count($items))

                    @foreach($items as $item)

                        <tr>

                            @if($loop->first)

                                <td rowspan="{{ $rowspan }}" align="center" valign="top">
                                    {{ $loop->parent->iteration }}
                                </td>

                                <td rowspan="{{ $rowspan }}" valign="top">
                                    {{ date('d F Y', strtotime($rencana['TanggalRencana'])) }}
                                </td>

                                <td rowspan="{{ $rowspan }}" align="right" valign="top">
                                    {{ 'Rp. ' . number_format($rencana['NilaiAnggaran'], 0, ',', '.') }}
                                </td>

                                <td rowspan="{{ $rowspan }}" valign="top">
                                    {{ $rencana['Keterangan'] }}
                                </td>

                                <td rowspan="{{ $rowspan }}" valign="top">
                                    {{ $rencana['created_by']['name'] ?? '-' }}
                                </td>

                                <td rowspan="{{ $rowspan }}" valign="top">
                                    {{ !empty($rencana['created_at']) ? date('d F Y H:i:s', strtotime($rencana['created_at'])) : '-' }}
                                </td>

                                <td rowspan="{{ $rowspan }}" valign="top">
                                    {{ $rencana['updated_by']['name'] ?? '-' }}
                                </td>

                                <td rowspan="{{ $rowspan }}" valign="top">
                                    {{ !empty($rencana['updated_at']) ? date('d F Y H:i:s', strtotime($rencana['updated_at'])) : '-' }}
                                </td>

                            @endif

                            <td>
                                {{ $item['kebutuhan']['JudulKebutuhan'] }}
                                - {{ $item['kebutuhan']['posko']['user']['name'] }}
                                - {{ date('d F Y', strtotime($item['kebutuhan']['TanggalKebutuhan'])) }}
                            </td>

                            <td>
                                {{ $item['barang']['NamaBarang'] ?? '-' }}
                            </td>

                            <td>
                                {{ $item['barang']['jenis_barang']['JenisBarang'] ?? '-' }}
                            </td>

                            <td align="right">
                                {{ 'Rp. ' . number_format($item['HargaSatuan'] ?? 0, 0, ',', '.') }}
                            </td>

                            <td align="right">
                                {{ number_format($item['Jumlah'] ?? 0, 0, ',', '.') }}
                            </td>

                            <td align="right">
                                {{ 'Rp. ' . number_format(($item['HargaSatuan'] ?? 0) * ($item['Jumlah'] ?? 0), 0, ',', '.') }}
                            </td>

                        </tr>

                    @endforeach

                @else

                    <tr>

                        <td align="center">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ date('d F Y', strtotime($rencana['TanggalRencana'])) }}
                        </td>

                        <td align="right">
                            {{ 'Rp. ' . number_format($rencana['NilaiAnggaran'], 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $rencana['Keterangan'] }}
                        </td>

                        <td>
                            {{ $rencana['created_by']['name'] ?? '-' }}
                        </td>

                        <td>
                            {{ !empty($rencana['created_at']) ? date('d F Y H:i:s', strtotime($rencana['created_at'])) : '-' }}
                        </td>

                        <td>
                            {{ $rencana['updated_by']['name'] ?? '-' }}
                        </td>

                        <td>
                            {{ !empty($rencana['updated_at']) ? date('d F Y H:i:s', strtotime($rencana['updated_at'])) : '-' }}
                        </td>

                        <td colspan="6" align="center">
                            Tidak ada item rencana anggaran
                        </td>

                    </tr>

                @endif

            @endforeach

        </tbody>

    </table>

</body>

</html>