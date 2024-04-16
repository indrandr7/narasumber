<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Narsum;

use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


class Home extends Controller
{
    public function auth()
    {
        return view ('auth');
    }

    public function index(): View
    {
        //get posts
        $data_kegiatan = Kegiatan::get();

        //render view with posts
        return view('kegiatan/index', compact('data_kegiatan'));
    }

    public function index_narsum(): View
    {
         //get posts
         $data_nar = Narsum::get();

         //render view with posts
         return view('narsum/index', compact('data_nar'));
    }

    public function addnarsum(): View
    {
        return view('narsum/addnarsum');
    }

    public function savenarsum(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_narsum'   => 'required',
            'no_tlp'        => 'required',
            'nip'           => 'required',
            'jabatan'       => 'required',
            'status'        => 'required',
            'email'         => 'required|email',
            'nama_bank'     => 'required',
            'nama_rek'      => 'required',
            'no_rek'        => 'required',
            'npwp'          => 'required',
            'upload_npwp'   => 'required|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'golongan'      => 'required',
            'eselon'        => 'required',
            'pajak'         => 'required',
            'unit_kerja'    => 'required',
            'alamat_unit'   => 'required',
        ]);
        
        Narsum::create($request->all());
         
        return redirect()->route('indexnarsum')->with(['success' => 'Data Berhasil Disimpan!']);

    }

    public function editnarsum (Request $request, $id_narsum)
    {
        $data_nar = Narsum::find($id_narsum);
        return view('narsum/editnarsum', compact('data_nar'));
    }

    public function updatenarsum (Request $request, $id_narsum): RedirectResponse
    {
        $request->validate([
            'nama_narsum'   => 'required',
            'no_tlp'        => 'required',
            'nip'           => 'required',
            'jabatan'       => 'required',
            'status'        => 'required',
            'email'         => 'required|email',
            'nama_bank'     => 'required',
            'nama_rek'      => 'required',
            'no_rek'        => 'required',
            'npwp'          => 'required',
            'upload_npwp'   => 'required|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'golongan'      => 'required',
            'eselon'        => 'required',
            'pajak'         => 'required',
            'unit_kerja'    => 'required',
            'alamat_unit'   => 'required',
        ]);
     
        // Cari data yang akan diupdate
        $data_nar = Narsum::findOrFail($id_narsum);

        // Update data dengan data baru
        $data_nar->nama_narsum = $request->input('nama_narsum');
        $data_nar->no_tlp = $request->input('no_tlp');
        $data_nar->nip = $request->input('nip');
        $data_nar->jabatan = $request->input('jabatan');
        $data_nar->status = $request->input('status');
        $data_nar->email = $request->input('email');
        $data_nar->nama_bank = $request->input('nama_bank');
        $data_nar->nama_rek = $request->input('nama_rek');
        $data_nar->no_rek = $request->input('no_rek');
        $data_nar->npwp = $request->input('npwp');
        // $data_nar->upload_npwp = $request->input('upload_npwp');
        $data_nar->golongan = $request->input('golongan');
        $data_nar->eselon = $request->input('eselon');
        $data_nar->pajak = $request->input('pajak');
        $data_nar->unit_kerja = $request->input('unit_kerja');
        $data_nar->alamat_unit = $request->input('alamat_unit');
        // Tambahkan field lainnya sesuai kebutuhan

        // Simpan perubahan
        $data_nar->save();

        // Narsum::whereId($id_narsum)->update($data_nar);
        return redirect()->route('indexnarsum')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }

    public function deletenarsum (Request $request,$id_narsum)
    {
        $data_nar = Narsum::find($id_narsum);

        if($data_nar){
            $data_nar->delete();
        }
        return redirect()->route('indexnarsum')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}