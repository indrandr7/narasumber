<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MataanggaranController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Mata Anggaran';

        return view('mataanggaran.index', $data);
    }

    public function getlist(){
        $data = DB::table('mak as ma')
                ->join('bagian as bg', 'ma.id_bagian', '=', 'bg.id_bagian')
                ->orderBy('ma.id_bagian', 'asc')->where('tahun', date('Y'))->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            // ->addColumn('namabagian', function($row){
            //     return $row->nama_bagian;
            // })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id_mak.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id_mak.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Mata Anggaran';
        $data['bagian'] = DB::table('bagian')->orderBy('id_biro', 'asc')->get();

        return view('mataanggaran.add', $data);
    }

    public function save(Request $req){
        $id_bagian = $req->post('id_bagian');
        $kodemak = $req->post('kodemak');
        $namakegiatan = $req->post('namakegiatan');
        $tahun = $req->post('tahun');

        $data = ['id_bagian' => $id_bagian,
                 'kodemak' => $kodemak,
                 'namakegiatan' => $namakegiatan,
                 'tahun' => $tahun,
                ];

        try{
            $simpan = DB::table('mak')->insert($data);

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
        $id_mataanggaran = $req->get('id');

        $data['judulhalaman'] = 'Edit Mata Anggaran';
        $data['bagian'] = DB::table('bagian')->orderBy('id_biro', 'asc')->get();
        $data['mak'] = DB::table('mak')->where('id_mak', $id_mataanggaran)->first();

        return view('mataanggaran.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_mataanggaran = $req->post('id_mataanggaran');
        $id_bagian = $req->post('id_bagian');
        $kodemak = $req->post('kodemak');
        $namakegiatan = $req->post('namakegiatan');
        $tahun = $req->post('tahun');

        $data = ['id_bagian' => $id_bagian,
                 'kodemak' => $kodemak,
                 'namakegiatan' => $namakegiatan,
                 'tahun' => $tahun,
                ];

        try{
            $simpan = DB::table('mak')->where('id_mak', $id_mataanggaran)->update($data);

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

        $hapus = DB::table('mak')->where('id_mak', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}