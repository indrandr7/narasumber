<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EselonController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Eselon';

        return view('eselon.index', $data);
    }

    public function getlist(){
        $data = DB::table('eselon')->orderBy('id_eselon', 'asc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('eselon', function($row){
                return $row->eselon;
            })
            ->addColumn('sbm', function($row){
                return Gudangfungsi::formatuang($row->sbm);
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_eselon.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_eselon.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['eselon', 'sbm', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Eselon';

        return view('eselon.add', $data);
    }

    public function save(Request $req){
        $eselon = $req->post('eselon');
        $sbm = $req->post('sbm');

        $data = ['eselon' => $eselon,
                 'sbm' => $sbm,
                ];

        try{
            $simpan = DB::table('eselon')->insert($data);

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
        $id_eselon = $req->get('id');

        $data['judulhalaman'] = 'Edit Eselon';
        $data['eselon'] = DB::table('eselon')->where('id_eselon', $id_eselon)->first();

        return view('eselon.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_eselon = $req->post('id_eselon');
        $eselon = $req->post('eselon');
        $sbm = $req->post('sbm');

        $data = ['eselon' => $eselon,
                 'sbm' => $sbm,
                ];

        try{
            $simpan = DB::table('eselon')->where('id_eselon', $id_eselon)->update($data);

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

        $hapus = DB::table('eselon')->where('id_eselon', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}