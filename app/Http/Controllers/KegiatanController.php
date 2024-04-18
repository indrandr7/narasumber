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
use Barryvdh\DomPDF\Facade\PDF;
use Riskihajar\Terbilang\Facades\Terbilang;

class KegiatanController extends Controller
{
    public function index(){
        $data['kegiatan'] = DB::table('kegiatan')->orderBy('created_at', 'desc');

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

            $file->move("public/uploads/kegiatan", "{$namafile}");
        }else{
            $namafile = '';
        }

        $data = ['kode_kegiatan' => $kodekegiatan, 
                 'nama_kegiatan' => $judulkegiatan,
                 'id_mak' => $mataanggaran,
                 'tanggal' => $tanggal,
                 'tempat' => $tempat,
                 'file_undangan' => $namafile,
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

            $file->move("public/uploads/kegiatan", "{$namafile}");
        }else{
            $namafile = $req->post('file_undangancurrent');
        }

        $data = ['nama_kegiatan' => $judulkegiatan,
                 'id_mak' => $mataanggaran,
                 'tanggal' => $tanggal,
                 'tempat' => $tempat,
                 'file_undangan' => $namafile,
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

            $file->move("public/uploads/kegiatan", "{$namafile_undangan}");
        }else{
            $namafile_undangan = $req->post('file_undangancurrent');
        }

        if ($req->hasFile('file_laporankegiatan')){
            $file = $req->file('file_laporankegiatan');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile_laporan = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/kegiatan", "{$namafile_laporan}");
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
                return $row->namalengkap;
            })
            ->addColumn('jumlah_jam', function($row){
                return $row->jumlah_jam;
            })
            ->addColumn('honor_satujam', function($row){
                return Gudangfungsi::formatrupiah($row->honor_satujam);
            })
            ->addColumn('jumlahhonor', function($row){
                return Gudangfungsi::formatrupiah($row->jumlahhonor);
            })
            ->addColumn('pph', function($row){
                return $row->pph.'%';
            })
            ->addColumn('potongan_pph', function($row){
                return Gudangfungsi::formatrupiah($row->potongan_pph);
            })
            ->addColumn('jumlah_bayar', function($row){
                return Gudangfungsi::formatrupiah($row->jumlah_bayar);
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

                return '<span class="right badge badge-'.$warnatransfer.'">Transfer</span>&nbsp;<span class="right badge badge-'.$warnaverifikasi.'">Verified</span>';
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
                    $actionBtn = '<button type="button" onclick="showEditFormNarsum(\''.$row->id_kegiatandetail.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>';
                }
                return $actionBtn;
            })
            ->rawColumns(['namalengkap', 'jumlah_jam', 'honor_satujam', 'jumlahhonor', 'potongan_pph', 'jumlah_bayar', 'status', 'action'])
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

            $file->move("public/uploads/kegiatan", "{$namafileSurattugas}");
        }else{
            $namafileSurattugas = '';
        }

        if ($req->hasFile('kwitansiperjadin')){
            $file = $req->file('kwitansiperjadin');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileKwitansiperjadin = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/kegiatan", "{$namafileKwitansiperjadin}");
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

        $data['judulhalaman'] = 'Edit Narasumber';
        $data['narasumber'] = DB::table('narasumber')->orderBy('namalengkap', 'asc');
        $data['kegdetail'] = DB::table('kegiatan_detail')->where('id_kegiatandetail', $id_kegiatandetail)->first();
        $data['goles'] = DB::table('golongan as gol')
                        ->join('narasumber as nr', 'gol.id_golongan', '=', 'nr.id_golongan')
                        ->join('eselon as es', 'es.id_eselon', '=', 'nr.id_eselon')
                        ->where('nr.id_narasumber', $data['kegdetail']->id_narasumber)->first();

        return view('kegiatan.narsumedit', $data);
    }

    public function narsumsaveupdate(Request $req){
        $id_kegiatandetail = $req->post('id_kegiatandetail');
        $jumlahjam = $req->post('jumlahjam');
        $jumlahhonor = Gudangfungsi::normalNumber($req->post('jumlahhonor'));
        $jumlahpotongan = Gudangfungsi::normalNumber($req->post('jumlahpotongan'));
        $jumlahbayar = Gudangfungsi::normalNumber($req->post('jumlahbayar'));
        $perjadin = ($req->post('perjadin') == '' ? 'no' : $req->post('perjadin'));
        $nominalperjadin = ($req->post('nominalperjadin') == '' ? '0' : Gudangfungsi::normalNumber($req->post('nominalperjadin')));
        $statustransfer = $req->post('statustransfer');
        $tanggaltransfer = Gudangfungsi::formtomysql($req->post('tanggaltransfer'));
        $nomorspm = $req->post('nomorspm');

        if ($req->hasFile('surattugas')){
            $file = $req->file('surattugas');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileSurattugas = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/kegiatan", "{$namafileSurattugas}");
        }else{
            $namafileSurattugas = $req->post('surattugas_current');
        }

        if ($req->hasFile('kwitansiperjadin')){
            $file = $req->file('kwitansiperjadin');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafileKwitansiperjadin = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/kegiatan", "{$namafileKwitansiperjadin}");
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
                $file->move("public/uploads/kegiatan", "{$namafile_buktitransfer}");
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

    public function cetakkwitansi(Request $req){
        $id_kegiatan = $req->get('id');

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

        $pdf = PDF::loadView('kegiatan/cetakkwitansi', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('kwitansi-narsum.pdf');
    }

}
