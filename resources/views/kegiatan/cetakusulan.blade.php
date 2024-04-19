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
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td style="width:20%;text-align:center;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/lte/dist/img/logo_den.png'))) }}" width="100px">
            </td>
            <td style="width:70%;text-align: center">
                <span style="font-size:22px;font-weight:bold;">DEWAN ENERGI NASIONAL</span><br>
                <span style="font-size:19px;font-weight:bold;">SEKRETARIAT JENDERAL</span><br><br>
                <span style="font-size:13px;">JALAN JENDERAL GATOT SUBROTO KAV. 49 JAKARTA 12950</span><br><br>
            </td>
            <td style="width:10%"></td>
        </tr>
    </table>
    <table border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td style="width:33%;font-size:10px;border-bottom:1px solid #000000;">TELEPON: (021) 52921621</td>
            <td style="width:33%;font-size:10px;text-align:center;border-bottom:1px solid #000000;">FAKSIMILE: (021) 52920190</td>
            <td style="width:34%;font-size:10px;text-align:right;border-bottom:1px solid #000000;">e-mail: sekretariat@den.go.id</td>
        </tr>
        <td colspan="3" style="text-align: center;font-size:15px;font-weight:bold;padding-top:10px;">NOTA DINAS</td>
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td style="font-size:12px;width:20%">Program</td>
            <td style="font-size:12px;width:5%;text-align:center;">:</td>
            <td style="font-size:12px;width:75%">{{ $kegiatan->namakegiatan }}</td>
        </tr>
        <tr>
            <td style="font-size:12px;width:20%">Mata Anggaran</td>
            <td style="font-size:12px;width:5%">:</td>
            <td style="font-size:12px;width:75%">{{ $kegiatan->kodemak }}</td>
        </tr>
        <tr>
            <td style="font-size:12px;width:20%">Kegiatan</td>
            <td style="font-size:12px;width:5%">:</td>
            <td style="font-size:12px;width:75%">{{ $kegiatan->nama_kegiatan }}</td>
        </tr>
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td style="font-size:12px;border:0px !important;" colspan="5">Daftar narasumber:</td>
        </tr>
        <tr>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:5%">No</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:25%">Nama/NIP</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:10%">PKT/Gol</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:45%">Jabatan</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:15%">Ket</td>
        </tr>
        @php $no=1; @endphp
        @foreach ($kegdetail as $kd)
        <tr>
            <td style="border:1px solid #000000;font-size:12px;">{{ $no }}</td>
            <td style="border:1px solid #000000;font-size:12px;">{{ $kd->namalengkap }}</td>
            <td style="border:1px solid #000000;font-size:12px;"></td>
            <td style="border:1px solid #000000;font-size:12px;">{{ $kd->jabatan }}</td>
            <td style="border:1px solid #000000;font-size:12px;"></td>
        </tr>
        @php $no++ @endphp
        @endforeach
    </table>



    {{-- <center><p style="font-size: 12px;margin-bottom:0px;font-weight:bold;">DAFTAR__ PEMBARAYAN NARASUMBER/PAKAR/PEMBICARA KHUSUS</center>
    <p style="font-size: 12px;font-weight:bold;margin-bottom:0px;">KEGIATAN : {{ $kegiatan->nama_kegiatan }}</p>
    <p style="font-size: 12px;font-weight:bold;margin-bottom:0px;margin-top:4px;">M A : {{ $kegiatan->kodemak }}</p>
    <p style="font-size: 12px;margin-bottom:10px;margin-top:15px;">TANGGAL RAPAT : {{ Gudangfungsi::tanggalindo($kegiatan->tanggal) }}</p> --}}
    
    {{-- <table border="1" cellspacing="0" cellpadding="5" width="100%">
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
            <td style="font-size:12px;text-align:center;" colspan="9">Terbilang: {{ Terbilang::make($sumnominal->jumlah_honor, 'rupiah') }}</td>
        </tr>
    </table>    

    <table border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr><td colspan="9" style="height: 15px;"></td></tr>
        <tr>
            <td style="width:4%;text-align:center;font-size:12px;"></td>
            <td style="width:57%;text-align:left;font-size:12px;line-height:16px;" colspan="5">
                Mengetahui/Menyetujui<br>
                Pejabat Pembuat Komitmen
                <br><br><br><br>
                {{ $ppk->namalengkap }}<br>
                {{ $ppk->nip }}
            </td>
            <td style="width:39%;text-align:left;font-size:12px;line-height:16px;" colspan="3">
                Jakarta,<br>
                Bendahara Pengeluaran
                <br><br><br><br>
                {{ $bendahara->namalengkap }}<br>
                {{ $bendahara->nip }}
            </td>
        </tr>
    </table> --}}

    
</body>
</html>
