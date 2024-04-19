<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $judulhalaman }}</title>

    <style type="text/css" media="all">
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0;
            background-color: #ffffff;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        /* @page {
            size: A4;
            margin: 0;
        } */

        /* @media print {
            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        } */

        * {
            box-sizing: border-box;
        }

        body {
            margin-top: 0px;
            font-family: "HelveticaNeue-CondensedBold", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        }
    </style>
</head>
<body>
    <center><p style="font-size: 12px;margin-bottom:0px;font-weight:bold;">MATRIK HONORARIUM NARASUMBER {{ $tahun }}</center>
    <br>
    
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td style="width:5%;text-align:center;font-size:12px;background-color:#cdcdcd;font-weight:bold;">NO</td>
            <td style="width:20%;text-align:center;font-size:12px;background-color:#cdcdcd;font-weight:bold;">KEGIATAN</td>
            <td style="width:10%;text-align:center;font-size:12px;background-color:#cdcdcd;font-weight:bold;">TANGGAL</td>
            <td style="width:10%;text-align:center;font-size:12px;background-color:#cdcdcd;font-weight:bold;">LOKASI</td>
            <td style="width:55%;text-align:center;font-size:12px;background-color:#cdcdcd;font-weight:bold;">NARASUMBER</td>
        </tr>

        @if ($kegiatan->count() == 0)
            <tr>
                <td style="font-size:12px;text-align:center;height:40px;" colspan="5">Tidak ada data yang ditemukan</td>
            </tr>
        @else
            @php
            $no = 1;
            @endphp
            @foreach ($kegiatan->get() as $keg)
            <tr>
                <td style="font-size:12px;text-align:center;mi-height:20px;">{{ $no }}</td>
                <td style="font-size:12px;">{{ $keg->nama_kegiatan }}</td>
                <td style="font-size:12px;">{{ Gudangfungsi::tanggalindo($keg->tanggal) }}</td>
                <td style="font-size:12px;">{{ $keg->tempat }}</td>
                <td style="font-size:12px;">
                    @php
                        $narsum = Gudangfungsi::getKegiatanDetail($keg->kode_kegiatan);
                    @endphp

                    @if ($narsum->count() == 0)
                        Narasumber not available
                    @else
                        <table width="100%" cellspacing="0">
                            <tr>
                                <td style="text-align:center;padding: 4px;width:5%;border:none;border:0px solid #cdcdcd;" colspan="2"></td>
                                <td style="background-color:#F1F1F1;text-align:center;padding: 4px;width:5%;border:none;border:1px solid #cdcdcd;font-weight:bold;">Honorarium (Rp)</td>
                                <td style="background-color:#F1F1F1;text-align:center;padding: 4px;width:5%;border:none;border:1px solid #cdcdcd;font-weight:bold;">SPPD (Rp)</td>
                                <td style="background-color:#F1F1F1;text-align:center;padding: 4px;width:5%;border:none;border:1px solid #cdcdcd;font-weight:bold;">Status</td>
                            </tr>
                        @foreach ($narsum->get() as $key => $dtnarsum)
                            @php
                                $warnaTransfer = ($dtnarsum->is_transfer == 'yes' ? 'btn-success' : 'btn-danger');
                                $warnaVerifikasi = ($dtnarsum->is_verified == 'yes' ? 'btn-success' : 'btn-danger');
                            @endphp
                            <tr>
                                <td style="background-color:#F1F1F1;padding: 4px;width:5%;border:none;border:1px solid #cdcdcd;">{{ $key+1 }}.</td>
                                <td style="background-color:#F1F1F1;padding: 4px;width:50%;border:none;border:1px solid #cdcdcd;">{{ $dtnarsum->namalengkap }}</td>
                                <td style="text-align:right;padding: 4px;width:50%;border:none;border:1px solid #cdcdcd;">{{ Gudangfungsi::formatuang($dtnarsum->jumlahhonor) }}</td>
                                <td style="text-align:right;padding: 4px;width:50%;border:none;border:1px solid #cdcdcd;">{{ Gudangfungsi::formatuang($dtnarsum->nominal_sppd) }}</td>
                                <td style="text-align:center;padding: 4px;width:50%;border:none;border:1px solid #cdcdcd;">{{ ($dtnarsum->is_transfer == 'yes' ? 'Ya' : 'Tidak') }}</td>
                            </tr>
                        @endforeach
                        </table>
                    @endif
                </td>
            </tr>
            @php
                $no++;
            @endphp
            @endforeach
        @endif
    </table>
</body>
</html>
