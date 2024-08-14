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
    <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
            <td style="width:33%;font-size:10px;border-bottom:1px solid #000000;">TELEPON: (021) 52921621</td>
            <td style="width:33%;font-size:10px;text-align:center;border-bottom:1px solid #000000;">FAKSIMILE: (021) 52920190</td>
            <td style="width:34%;font-size:10px;text-align:right;border-bottom:1px solid #000000;">e-mail: sekretariat@den.go.id</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center;font-size:15px;font-weight:bold;padding-top:10px;">NOTA DINAS</td>
        </tr>
        <tr>
            <td></td>
            <td style="font-size:13px;">Nomor:</td>
            <td></td>
        </tr>
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
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:30%">Nama/NIP</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:10%">PKT/Gol</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:40%">Jabatan</td>
            <td style="border:1px solid #000000;text-align:center;font-weight:bold;font-size:12px;width:15%">Ket</td>
        </tr>
        @php $no=1; @endphp
        @foreach ($kegdetail as $kd)
        <tr>
            <td style="border:1px solid #000000;font-size:12px;">{{ $no }}</td>
            <td style="border:1px solid #000000;font-size:12px;">{{ $kd->namalengkap }}</td>
            <td style="border:1px solid #000000;font-size:12px;">{{ $kd->namalengkap }}</td>
            <td style="border:1px solid #000000;font-size:12px;">{{ $kd->jabatan }}</td>
            <td style="border:1px solid #000000;font-size:12px;"></td>
        </tr>
        @php $no++ @endphp
        @endforeach
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="1" width="100%">
        <tr>
            <td style="font-size:12px;border:0px !important;width:60%;"></td>
            <td style="font-size:12px;border:0px !important;width:40%;">Jakarta, {{ Gudangfungsi::tanggalindo(date('Y-m-d')) }}</td>
        </tr>
        <tr>
            <td style="font-size:12px;border:0px !important;" colspan="2">Mengetahui:</td>
        </tr>
        <tr>
           <td style="font-size:12px;border:0px !important;">{{ $pejabat->nama_biro }}</td> 
           <td style="font-size:12px;border:0px !important;">{{ $pejabat->nama_bagian }}</td> 
        </tr>
        <tr>
            <td colspan="2" style="height: 60px;"> &nbsp;</td>
        </tr>
        <tr>
            <td style="font-size:12px;border:0px !important;">{{ $pejabat->kabiro }}</td> 
            <td style="font-size:12px;border:0px !important;">{{ $pejabat->kabag }}</td> 
         </tr>
        <tr>
            <td style="font-size:12px;border:0px !important;">{{ $pejabat->kabironip }}</td> 
            <td style="font-size:12px;border:0px !important;">{{ $pejabat->kabagnip }}</td> 
         </tr>
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td style="border:1px solid #000000;font-size:12px;width:50%">
                Mengetahui/Menyetujui<br>
                Pejabat Pembuat Komitmen Setjen DEN
                <br><br><br><br><br>
                {{ $ppk->namalengkap }}<br>{{ $ppk->nip }}
            </td>
            <td style="border:1px solid #000000;font-size:12px;width:50%;vertical-align:top;">
                Catatan:
            </td>
        </tr>
    </table>
    
</body>
</html>
