<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PpkController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'PPK';

        return view('ppk.index', $data);
    }

    public function getlist(){
        $data = DB::table('ppk')->orderBy('id_ppk', 'asc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namalengkap', function($row){
                return $row->namalengkap;
            })
            ->addColumn('nip', function($row){
                return $row->nip;
            })
            ->addColumn('tahun', function($row){
                return $row->tahun;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_ppk.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_ppk.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['namalengkap', 'nip', 'tahun', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah PPK';

        return view('ppk.add', $data);
    }

    public function save(Request $req){
        $namalengkap = $req->post('namalengkap');
        $nip = $req->post('nip');
        $tahun = $req->post('tahun');

        $data = ['namalengkap' => $namalengkap,
                 'nip' => $nip,
                 'tahun' => $tahun,
                ];

        try{
            $simpan = DB::table('ppk')->insert($data);

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
        $id_ppk = $req->get('id');

        $data['judulhalaman'] = 'Edit PPK';
        $data['ppk'] = DB::table('ppk')->where('id_ppk', $id_ppk)->first();

        return view('ppk.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_ppk = $req->post('id_ppk');
        $namalengkap = $req->post('namalengkap');
        $nip = $req->post('nip');
        $tahun = $req->post('tahun');

        $data = ['namalengkap' => $namalengkap,
                 'nip' => $nip,
                 'tahun' => $tahun,
                ];

        try{
            $simpan = DB::table('ppk')->where('id_ppk', $id_ppk)->update($data);

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

        $hapus = DB::table('ppk')->where('id_ppk', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}