<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class Gudangfungsi{

	public static function slug($kalimat){
        $slug_rm1 = str_replace(":", "", $kalimat);
        $slug_rm2 = str_replace("(", "", $slug_rm1);
        $slug_rm3 = str_replace(")", "", $slug_rm2);
        $slug_rm4 = str_replace(",", "", $slug_rm3);
        $slug_rm5 = str_replace("/", "", $slug_rm4);
        $slug_rm6 = str_replace("'", "", $slug_rm5);
        $slug = strtolower(str_replace(" ", "-", $slug_rm6));

        return $slug;
    }

    public static function getKegiatanDetail($kode_kegiatan){
        $data = DB::table('kegiatan_detail as kdet')
                ->join('narasumber as nar', 'kdet.id_narasumber', '=', 'nar.id_narasumber')
                ->where('kdet.kode_kegiatan', $kode_kegiatan);
        
        return $data;
    }

    public static function normalNumber($angka){
        return str_replace('.', '', $angka);
    }

    public static function getDataFromYoutube($youtubeid){
        $url = "https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$youtubeid&format=json";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($curl); 

        return json_decode($result, true);
	}

    public static function gantibarisTextarea($teks){
		return str_replace('<br>', '&#10;', $teks);
	}

	public static function gantibarisHtml($teks){
		return str_replace('&#10;', '<br>', $teks);
	}

	public static function formatrupiah($angka){
		if ($angka == 0 || $angka == '' || is_null($angka)){
			$hasil_rupiah = 0;
		}else{
			$hasil_rupiah = "Rp. " . number_format($angka,0,'','.');
		}

		return $hasil_rupiah;
	}

	public static function formatuang($angka){
		if ($angka == 0 || $angka == '' || is_null($angka)){
			$hasil_rupiah = 0;
		}else{
			$hasil_rupiah = number_format($angka,0,'','.');
		}
		
		return $hasil_rupiah;
	}

	public static function removethousandtag($number){
		return str_replace(',', '', $number);
	}

	public static function bulanindo($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		return $bulan[$str[1]];
	}

	public static function gettanggal($tanggal){
		$split_space = explode(' ', date("Y-m-j", strtotime($tanggal)));
		$str = explode('-', $split_space[0]);

		return $str[2];
	}

	public static function getbulan($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		return $str[1];
	}
	public static function gettahun($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		return $str[0];
	}
	public static function hitunghari($tanggal1, $tanggal2){
		$date1 = new DateTime($tanggal1);
		$date2 = new DateTime($tanggal2);

		$interval = $date1->diff($date2);

		return (int)$interval->format('%a')+1;
	}

	public static function goodtimeFormat($tanggal){
		$split_space = explode(' ', $tanggal);
		$tanggal = explode('-', $split_space[0]);
		$waktu = explode(':', $split_space[1]);

		$bulan = array(
			'01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'Mei', '06' => 'Jun',
			'07' => 'Jul', '08' => 'Agt', '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des',
		);

		return $tanggal[2].' '.$bulan[$tanggal[1]].' '.$tanggal[0].' - '.$waktu[0].':'.$waktu[1];
	}

	public static function tanggalindo($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		return $str[2].' '.$bulan[$str[1]].' '.$str[0];
	}

	public static function tanggalindo_hari($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$timestamp = strtotime($split_space[0]);
        $day = date('D', $timestamp);
		switch($day){
			case 'Sun': $hari = 'Minggu'; break;
			case 'Mon': $hari = 'Senin'; break;
			case 'Tue': $hari = 'Selasa'; break;
			case 'Wed': $hari = 'Rabu'; break;
			case 'Thu': $hari = 'Kamis'; break;
			case 'Fri': $hari = 'Jumat'; break;
			case 'Sat': $hari = 'Sabtu'; break;
		}

		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		return $hari.', '.$str[2].' '.$bulan[$str[1]].' '.$str[0];
	}

	public static function tanggalindo_harifull($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);
		$str2 = explode(':', $split_space[1]);

		$waktu = $str2[0].':'.$str2[1];

		$timestamp = strtotime($split_space[0]);
        $day = date('D', $timestamp);
		switch($day){
			case 'Sun': $hari = 'Minggu'; break;
			case 'Mon': $hari = 'Senin'; break;
			case 'Tue': $hari = 'Selasa'; break;
			case 'Wed': $hari = 'Rabu'; break;
			case 'Thu': $hari = 'Kamis'; break;
			case 'Fri': $hari = 'Jumat'; break;
			case 'Sat': $hari = 'Sabtu'; break;
		}

		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		return $hari.', '.$str[2].' '.$bulan[$str[1]].' '.$str[0].' '.$waktu.' WIB';
	}

	public static function tanggalindoshort($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$bulan = array(
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Agt',
			'09' => 'Sep',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
		);

		return $str[2].' '.$bulan[$str[1]].' '.$str[0];
	}

	public static function tanggalindoshort_full($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);
		$time = explode(':', $split_space[1]);

		$bulan = array(
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Agt',
			'09' => 'Sep',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
		);

		return $str[2].' '.$bulan[$str[1]].' '.$str[0].' - '.$time[0].':'.$time[1];
	}

	public static function tanggalsaja($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		return $str[2];
	}
	
	public static function bulansaja($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$bulan = array(
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Agt',
			'09' => 'Sep',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
		);

		return $bulan[$str[1]];
	}
	public static function tahunsaja($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		return $str[0];
	}
	public static function bulantahunsaja($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$bulan = array(
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Agt',
			'09' => 'Sep',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
		);

		return $bulan[$str[1]].' '.$str[0];
	}

	public static function waktusaja($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode(':', $split_space[1]);

		return $str[0].':'.$str[1];
	}

	public static function tanggalindorange($tanggal1, $tanggal2){
		$sp_tanggal1 = explode(' ', $tanggal1);
		$tgl1 = explode('-', $sp_tanggal1[0]);

		$sp_tanggal2 = explode(' ', $tanggal2);
		$tgl2 = explode('-', $sp_tanggal2[0]);

		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		if ($tgl1[1] == $tgl2[1]){
			if ($tgl1[2] == $tgl2[2]){
				$tanggalmu = $tgl1[2].' '.$bulan[$tgl1[1]].' '.$tgl1[0];
			}else{
				$tanggalmu = $tgl1[2].' - '.$tgl2[2].' '.$bulan[$tgl1[1]].' '.$tgl1[0];
			}
		}else{
			if ($tgl1[0] == $tgl2[0]){
				$tanggalmu = $tgl1[2].' '.$bulan[$tgl1[1]].' - '.$tgl2[2].' '.$bulan[$tgl2[1]].' '.$tgl2[0];
			}else{
				$tanggalmu = $tgl1[2].' '.$bulan[$tgl1[1]].' '.$tgl1[0].' - '.$tgl2[2].' '.$bulan[$tgl2[1]].' '.$tgl2[0];
			}
		}

		return $tanggalmu;
	}

	// From dd-mm-yyyy Format
	public static function datetime_mysqlformat($tanggal){
		$datetime_split = explode(' ', $tanggal);
		$tanggal = explode('-', $datetime_split[0]);
		$tgl_mysqlformat = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
		$waktu = $datetime_split[1];

		return $tgl_mysqlformat.' '.$waktu;
	}

	// From dd/mm/yyyy Format
	public static function datetime_mysqlformat_slash($tanggal){
		$tanggal = explode('/', $tanggal);
		$tgl_mysqlformat = $tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1];

		return $tgl_mysqlformat.' '.date('H:i:s');
	}
	// From mm/dd/yyyy Format
	public static function formtomysql($tanggal){
		$tanggal = explode('/', $tanggal);
		$tgl_mysqlformat = $tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1];

		return $tgl_mysqlformat;
	}

	public static function mmddyyyy_mysqlformat_slash($tanggal){
		$tanggal = explode('/', $tanggal);
		$tgl_mysqlformat = $tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1];

		return $tgl_mysqlformat;
	}

	// From MySQL (yyyy-mm-dd H:i:s) format to dd/mm/yyyy
	public static function date_mysqltoslash($tanggal){
		$datetime_exp = explode(' ', $tanggal);
		$tanggal = explode('-', $datetime_exp[0]);
		$tgl_slashformat = $tanggal[1]."/".$tanggal[2]."/".$tanggal[0];

		return $tgl_slashformat;
	}

	// From MySQL (yyyy-mm-dd H:i:s) format to dd/mm/yyyy h:i:s
	public static function datetime_mysqltoslash($tanggal){
		$datetime_exp = explode(' ', $tanggal);
		$tanggal = explode('-', $datetime_exp[0]);
		$tgl_slashformat = $tanggal[1]."/".$tanggal[2]."/".$tanggal[0].' '.$datetime_exp[1];

		return $tgl_slashformat;
	}

	public static function tanggalformulir($tanggal){
		$tanggal = explode('-', $tanggal);

		return $tanggal[1].'/'.$tanggal[2].'/'.$tanggal[0];
	}

	public static function tanggalmysql($tanggal){
		$getdate = explode(" ", $tanggal);

		return $getdate[0];
	}

}