<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NarasumberController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Narasumber';

        return view('narasumber.index', $data);
    }

    public function getlist(){
        $data = DB::table('narasumber as nr')
                    ->join('golongan as gol', 'nr.id_golongan', '=', 'gol.id_golongan')
                    ->join('eselon as es', 'nr.id_eselon', '=', 'es.id_eselon')
                    ->orderBy('nr.namalengkap', 'desc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namalengkap', function($row){
                return $row->namalengkap;
            })
            ->addColumn('statuskepegawaian', function($row){
                $status = ($row->status_kepegawaian == 'asn' ? 'ASN' : 'Non ASN');
                return ($row->status_kepegawaian == '' ? '-' : $status);
            })
            ->addColumn('goles', function($row){
                return $row->golongan.' - '.$row->eselon;
            })
            ->addColumn('jabatan', function($row){
                return ($row->jabatan == '' ? '-' : $row->jabatan);
            })
            ->addColumn('unitkerja', function($row){
                return ($row->unitkerja == '' ? '-' : $row->unitkerja);
            })
            ->addColumn('kontak', function($row){
                return ($row->email == '' ? '-' : $row->email).'<br>'.($row->nomor_telpon == '' ? '-' : $row->nomor_telpon);
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_narasumber.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_narasumber.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['namalengkap', 'statuskepegawaian', 'goles', 'jabatan', 'unitkerja', 'kontak', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Narasumber';
        $data['golongan'] = DB::table('golongan')->orderBy('id_golongan', 'asc')->get();
        $data['eselon'] = DB::table('eselon')->orderBy('id_eselon', 'asc')->get();

        return view('narasumber.add', $data);
    }

    public function save(Request $req){
        $namalengkap = $req->post('namalengkap');
        $nomor_identitas = $req->post('nomor_identitas');
        $status_kepegawaian = $req->post('status_kepegawaian');
        $jabatan = $req->post('jabatan');
        $eselon = $req->post('eselon');
        $golongan = $req->post('golongan');
        $unit_kerja = $req->post('unit_kerja');
        $alamat = $req->post('alamat');
        $nomor_telpon = $req->post('nomor_telpon');
        $email = $req->post('email');
        $nama_bank = $req->post('nama_bank');
        $nomor_rekening = $req->post('nomor_rekening');
        $nama_rekening = $req->post('nama_rekening');
        $nomor_npwp = $req->post('nomor_npwp');
        
        if ($req->hasFile('file_npwp')){
            $file = $req->file('file_npwp');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/narasumber", "{$namafile}");
        }else{
            $namafile = '';
        }

        $data = ['namalengkap' => $namalengkap, 
                 'nomor_identitas' => $nomor_identitas,
                 'status_kepegawaian' => $status_kepegawaian,
                 'jabatan' => $jabatan,
                 'id_eselon' => $eselon,
                 'id_golongan' => $golongan,
                 'nomor_telpon' => $nomor_telpon,
                 'email' => $email,
                 'nama_bank' => $nama_bank,
                 'nomor_rekening' => $nomor_rekening,
                 'nama_rekening' => $nama_rekening,
                 'nomor_npwp' => $nomor_npwp,
                 'file_npwp' => $namafile,
                 'unitkerja' => $unit_kerja,
                 'alamat_unitkerja' => $alamat,
                 'created_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $simpan = DB::table('narasumber')->insert($data);

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

    public function edit(Request $req){
        $id_narasumber = $req->get('id');

        $data['judulhalaman'] = 'Edit Narasumber';
        $data['golongan'] = DB::table('golongan')->orderBy('id_golongan', 'asc')->get();
        $data['eselon'] = DB::table('eselon')->orderBy('id_eselon', 'asc')->get();
        $data['narasumber'] = DB::table('narasumber')->where('id_narasumber', $id_narasumber)->first();

        return view('narasumber.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_narasumber = $req->post('id_narasumber');
        $namalengkap = $req->post('namalengkap');
        $nomor_identitas = $req->post('nomor_identitas');
        $status_kepegawaian = $req->post('status_kepegawaian');
        $jabatan = $req->post('jabatan');
        $eselon = $req->post('eselon');
        $golongan = $req->post('golongan');
        $unit_kerja = $req->post('unit_kerja');
        $alamat = $req->post('alamat');
        $nomor_telpon = $req->post('nomor_telpon');
        $email = $req->post('email');
        $nama_bank = $req->post('nama_bank');
        $nomor_rekening = $req->post('nomor_rekening');
        $nama_rekening = $req->post('nama_rekening');
        $nomor_npwp = $req->post('nomor_npwp');
        
        if ($req->hasFile('file_npwp')){
            $file = $req->file('file_npwp');
            $namafileFull = $file->getClientOriginalName();
            $namafileOri = pathinfo($namafileFull, PATHINFO_FILENAME);
            $ekstensi = $file->getClientOriginalExtension();
            $namafile = $namafileOri.'_'.time().'.'.$ekstensi;

            $file->move("public/uploads/narasumber", "{$namafile}");
        }else{
            $namafile = $req->post('file_npwpcurrent');
        }

        $data = ['namalengkap' => $namalengkap, 
                 'nomor_identitas' => $nomor_identitas,
                 'status_kepegawaian' => $status_kepegawaian,
                 'jabatan' => $jabatan,
                 'id_eselon' => $eselon,
                 'id_golongan' => $golongan,
                 'nomor_telpon' => $nomor_telpon,
                 'email' => $email,
                 'nama_bank' => $nama_bank,
                 'nomor_rekening' => $nomor_rekening,
                 'nama_rekening' => $nama_rekening,
                 'nomor_npwp' => $nomor_npwp,
                 'file_npwp' => $namafile,
                 'unitkerja' => $unit_kerja,
                 'alamat_unitkerja' => $alamat,
                 'created_at' => date('Y-m-d H:i:s'),
                ];

        try{
            
            $dtnarsum = DB::table('narasumber')->where('id_narasumber', $id_narasumber)->first();
            $berkasNpwp = $dtnarsum->file_npwp;
            if (File::exists("public/uploads/narasumber/".$berkasNpwp) == true){
                File::delete("public/uploads/narasumber/".$berkasNpwp);
            }

            $simpan = DB::table('narasumber')->where('id_narasumber', $id_narasumber)->update($data);

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

    public function delete(Request $req){
        $id = $req->post('id');
        
        $data = DB::table('narasumber')->where('id_narasumber', $id);
        if ($data->count() != 0 ){
            $file_npwp = $data->first()->file_npwp;

            if (File::exists("public/uploads/narasumber/".$file_npwp) == true){
                File::delete("public/uploads/narasumber/".$file_npwp);
            }
        }

        $hapus = DB::table('narasumber')->where('id_narasumber', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

    public function unduh(Request $req){
        $id_narsum = $req->id;

        $narsum = DB::table('narasumber')->where('id_narasumber', $id_narsum)->first();

        if (File::exists('public/uploads/narasumber/'.$narsum->file_npwp) == true){
            $filepath = public_path('uploads/narasumber/'.$narsum->file_npwp);

            return response()->download($filepath);
        }else{
            abort(404);
        }
    }

}