<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Riskihajar\Terbilang\Facades\Terbilang;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index(){
        $data['kegiatan'] = DB::table('kegiatan as keg')
                            ->join('users as us', 'keg.id_users', '=', 'us.id')
                            ->orderBy('keg.created_at', 'desc');

        return view('kegiatan.index', $data);
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Kegiatan';
        $data['kodekegiatan'] = Str::random(10);
        $data['formmode'] = 'addnew';
        // $data['kodekegiatan'] = 'UuIp7ei2fO';
        $data['mataanggaran'] = DB::table('mak')->where('tahun', '=', date('Y'))->orderBy('namakegiatan', 'asc')->get();

        return view('kegiatan.add', $data);
    }

    public function save(Request $req){
        $kodekegiatan = $req->post('kodekegiatan');
        $judulkegiatan = $req->post('judulkegiatan');
        $mataanggaran = $req->post('mataanggaran');
        $tanggal = Gudangfungsi::formtomysql($req->post('tanggal'));
        $tempat = $req->post('tempat');
        
        if ($req->hasFile('file_undangan')){
            $file = $req->file('file_undangan');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists('public/uploads/kegiatan/'.$kodekegiatan == $kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile}");
            }else{
                File::makeDirectory('public/uploads/kegiatan/'.$kodekegiatan);
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile}");
            }
        }else{
            $namafile = '';
        }

        $data = ['kode_kegiatan' => $kodekegiatan, 
                 'nama_kegiatan' => $judulkegiatan,
                 'id_mak' => $mataanggaran,
                 'tanggal' => $tanggal,
                 'tempat' => $tempat,
                 'file_undangan' => $namafile,
                 'id_users' => Session::get('sesUserID'),
                 'id_bagian' => Session::get('sesBagian'),
                 'created_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $simpan = DB::table('kegiatan')->insert($data);
            $datakegiatan = DB::table('kegiatan')->where('kode_kegiatan', $kodekegiatan)->first();

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Save successfully', 'data'=>$datakegiatan];
            }else{
                $response = ['result'=>'failed', 'message'=>'Save failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }
        
        return response()->json($response);
    }

    public function edit($kodekegiatan){
        $data['judulhalaman'] = 'Edit Kegiatan';
        $data['kodekegiatan'] = $kodekegiatan;
        $data['kegiatan'] = DB::table('kegiatan')->where('kode_kegiatan', $kodekegiatan)->first();
        $data['mataanggaran'] = DB::table('mak')->where('tahun', '=', date('Y'))->orderBy('namakegiatan', 'asc')->get();

        return view('kegiatan.edit', $data);
    }

    public function saveupdate(Request $req){
        $kodekegiatan = $req->post('kodekegiatan');
        $judulkegiatan = $req->post('judulkegiatan');
        $mataanggaran = $req->post('mataanggaran');
        $tanggal = Gudangfungsi::formtomysql($req->post('tanggal'));
        $tempat = $req->post('tempat');
        
        if ($req->hasFile('file_undangan')){
            $file = $req->file('file_undangan');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists('public/uploads/kegiatan/'.$kodekegiatan == $kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile}");
            }else{
                File::makeDirectory('public/uploads/kegiatan/'.$kodekegiatan);
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile}");
            }
            // $file->move("public/uploads/kegiatan", "{$namafile}");
        }else{
            $namafile = $req->post('file_undangancurrent');
        }

        $data = ['nama_kegiatan' => $judulkegiatan,
                 'id_mak' => $mataanggaran,
                 'tanggal' => $tanggal,
                 'tempat' => $tempat,
                 'file_undangan' => $namafile,
                 'id_users' => Session::get('sesUserID'),
                 'id_bagian' => Session::get('sesBagian'),
                 'updated_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $simpan = DB::table('kegiatan')->where('kode_kegiatan', $kodekegiatan)->update($data);
            $datakegiatan = DB::table('kegiatan')->where('kode_kegiatan', $kodekegiatan)->first();
            $file_undangan = $datakegiatan->file_undangan;
            if (File::exists("public/uploads/kegiatan/".$file_undangan) == true){
                File::delete("public/uploads/kegiatan/".$file_undangan);
            }

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Update data successfully', 'data'=>$datakegiatan];
            }else{
                $response = ['result'=>'failed', 'message'=>'Update data failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }
        
        return response()->json($response);
    }

    public function saveupdatedata(Request $req){
        $kodekegiatan = $req->post('kodekegiatan');
        $judulkegiatan = $req->post('judulkegiatan');
        $mataanggaran = $req->post('mataanggaran');
        $tanggal = Gudangfungsi::formtomysql($req->post('tanggal'));
        $tempat = $req->post('tempat');
        
        if ($req->hasFile('file_undangan')){
            $file = $req->file('file_undangan');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile_undangan = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile_undangan}");
            }else{
                File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);

                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile_undangan}");
            }
        }else{
            $namafile_undangan = $req->post('file_undangancurrent');
        }

        if ($req->hasFile('file_laporankegiatan')){
            $file = $req->file('file_laporankegiatan');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile_laporan = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile_laporan}");
            }else{
                File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);

                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile_laporan}");
            }
        }else{
            $namafile_laporan = $req->post('file_laporankegiatancurrent');
        }

        $data = ['nama_kegiatan' => $judulkegiatan,
                 'id_mak' => $mataanggaran,
                 'tanggal' => $tanggal,
                 'tempat' => $tempat,
                 'file_undangan' => $namafile_undangan,
                 'file_laporankegiatan' => $namafile_laporan,
                 'updated_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $datakegiatan = DB::table('kegiatan')->where('kode_kegiatan', $kodekegiatan)->first();
            $file_undangan = $datakegiatan->file_undangan;
            if (File::exists("public/uploads/kegiatan/".$file_undangan) == true){
                File::delete("public/uploads/kegiatan/".$file_undangan);
            }
            if (File::exists("public/uploads/kegiatan/".$datakegiatan->file_laporankegiatan) == true){
                File::delete("public/uploads/kegiatan/".$datakegiatan->file_laporankegiatan);
            }
            
            $simpan = DB::table('kegiatan')->where('kode_kegiatan', $kodekegiatan)->update($data);
            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Update data successfully', 'data'=>$datakegiatan];
            }else{
                $response = ['result'=>'failed', 'message'=>'Update data failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }
        
        return response()->json($response);
    }

    public function delete(Request $req){
        $id_kegiatan = $req->id;

        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();
        $kegDetailCount = DB::table('kegiatan_detail')->where('kode_kegiatan', $kegiatan->kode_kegiatan)->count();

        if ($kegDetailCount != 0){
            $hapusDetail = DB::table('kegiatan_detail')->where('kode_kegiatan', $kegiatan->kode_kegiatan)->delete();

            if ($hapusDetail){
                $hapusKegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->delete();

                if ($hapusKegiatan){
                    $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
                }else{
                    $response = ['result'=>'failed', 'message'=>'Deleting data failed'];
                }
            }else{
                $response = ['result'=>'failed', 'message'=>'Deleting data failed'];
            }
        }else{
            $hapusKegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->delete();

            if ($hapusKegiatan){
                $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
            }else{
                $response = ['result'=>'failed', 'message'=>'Deleting data failed'];
            }
        }

        return response()->json($response);
    }

    public function downloadFile(Request $req){
        $id_kegiatan = $req->id;
        $tipe = $req->tipe;
        $klm = $req->klm;

        $namafield = "file_".$klm;
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();

        if ($tipe == 'kegiatan'){
            $filepath = public_path('uploads/kegiatan/'.$kegiatan->kode_kegiatan.'/'.$kegiatan->$namafield);
            $namafile = $kegiatan->$namafield;
        }else{
            $kegdetail = DB::table('kegiatan_detail')->where('kode_kegiatan', $kegiatan->kode_kegiatan)->first();

            $filepath = public_path('uploads/kegiatan/'.$kegiatan->kode_kegiatan.'/'.$kegdetail->$namafield);
            $namafile = $kegdetail->$namafield;
        }

        if (File::exists('public/uploads/kegiatan/'.$kegiatan->kode_kegiatan.'/'.$namafile) == true){
            return response()->download($filepath);
        }else{
            abort(404);
        }
    }

    public function downloadst(){
        $filepath = public_path('uploads/surattugas/surat-tugas-narasumber.docx');

        return response()->download($filepath);
    }

    public function narsumadd(Request $req){
        $kodekegiatan = $req->get('kode');

        $data['judulhalaman'] = 'Tambah Narasumber';
        $data['kodekegiatan'] = $kodekegiatan;
        $data['narasumber'] = DB::table('narasumber')->orderBy('namalengkap', 'asc');

        return view('kegiatan.narsumadd', $data);
    }

    public function getnarsum(Request $req){
        $id_narsum = $req->id_narsum;

        $narsum = DB::table('narasumber as nr')
                  ->join('eselon as es', 'nr.id_eselon', '=', 'es.id_eselon')        
                  ->join('golongan as gol', 'nr.id_golongan', '=', 'gol.id_golongan')
                  ->where('id_narasumber', $id_narsum);

        if ($narsum->count() == 0){
            return json_encode(['status'=>'error', 'msg'=>'Data tidak ditemukan']);
        }else{
            return json_encode(['status'=>'sukses', 'msg'=>'Data ditemukan', 'data'=>$narsum->first()]);
        }
    }

    public function narsumlist(Request $req){
        $kodekegiatan = $req->post('kodekegiatan');

        $data = DB::table('kegiatan_detail as kd')
                    ->join('narasumber as nr', 'kd.id_narasumber', '=', 'nr.id_narasumber')
                    ->where('kd.kode_kegiatan', $kodekegiatan)
                    ->orderBy('kd.created_at', 'desc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namalengkap', function($row){
                return '<p class="pbody">'.$row->namalengkap.'</p>';
            })
            ->addColumn('jumlah_jam', function($row){
                return '<p class="pbody">'.$row->jumlah_jam.'</p>';
            })
            ->addColumn('honor_satujam', function($row){
                return '<p class="pbody">'.Gudangfungsi::formatrupiah($row->honor_satujam).'</p>';
            })
            ->addColumn('jumlahhonor', function($row){
                return '<p class="pbody">'.Gudangfungsi::formatrupiah($row->jumlahhonor).'</p>';
            })
            ->addColumn('pajakph', function($row){
                // return '<p class="pbody">'.$row->pph.'%</p>';
                return '<p class="pbody">'.$row->pph.'%<br>'.Gudangfungsi::formatrupiah($row->potongan_pph).'</p>';
            })
            ->addColumn('potongan_pph', function($row){
                return '<p class="pbody">'.Gudangfungsi::formatrupiah($row->potongan_pph).'</p>';
            })
            ->addColumn('jumlah_bayar', function($row){
                return '<p class="pbody">'.Gudangfungsi::formatrupiah($row->jumlah_bayar).'</p>';
            })
            ->addColumn('sppd', function($row){
                return '<p class="pbody">'.Gudangfungsi::formatrupiah($row->nominal_sppd).'</p>';
            })
            ->addColumn('kelengkapan', function($row){
                $warnaST = ($row->file_surattugas == '' ? 'danger' : 'success');
                
                return '<span class="right badge badge-'.$warnaST.'">Surat Tugas</span>';
            })
            ->addColumn('status', function($row){
                if ($row->is_transfer == 'yes'){
                    $warnatransfer = 'success';
                }else{
                    $warnatransfer = 'danger';
                }

                if ($row->is_verified == 'yes'){
                    $warnaverifikasi = 'success';
                }else{
                    $warnaverifikasi = 'danger';
                }

                if ($row->is_cair == 'yes'){
                    $warnacair = 'success';
                }else{
                    $warnacair = 'danger';
                }

                return '<span class="right badge badge-'.$warnatransfer.'">Transfer</span>&nbsp;<span class="right badge badge-'.$warnaverifikasi.'">Verified</span>&nbsp;<span class="right badge badge-'.$warnacair.'">Cair</span>';
            })
            ->addColumn('action', function($row){
                if (Session::get('sesLevel') == 'administrator' || Session::get('sesLevel') == 'operator'){
                    $actionBtn = '<button type="button" onclick="showEditFormNarsum(\''.$row->id_kegiatandetail.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_kegiatandetail.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                }else{
                    $actionBtn = '<button type="button" onclick="showEditFormNarsum(\''.$row->id_kegiatandetail.'\')" title="Lihat detail" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-check"></i>
                            </button>';
                }
                return $actionBtn;
            })
            ->rawColumns(['namalengkap', 'jumlah_jam', 'honor_satujam', 'jumlahhonor', 'pajakph', 'potongan_pph', 'jumlah_bayar', 'sppd', 'kelengkapan', 'status', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function narsumsave(Request $req){
        $kodekegiatan = $req->post('kodekegiatan');
        $narasumber = $req->post('narasumber');
        $jumlahjam = $req->post('jumlahjam');
        $honorperjam = Gudangfungsi::normalNumber($req->post('sbm'));
        $jumlahhonor = Gudangfungsi::normalNumber($req->post('jumlahhonor'));
        $pph = $req->post('pph');
        $jumlahpotongan = Gudangfungsi::normalNumber($req->post('jumlahpotongan'));
        $jumlahbayar = Gudangfungsi::normalNumber($req->post('jumlahbayar'));
        $perjadin = ($req->post('perjadin') == '' ? 'no' : $req->post('perjadin'));
        $nominalperjadin = $req->post('nominalperjadin');

        if ($req->hasFile('surattugas')){
            $file = $req->file('surattugas');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileSurattugas = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileSurattugas}");
            }else{
                File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);

                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileSurattugas}");
            }
        }else{
            $namafileSurattugas = '';
        }

        if ($req->hasFile('kwitansiperjadin')){
            $file = $req->file('kwitansiperjadin');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileKwitansiperjadin = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileKwitansiperjadin}");
            }else{
                File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);

                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileKwitansiperjadin}");
            }
        }else{
            $namafileKwitansiperjadin = '';
        }

        $data = [
                'id_narasumber' => $narasumber,
                'kode_kegiatan' => $kodekegiatan,
                'jumlah_jam' => $jumlahjam,
                'honor_satujam' => $honorperjam,
                'jumlahhonor' => $jumlahhonor,
                'pph' => $pph,
                'potongan_pph' => $jumlahpotongan,
                'jumlah_bayar' => $jumlahbayar,
                'file_surattugas' => $namafileSurattugas,
                'is_sppd' => $perjadin,
                'nominal_sppd' => $nominalperjadin,
                'file_kwitansi' => $namafileKwitansiperjadin,
                'created_at' => date('Y-m-d H:i:s')
                ];
        
        try{
            $cekNarsum = DB::table('kegiatan_detail')->where('id_narasumber', $narasumber)->where('kode_kegiatan', $kodekegiatan);
            if ($cekNarsum->count() == 0){
                $simpan = DB::table('kegiatan_detail')->insert($data);

                if ($simpan){
                    $response = ['result'=>'success', 'message'=>'Save successfully'];
                }else{
                    $response = ['result'=>'failed', 'message'=>'Save failed'];
                }
            }else{
                $response = ['result'=>'failed', 'message'=>'Narasumber sudah ada dalam daftar'];
            }            
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }

        return response()->json($response);
    }
    
    public function narsumedit(Request $req){
        $id_kegiatandetail = $req->get('id');
        $kodekegiatan = $req->get('kode');

        $data['kodekegiatan'] = $kodekegiatan;
        $data['judulhalaman'] = 'Edit Narasumber';
        $data['narasumber'] = DB::table('narasumber')->orderBy('namalengkap', 'asc');
        $data['kegdetail'] = DB::table('kegiatan_detail as det')
                             ->join('kegiatan as keg', 'keg.kode_kegiatan', '=', 'det.kode_kegiatan')
                             ->where('det.id_kegiatandetail', $id_kegiatandetail)->first();
        $data['goles'] = DB::table('golongan as gol')
                        ->join('narasumber as nr', 'gol.id_golongan', '=', 'nr.id_golongan')
                        ->join('eselon as es', 'es.id_eselon', '=', 'nr.id_eselon')
                        ->where('nr.id_narasumber', $data['kegdetail']->id_narasumber)->first();

        return view('kegiatan.narsumedit', $data);
    }

    public function narsumsaveupdate(Request $req){
        $id_kegiatandetail = $req->post('id_kegiatandetail');
        $kodekegiatan = $req->post('kodekegiatan');
        $jumlahjam = $req->post('jumlahjam');
        $jumlahhonor = Gudangfungsi::normalNumber($req->post('jumlahhonor'));
        $jumlahpotongan = Gudangfungsi::normalNumber($req->post('jumlahpotongan'));
        $jumlahbayar = Gudangfungsi::normalNumber($req->post('jumlahbayar'));
        $perjadin = ($req->post('perjadin') == '' ? 'no' : $req->post('perjadin'));
        $nominalperjadin = ($req->post('nominalperjadin') == '' ? '0' : Gudangfungsi::normalNumber($req->post('nominalperjadin')));
        $statustransfer = $req->post('statustransfer');
        $statuscair = $req->post('statuscair');
        $tanggaltransfer = Gudangfungsi::formtomysql($req->post('tanggaltransfer'));
        $nomorspm = $req->post('nomorspm');

        if ($req->hasFile('surattugas')){
            $file = $req->file('surattugas');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileSurattugas = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileSurattugas}");
            }else{
                File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);

                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileSurattugas}");
            }
        }else{
            $namafileSurattugas = $req->post('surattugas_current');
        }

        if ($req->hasFile('kwitansiperjadin')){
            $file = $req->file('kwitansiperjadin');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileKwitansiperjadin = $namafileOri.'_'.time().'.'.$ekstensi;

            if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileKwitansiperjadin}");
            }else{
                File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);
                $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafileKwitansiperjadin}");
            }
        }else{
            $namafileKwitansiperjadin = $req->post('kwitansiperjadin_current');
        }

        if ($req->hasFile('buktitransfer')){
            $allowedfileExtension=['png','jpg','jpeg','gif'];
            $file = $req->file('buktitransfer');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile_buktitransfer = $namafileOri.'_'.time().'.'.$ekstensi;
            $check=in_array($ekstensi, $allowedfileExtension);
            
            if ($check){
                if (File::exists("public/uploads/kegiatan/".$kodekegiatan)){
                    $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile_buktitransfer}");
                }else{
                    File::exists("public/uploads/kegiatan/".$kodekegiatan);

                    $file->move("public/uploads/kegiatan/".$kodekegiatan."/", "{$namafile_buktitransfer}");
                }
            }else{
                $response = ['result'=>'failed', 'message'=>'Tipe file harus image (png/jpg/jpeg/gif)'];
                return response()->json($response);
                exit();
            }
        }else{
            $namafile_buktitransfer = $req->post('buktitransfer_current');
        }

        $data = [
                'jumlah_jam' => $jumlahjam,
                'jumlahhonor' => $jumlahhonor,
                'potongan_pph' => $jumlahpotongan,
                'jumlah_bayar' => $jumlahbayar,
                'file_surattugas' => $namafileSurattugas,
                'is_sppd' => $perjadin,
                'nominal_sppd' => $nominalperjadin,
                'file_kwitansi' => $namafileKwitansiperjadin,
                'is_transfer' => $statustransfer,
                'is_cair' => $statuscair,
                'tanggal_transfer' => $tanggaltransfer,
                'no_spm' => $nomorspm,
                'file_transfer' => $namafile_buktitransfer,
                'updated_at' => date('Y-m-d H:i:s')
                ];
        
        try{
            $simpan = DB::table('kegiatan_detail')->where('id_kegiatandetail', $id_kegiatandetail)->update($data);

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Save successfully'];
            }else{
                $response = ['result'=>'failed', 'message'=>'Save failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }

        return response()->json($response);
    }

    public function narsumdelete(Request $req){
        $id_kegiatandetail = $req->post('id');

        $data = DB::table('kegiatan_detail')->where('id_kegiatandetail', $id_kegiatandetail);
        if ($data->count() != 0){
            $file_surattugas = $data->first()->file_surattugas;
            $file_kwitansi = $data->first()->file_kwitansi;
            $file_transfer = $data->first()->file_transfer;

            if (File::exists("public/uploads/kegiatan/".$file_surattugas) == true){
                File::delete("public/uploads/kegiatan/".$file_surattugas);
            }
            if (File::exists("public/uploads/kegiatan/".$file_kwitansi) == true){
                File::delete("public/uploads/kegiatan/".$file_kwitansi);
            }
            if (File::exists("public/uploads/kegiatan/".$file_transfer) == true){
                File::delete("public/uploads/kegiatan/".$file_transfer);
            }
        }

        $hapus = DB::table('kegiatan_detail')->where('id_kegiatandetail', $id_kegiatandetail)->delete();
        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

    public function verifikasi(){
        $data['kegiatan'] = DB::table('kegiatan')->orderBy('created_at', 'desc');

        return view('kegiatan.verifikasi', $data);
    }

    public function verifikasilihat($kodekegiatan){
        $data['judulhalaman'] = 'Verifikasi Kegiatan';
        $data['kodekegiatan'] = $kodekegiatan;
        $data['kegiatan'] = DB::table('kegiatan as keg')
                            ->join('mak as ma', 'keg.id_mak', '=', 'ma.id_mak')
                            ->where('keg.kode_kegiatan', $kodekegiatan)->first();

        return view('kegiatan.verifikasilihat', $data);
    }

    public function verifikasidetail(Request $req){
        $id_kegiatandetail = $req->get('id');

        $data['judulhalaman'] = 'Rincian Detail Narasumber';
        $data['kegdetail'] = DB::table('kegiatan_detail as kd')
                            ->join('narasumber as nr', 'kd.id_narasumber', '=', 'nr.id_narasumber')
                            ->join('golongan as gol', 'nr.id_golongan', '=', 'gol.id_golongan')
                            ->join('eselon as es', 'nr.id_eselon', '=', 'es.id_eselon')
                            ->where('kd.id_kegiatandetail', $id_kegiatandetail)
                            ->orderBy('kd.created_at', 'desc')->first();

        return view('kegiatan.verifikasidetail', $data);
    }

    public function lihatbuktitransfer(Request $req){
        $kegdetail = DB::table('kegiatan_detail')->where('id_kegiatandetail', $req->get('id'))->first();

        $data['file_transfer'] = $kegdetail->file_transfer;
        return view('kegiatan.lihatbuktitransfer', $data);
    }

    public function verifikasibayar_save(Request $req){
        $id_kegiatandetail = $req->post('id_kegiatandetail');
        $is_verified = $req->post('is_verified');
        $verified_comment = $req->post('verified_comment');
        

        $data = ['is_verified' => $is_verified,
                 'verified_comment' => $verified_comment,
                 'updated_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $simpan = DB::table('kegiatan_detail')->where('id_kegiatandetail', $id_kegiatandetail)->update($data);

            if ($simpan){
                $response = ['result'=>'success', 'message'=>'Update data successfully'];
            }else{
                $response = ['result'=>'failed', 'message'=>'Update data failed'];
            }
        }catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062){
                $response = ['result'=>'failed', 'message'=>'Duplicate key found.']; 
            }
        }
        
        return response()->json($response);
    }

    // public function cetakkwitansi(Request $req){
    public function cetakkwitansi($id_kegiatan){
        // $id_kegiatan = $req->get('id');

        $data['judulhalaman'] = 'Kwitansi Honor Narsum';
        $data['kegiatan'] = DB::table('kegiatan as keg')
                            ->join('mak as ma', 'keg.id_mak', '=', 'ma.id_mak')
                            ->where('keg.id_kegiatan', $id_kegiatan)->first();
        $data['kegdetail'] = DB::table('kegiatan_detail as det')
                             ->join('narasumber as nar', 'det.id_narasumber', '=', 'nar.id_narasumber')
                             ->where('det.kode_kegiatan', $data['kegiatan']->kode_kegiatan)->get();
        $data['sumnominal'] = DB::table('kegiatan_detail')
                                 ->select(DB::raw('SUM(jumlahhonor) AS jumlah_honor, SUM(potongan_pph) AS jumlah_potongan, SUM(jumlah_bayar) AS jumlah_dibayar'))
                                 ->where('kode_kegiatan', $data['kegiatan']->kode_kegiatan)->first();
        $data['ppk'] = DB::table('ppk')->where('tahun', date('Y'))->first();
        $data['bendahara'] = DB::table('bendahara')->where('tahun', date('Y'))->first();
        $kodekegiatan = $data['kegiatan']->kode_kegiatan;

        $pdf = PDF::loadView('kegiatan/cetakkwitansi', $data)->setPaper('a4', 'landscape');

        // return $pdf->stream('kwitansi-narsum.pdf');  //Jika ingin menampilkan pdf ke satu halaman
        if (File::exists('public/uploads/kegiatan/'.$kodekegiatan)){
            $pdf->save('public/uploads/kegiatan/'.$kodekegiatan.'/'.$kodekegiatan.'-kwitansinarsum.pdf');    
        }else{
            File::makeDirectory('public/uploads/kegiatan/'.$kodekegiatan);
            $pdf->save('public/uploads/kegiatan/'.$kodekegiatan.'/'.$kodekegiatan.'-kwitansinarsum.pdf');
        }
        
        $dataUpdate = ['file_kwitansinarsum' => $kodekegiatan.'-kwitansinarsum.pdf'];
        DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->update($dataUpdate);
    }

    // public function cetakusulan(Request $req){
    public function cetakusulan($id_kegiatan){
        // $id_kegiatan = $req->get('id');

        $data['judulhalaman'] = 'Usulan Narasumber';
        $data['kegiatan'] = DB::table('kegiatan as keg')
                            ->join('mak as ma', 'keg.id_mak', '=', 'ma.id_mak')
                            ->where('keg.id_kegiatan', $id_kegiatan)->first();
        $data['kegdetail'] = DB::table('kegiatan_detail as det')
                             ->join('narasumber as nar', 'det.id_narasumber', '=', 'nar.id_narasumber')
                             ->join('golongan as gol', 'nar.id_golongan', '=', 'gol.id_golongan')
                             ->where('det.kode_kegiatan', $data['kegiatan']->kode_kegiatan)->get();
        $data['sumnominal'] = DB::table('kegiatan_detail')
                                 ->select(DB::raw('SUM(jumlahhonor) AS jumlah_honor, SUM(potongan_pph) AS jumlah_potongan, SUM(jumlah_bayar) AS jumlah_dibayar'))
                                 ->where('kode_kegiatan', $data['kegiatan']->kode_kegiatan)->first();
        $data['pejabat'] = DB::table('users as us')
                            ->select('bg.nama_pejabat as kabag', 'bg.nip as kabagnip', 'nama_bagian', 'nama_biro', 'br.nama_pejabat as kabiro', 'br.nip as kabironip')
                            ->join('bagian as bg', 'us.id_bagian', '=', 'bg.id_bagian')
                            ->join('biro as br', 'br.id_biro', '=', 'bg.id_biro')
                            ->where('us.id_bagian', $data['kegiatan']->id_bagian)->first();
        $data['ppk'] = DB::table('ppk')->where('tahun', date('Y'))->first();
        $data['bendahara'] = DB::table('bendahara')->where('tahun', date('Y'))->first();
        $kodekegiatan = $data['kegiatan']->kode_kegiatan;

        $pdf = PDF::loadView('kegiatan/cetakusulan', $data)->setPaper('a4');

        // return $pdf->stream('usulan-narsum.pdf');
        if (File::exists('public/uploads/kegiatan/'.$kodekegiatan)){
            $pdf->save('public/uploads/kegiatan/'.$kodekegiatan.'/'.$kodekegiatan.'-usulannarsum.pdf');
        }else{
            File::makeDirectory('public/uploads/kegiatan/'.$kodekegiatan);
            $pdf->save('public/uploads/kegiatan/'.$kodekegiatan.'/'.$kodekegiatan.'-usulannarsum.pdf');
        }
        
        $dataUpdate = ['file_usulannarsum' => $kodekegiatan.'-usulannarsum.pdf'];
        DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->update($dataUpdate);
    }

    public function cari(Request $req){
        $strtanggal = (string)$req->post('tanggal');
        $tanggal = explode(' - ', $strtanggal);
        $tanggal_awal = Gudangfungsi::formtomysql($tanggal[0]);
        $tanggal_akhir = Gudangfungsi::formtomysql($tanggal[1]);

        $data['judulhalaman'] = 'Hasil pencarian';
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['kegiatan'] = DB::table('kegiatan')
                    ->where('tanggal', '>=', $tanggal_awal)
                    ->where('tanggal', '<=', $tanggal_akhir)
                    ->orderBy('created_at', 'desc');
        
        return view('kegiatan.cari', $data);
    }

    public function cetakmatrik(){
        $tahun_sekarang = date('Y');

        $data['judulhalaman'] = 'Matrik Narasumber '.$tahun_sekarang;
        $data['tahun'] = $tahun_sekarang;
        $data['kegiatan'] = DB::table('kegiatan')
                            ->where(DB::raw('YEAR(tanggal)'), '=', $tahun_sekarang)
                            ->orderBy('created_at', 'asc');

        $pdf = PDF::loadView('kegiatan/cetakmatrik', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('matrik-narsum-'.$tahun_sekarang.'.pdf');
    }

    public function cetakmatriks(Request $req){
        $tanggal_awal = $req->get('aw');
        $tanggal_akhir = $req->get('ak');

        $data['judulhalaman'] = 'Matrik Narasumber';
        $data['tanggal'] = Gudangfungsi::tanggalindorange($tanggal_awal, $tanggal_akhir);

        $data['kegiatan'] = DB::table('kegiatan')
                            ->where('tanggal', '>=', $tanggal_awal)
                            ->where('tanggal', '<=', $tanggal_akhir)
                            ->orderBy('created_at', 'asc');

        $pdf = PDF::loadView('kegiatan/cetakmatriks', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('matriks-narsum.pdf');
    }

    public function cetakdokumen(Request $req){
        $id_kegiatan = $req->get('id');
		
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();
        $kodeKegiatan = $kegiatan->kode_kegiatan;
        $kegiatanDetail = DB::table('kegiatan_detail')->where('kode_kegiatan', $kodeKegiatan)->get();
		
		$dirName = $kegiatan->kode_kegiatan;
		$filePath = 'https://sinara.den.go.id/public/uploads/kegiatan/'.$dirName.'/';
		$filePathNarsum = 'https://sinara.den.go.id/public/uploads/narasumber/';

		if ($kegiatan->file_undangan != ''){
			$file_undangan = $filePath.$kegiatan->file_undangan;
			$daftarFile[] = $file_undangan;
		}
		if ($kegiatan->file_laporankegiatan != ''){
			$file_laporankegiatan = $filePath.$kegiatan->file_laporankegiatan;
			$daftarFile[] = $file_laporankegiatan;
		}
		if ($kegiatan->file_usulannarsum != ''){
			$file_usulannarsum = $filePath.$kegiatan->file_usulannarsum;
			$daftarFile[] = $file_usulannarsum;
		}
		if ($kegiatan->file_kwitansinarsum != ''){
			$file_kwitansinarsum = $filePath.$kegiatan->file_kwitansinarsum;
			$daftarFile[] = $file_kwitansinarsum;
		}

        foreach ($kegiatanDetail as $kegDet){
			if ($kegDet->file_surattugas != ''){
				$daftarFile[] = $filePath.$kegDet->file_surattugas;
			}

            $narasumber = DB::table('narasumber')->where('id_narasumber', $kegDet->id_narasumber)->first();
			
			if ($narasumber->file_npwp != ''){
				$daftarFile[] = $filePathNarsum.$narasumber->file_npwp;
			}
        }

        if ($kegiatan->file_compiledoc == ''){
            //******** MERGE DOCUMENTS BEGIN WITH pdf.co 
            $apiKey = 'indra_adv@yahoo.com_8MJymy4edgCFTV4sBHhCYkuU909JZyVyaHCQNINEJXqPxyXgXCU0SP2IzXtqkVNQ';
            
            // Create URL
            $url = "https://api.pdf.co/v1/pdf/merge2";
            
            // Prepare requests params
            $parameters = array();
            $parameters["name"] = "result.pdf";
            $parameters["url"] = join(",", $daftarFile);

            // Create Json payload
            $data = json_encode($parameters);

            // Create request
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            // Execute request
            $result = curl_exec($curl);
            
            if (curl_errno($curl) == 0){
                $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                
                if ($status_code == 200){
                    $json = json_decode($result, true);
                    
                    if (!isset($json["error"]) || $json["error"] == false){
                        $resultFileUrl = $json["url"];
                        
                        // Display link to the result document
                        //echo "<div><h2>Merge Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                        $dataUpdateFileDoc = ['file_compiledoc' => $resultFileUrl];
                        DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->update($dataUpdateFileDoc);
                        echo "<script>window.open('".$resultFileUrl."', '_blank')</script>";
                    }else{
                        // Display service reported error
                        echo "<p>Error: " . $json["message"] . "</p>"; 
                    }
                }else{
                    // Display request error
                    echo "<p>Status code: " . $status_code . "</p>"; 
                    echo "<p>" . $result . "</p>"; 
                }
            }else{
                // Display CURL error
                echo "Error: " . curl_error($curl);
            }
            
            // Cleanup
            curl_close($curl);
        }else{
            echo "<script>window.open('".$kegiatan->file_compiledoc."', '_blank')</script>";
        }
    }

    public function mergeDocs($uploadedFiles){
        $apiKey = 'indra_adv@yahoo.com_8MJymy4edgCFTV4sBHhCYkuU909JZyVyaHCQNINEJXqPxyXgXCU0SP2IzXtqkVNQ';
        
        // Create URL
        $url = "https://api.pdf.co/v1/pdf/merge2";
        
        // Prepare requests params
        $parameters = array();
        $parameters["name"] = "result.pdf";
        $parameters["url"] = join(",", $uploadedFiles);

        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);
        
        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200){
                $json = json_decode($result, true);
                
                if (!isset($json["error"]) || $json["error"] == false){
                    $resultFileUrl = $json["url"];
                    
                    // Display link to the result document
                    echo "<div><h2>Merge Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                }else{
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }else{
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>"; 
            }
        }else{
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
        
        // Cleanup
        curl_close($curl);
    }

    // public function hasilcari(Request $req){
    //     $strtanggal = (string)$req->post('tanggal');
    //     $tanggal = explode(' - ', $strtanggal);
    //     $tanggal_mulai = Gudangfungsi::formtomysql($tanggal[0]);
    //     $tanggal_akhir = Gudangfungsi::formtomysql($tanggal[1]);

    //     $data['judulhalaman'] = 'Hasil pencarian';
    //     $data['kegiatan'] = DB::table('kegiatan')
    //                 ->where('tanggal', '>=', $tanggal_mulai)
    //                 ->where('tanggal', '<=', $tanggal_akhir)
    //                 ->orderBy('created_at', 'desc');
        
    //     return view('kegiatan.cari', $data);
    // }

}
