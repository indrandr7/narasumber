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
    {{-- <h5><center>Daftar Pengajuan Pembayaran Narasumber dan Moderator</center></h5> --}}
    <center><p style="font-size: 12px;margin-bottom:0px;font-weight:bold;">Daftar Pengajuan Pembayaran Narasumber dan Moderator</center>
    <center><p style="font-size: 12px;font-weight:bold;margin-bottom:0px;">{{ $kegiatan->nama_kegiatan }}</p></center>
    <center><p style="font-size: 12px;margin-bottom:0px;margin-top:4px;;">{{ Gudangfungsi::tanggalindo($kegiatan->tanggal) }}</p></center>
    <center><p style="font-size: 12px;margin-bottom:15px;margin-top:4px;">MAK : {{ $kegiatan->kodemak }}</p></center>
    
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td style="width:4%;text-align:center;font-size:12px;" rowspan="2">NO</td>
            <td style="width:20%;text-align:center;font-size:12px;" rowspan="2">NAMA</td>
            <td style="width:10%;text-align:center;font-size:12px;" rowspan="2">UNDANGAN</td>
            <td style="width:12%;text-align:center;font-size:12px;" rowspan="2">HONOARIUM 1 (SATU) JAM<br>(Rp)</td>
            <td style="text-align:center;font-size:12px;" colspan="2">HONORARIUM YANG DIBAYARKAN</td>
            <td style="width:12%;text-align:center;font-size:12px;" rowspan="2">POTONGAN PPH Ps 21<br>(Rp)</td>
            <td style="width:12%;text-align:center;font-size:12px;" rowspan="2">JUMLAH YANG DIBAYARKAN<br>(Rp)</td>
            <td style="width:15%;text-align:center;font-size:12px;" rowspan="2">TANDA TANGAN</td>
        </tr>
        <tr>
            <td style="width:5%;text-align:center;font-size:12px;">@ JAM</td>
            <td style="width:10%;text-align:center;font-size:12px;">(Rp)</td>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($kegdetail as $kd)
        <tr>
            <td style="font-size:12px;text-align:center;height:40px;">{{ $no }}</td>
            <td style="font-size:12px;">{{ $kd->namalengkap }}</td>
            <td style="font-size:12px;text-align:center;">Narasumber</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($kd->honor_satujam) }}</td>
            <td style="font-size:12px;text-align:center;">{{ $kd->jumlah_jam }}</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($kd->jumlahhonor) }}</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($kd->potongan_pph) }}</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($kd->jumlah_bayar) }}</td>
            <td style="font-size:12px;">&nbsp;</td>
        </tr>
        @php
            $no++;
        @endphp
        @endforeach

        <tr>
            <td style="font-size:12px;text-align:center;" colspan="5">JUMLAH</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($sumnominal->jumlah_honor) }}</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($sumnominal->jumlah_potongan) }}</td>
            <td style="font-size:12px;text-align:right;">{{ Gudangfungsi::formatuang($sumnominal->jumlah_dibayar) }}</td>
            <td></td>
        </tr>
        <tr>
            @php
                Config::set('terbilang.locale', 'id');
            @endphp
            <td style="font-size:12px;text-align:center;" colspan="9">
                Terbilang: 
                @if ($sumnominal->jumlah_honor != 0 || $sumnominal->jumlah_honor != '')
                    {{ Terbilang::make($sumnominal->jumlah_honor, 'rupiah') }}
                @endif
            </td>
        </tr>
    </table>    

    <table border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr><td colspan="9" style="height: 15px;"></td></tr>
        {{-- <tr>
            <td style="width: 57%;" colspan="6"></td>
            <td style="width:39%;font-size:12px;" colspan="3">Jakarta, {{ Gudangfungsi::tanggalindo($kegiatan->tanggal) }}</td>
        </tr> --}}
        <tr>
            <td style="width:4%;text-align:center;font-size:12px;"></td>
            <td style="width:57%;text-align:left;font-size:12px;line-height:16px;" colspan="5">
                Mengetahui/Menyetujui<br>
                Pejabat Pembuat Komitmen
                <br><br><br><br>
                {{ $ppk->namalengkap }}<br>
                NIP. {{ $ppk->nip }}
            </td>
            <td style="width:39%;text-align:left;font-size:12px;line-height:16px;" colspan="3">
                Jakarta,<br>
                Bendahara Pengeluaran
                <br><br><br><br>
                {{ $bendahara->namalengkap }}<br>
                NIP. {{ $bendahara->nip }}
            </td>
        </tr>
    </table>

    
</body>
</html>
