<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BiroController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Biro';

        return view('biro.index', $data);
    }

    public function getlist(){
        $data = DB::table('biro')->orderBy('id_biro', 'asc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_biro', function($row){
                return $row->nama_biro;
            })
            ->addColumn('nama_pejabat', function($row){
                return $row->nama_pejabat.' - '.$row->nama_pejabat;
            })
            ->addColumn('nip', function($row){
                return ($row->nip == '' ? '-' : $row->nip);
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_biro.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_biro.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['nama_biro', 'nama_pejabat', 'nip', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Biro';

        return view('biro.add', $data);
    }

    public function save(Request $req){
        $nama_biro = $req->post('nama_biro');
        $nama_pejabat = $req->post('nama_pejabat');
        $nip = $req->post('nip');

        $data = ['nama_biro' => $nama_biro,
                 'nama_pejabat' => $nama_pejabat,
                 'nip' => $nip,
                ];

        try{
            $simpan = DB::table('biro')->insert($data);

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
        $id_biro = $req->get('id');

        $data['judulhalaman'] = 'Edit Biro';
        $data['biro'] = DB::table('biro')->where('id_biro', $id_biro)->first();

        return view('biro.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_biro = $req->post('id_biro');
        $nama_biro = $req->post('nama_biro');
        $nama_pejabat = $req->post('nama_pejabat');
        $nip = $req->post('nip');

        $data = ['nama_biro' => $nama_biro,
                 'nama_pejabat' => $nama_pejabat,
                 'nip' => $nip,
                ];

        try{
            $simpan = DB::table('biro')->where('id_biro', $id_biro)->update($data);

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

        $hapus = DB::table('biro')->where('id_biro', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}