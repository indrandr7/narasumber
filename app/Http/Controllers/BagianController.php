<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BagianController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Bagian';

        return view('bagian.index', $data);
    }

    public function getlist(){
        $data = DB::table('bagian as bg')
                    ->select('bg.id_bagian', 'bg.id_biro', 'bg.nama_bagian', 'bg.nama_pejabat', 'bg.nip', 'br.nama_biro')
                    ->join('biro as br', 'bg.id_biro', '=', 'br.id_biro')
                    ->orderBy('br.id_biro', 'asc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namabagian', function($row){
                return $row->nama_bagian;
            })
            ->addColumn('namapejabat', function($row){
                return $row->nama_pejabat.' - '.$row->nama_pejabat;
            })
            ->addColumn('nip', function($row){
                return ($row->nip == '' ? '-' : $row->nip);
            })
            ->addColumn('biro', function($row){
                return ($row->nama_biro == '' ? '-' : $row->nama_biro);
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_bagian.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_bagian.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['namabagian', 'namapejabat', 'nip', 'biro', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Bagian';
        $data['biro'] = DB::table('biro')->orderBy('id_biro', 'asc')->get();

        return view('bagian.add', $data);
    }

    public function save(Request $req){
        $id_biro = $req->post('id_biro');
        $nama_bagian = $req->post('nama_bagian');
        $nama_pejabat = $req->post('nama_pejabat');
        $nip = $req->post('nip');

        $data = ['id_biro' => $id_biro, 
                 'nama_bagian' => $nama_bagian,
                 'nama_pejabat' => $nama_pejabat,
                 'nip' => $nip,
                ];

        try{
            $simpan = DB::table('bagian')->insert($data);

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
        $id_bagian = $req->get('id');

        $data['judulhalaman'] = 'Edit Bagian';
        $data['biro'] = DB::table('biro')->orderBy('id_biro', 'asc')->get();
        $data['bagian'] = DB::table('bagian')->where('id_bagian', $id_bagian)->first();

        return view('bagian.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_bagian = $req->post('id_bagian');
        $id_biro = $req->post('id_biro');
        $nama_bagian = $req->post('nama_bagian');
        $nama_pejabat = $req->post('nama_pejabat');
        $nip = $req->post('nip');

        $data = ['id_biro' => $id_biro, 
                 'nama_bagian' => $nama_bagian,
                 'nama_pejabat' => $nama_pejabat,
                 'nip' => $nip,
                ];

        try{
            $simpan = DB::table('bagian')->where('id_bagian', $id_bagian)->update($data);

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

        $hapus = DB::table('bagian')->where('id_bagian', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}