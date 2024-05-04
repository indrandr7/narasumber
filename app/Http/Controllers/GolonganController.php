<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GolonganController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Golongan';

        return view('golongan.index', $data);
    }

    public function getlist(){
        $data = DB::table('golongan')->orderBy('id_golongan', 'asc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('golongan', function($row){
                return $row->golongan;
            })
            ->addColumn('pph', function($row){
                return $row->pph.'%';
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_golongan.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_golongan.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['golongan', 'pph', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Golongan';

        return view('golongan.add', $data);
    }

    public function save(Request $req){
        $golongan = $req->post('golongan');
        $pph = $req->post('pph');

        $data = ['golongan' => $golongan,
                 'pph' => $pph,
                ];

        try{
            $simpan = DB::table('golongan')->insert($data);

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
        $id_golongan = $req->get('id');

        $data['judulhalaman'] = 'Edit Eselon';
        $data['golongan'] = DB::table('golongan')->where('id_golongan', $id_golongan)->first();

        return view('golongan.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_golongan = $req->post('id_golongan');
        $golongan = $req->post('golongan');
        $pph = $req->post('pph');

        $data = ['golongan' => $golongan,
                 'pph' => $pph,
                ];

        try{
            $simpan = DB::table('golongan')->where('id_golongan', $id_golongan)->update($data);

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

        $hapus = DB::table('golongan')->where('id_golongan', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}