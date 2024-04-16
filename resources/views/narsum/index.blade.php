@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <!-- SidebarSearch Form -->
      <nav class="navbar navbar-light bg-light justify-content-between">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Narasumber</li>
        </ol>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
        </form>
      </nav>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              <a href="{{ route('addnarsum') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <table id="example2" class="table table-bordered table-hover" width="800px">
                  <thead>
                  <tr>
                    <th style="text-align:center" width="auto">No</th>
                    <th style="text-align:center" width="auto">Nama Narasumber</th>
                    <th style="text-align:center" width="auto">Unit Kerja</th>
                    <th style="text-align:center" width="auto">Jabatan</th>
                    <th style="text-align:center" width="auto">Golongan</th>
                    <th style="text-align:center" width="auto">Status</th>
                    <th style="text-align:center" width="200px">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_nar as $dn)
                    <tr>
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td style="text-align:left">{{$dn->nama_narsum}}</td>
                        <td style="text-align:center">{{$dn->unit_kerja}}</td>
                        <td style="text-align:center">{{$dn->jabatan}}</td>
                        <td style="text-align:center">{{$dn->golongan}}</td>
                        <td style="text-align:center">{{$dn->status}}</td>
                        <td style="text-align:center">
                            <a href="{{ route('editnarsum', ['id_narsum' => $dn->id_narsum])}}" class="btn btn-info" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a data-toggle="modal" data-target="#hapus{{$dn->id_narsum}}" class="btn btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    
                    <div class="modal fade" id="hapus{{$dn->id_narsum}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi hapus data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                      <div class="modal-body">
                        <p>Apakah yakin data <b> {{$dn->nama_narsum}}</b> akan dihapus? </p>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <form action="{{ route('deletenarsum',['id_narsum' => $dn->id_narsum]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                    @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
@endsection

<script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>