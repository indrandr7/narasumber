<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index(){
        $data['judulhalaman'] = 'Pengguna';

        return view('pengguna.index', $data);
    }

    public function getlist(){
        $data = DB::table('users as us')
                    ->join('users_level as lv', 'us.id_user_level', '=', 'lv.id_user_level')
                    ->join('bagian as bg', 'us.id_bagian', '=', 'bg.id_bagian')
                    ->orderBy('us.id', 'asc')->get();

        $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namalengkap', function($row){
                return $row->name;
            })
            ->addColumn('username', function($row){
                return $row->username;
            })
            ->addColumn('level', function($row){
                return $row->level;
            })
            ->addColumn('bagian', function($row){
                return $row->nama_bagian;
            })
            ->addColumn('isactive', function($row){
                $isActive = ($row->is_active == 'yes' ? 'success' : 'danger');
                return '<span class="right badge badge-'.$isActive.'">'.strtoupper($row->is_active).'</span>';
            })
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" onclick="showFormEdit(\''.$row->id.'\')" title="Edit" class="btn btn-xs btn-success m-b-0 ">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="hapus(\''.$row->id.'\')" title="Hapus" class="btn btn-xs btn-secondary m-b-0">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>';
                return $actionBtn;
            })
            ->rawColumns(['namalengkap', 'username', 'level', 'bagian', 'isactive', 'action'])
            ->make(true);
        
        return $datatable;
    }

    public function add(){
        $data['judulhalaman'] = 'Tambah Pengguna';
        $data['level'] = DB::table('users_level')->orderBy('id_user_level', 'asc')->get();
        $data['bagian'] = DB::table('bagian')->orderBy('id_biro', 'asc')->get();

        return view('pengguna.add', $data);
    }

    public function save(Request $req){
        $id_user_level = $req->post('id_user_level');
        $name = $req->post('name');
        $username = $req->post('username');
        $email = $req->post('email');
        $password = Hash::make($req->post('password'));
        $id_user_level = $req->post('id_user_level');
        $is_active = $req->post('is_active');
        $id_bagian = $req->post('id_bagian');

        $data = ['id_user_level' => $id_user_level, 
                 'name' => $name,
                 'username' => $username,
                 'email' => $email,
                 'password' => $password,
                 'id_user_level' => $id_user_level,
                 'is_active' => $is_active,
                 'id_bagian' => $id_bagian,
                 'created_at' => date('Y-m-d H:i:s'),
                ];

        try{
            $simpan = DB::table('users')->insert($data);

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
        $id_pengguna = $req->get('id');

        $data['judulhalaman'] = 'Edit Pengguna';
        $data['level'] = DB::table('users_level')->orderBy('id_user_level', 'asc')->get();
        $data['bagian'] = DB::table('bagian')->orderBy('id_biro', 'asc')->get();
        $data['pengguna'] = DB::table('users')->where('id', $id_pengguna)->first();

        return view('pengguna.edit', $data);
    }

    public function saveupdate(Request $req){
        $id_user = $req->post('id_user');
        $id_user_level = $req->post('id_user_level');
        $name = $req->post('name');
        $username = $req->post('username');
        $email = $req->post('email');
        $password = Hash::make($req->post('password'));
        $id_user_level = $req->post('id_user_level');
        $is_active = $req->post('is_active');
        $id_bagian = $req->post('id_bagian');

        if ($password == ""){
            $data = ['id_user_level' => $id_user_level, 
                 'name' => $name,
                 'username' => $username,
                 'email' => $email,
                 'id_user_level' => $id_user_level,
                 'is_active' => $is_active,
                 'id_bagian' => $id_bagian,
                 'updated_at' => date('Y-m-d H:i:s'),
                ];
        }else{
            $data = ['id_user_level' => $id_user_level, 
                 'name' => $name,
                 'username' => $username,
                 'email' => $email,
                 'password' => $password,
                 'id_user_level' => $id_user_level,
                 'is_active' => $is_active,
                 'id_bagian' => $id_bagian,
                 'updated_at' => date('Y-m-d H:i:s'),
                ];
        }

        try{
            $simpan = DB::table('users')->where('id', $id_user)->update($data);

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

        $hapus = DB::table('users')->where('id', $id)->delete();

        if ($hapus){
            $response = ['result'=>'success', 'message'=>'Deleting data successfully'];
        }else{
            $response = ['result'=>'failed', 'message'=>'Deleteting data failed'];
        }

        return response()->json($response);
    }

}