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
          <li class="breadcrumb-item active">Tambah Narasumber</li>
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
            
          
              
              <!-- /.card-header -->
                      <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tambah Data Narasumber</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('savenarsum') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  @csrf 
                  <div class="form-group row">
                    <label for="nama_narsum" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control @error('nama_narsum') is-invalid @enderror" id="nama_narsum" name="nama_narsum" placeholder="Nama Narasumber">
                      <!-- error message untuk title -->
                      @error('nama_narsum')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_tlp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control @error('no_tlp') is-invalid @enderror" id="no_tlp" name="no_tlp" placeholder="No. Telepon">
                      <!-- error message untuk title -->
                      @error('no_tlp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nip" class="col-sm-2 col-form-label">NIP / NIK</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="NIP / NIK">
                      <!-- error message untuk title -->
                      @error('nip')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" placeholder="Jabatan">
                      <!-- error message untuk title -->
                      @error('jabatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status Kepegawaian</label>
                    <div class="col-lg-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="ASN" value="ASN">
                        <label class="form-check-label" for="ASN">ASN</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="Non ASN" value="Non ASN">
                        <label class="form-check-label" for="Non ASN">Non ASN</label>
                    </div>
<!-- error message untuk title -->
@error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  </div>      
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-6">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                      <!-- error message untuk title -->
                      @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama_bank" class="col-sm-2 col-form-label">Nama Bank</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank" name="nama_bank" placeholder="Nama Bank">
                      <!-- error message untuk title -->
                      @error('nama_bank')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama_rek" class="col-sm-2 col-form-label">Nama di Rekening</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control @error('nama_rek') is-invalid @enderror" id="nama_rek" name="nama_rek" placeholder="Nama di Rekening">
                      <!-- error message untuk title -->
                      @error('nama_rek')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_rek" class="col-sm-2 col-form-label">Nomor Rekening</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control @error('no_rek') is-invalid @enderror" id="no_rek" name="no_rek" placeholder="Nomor Rekening">
                      <!-- error message untuk title -->
                      @error('no_rek')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="npwp" class="col-sm-2 col-form-label">Nomor NPWP</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" placeholder="Nomor NPWP">
                      <!-- error message untuk title -->
                      @error('npwp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="upload_npwp" class="col-sm-2 col-form-label">Upload NPWP</label>
                    <div class="col-sm-3">
                        <input class="form-control @error('upload_npwp') is-invalid @enderror" type="file" id="upload_npwp" name="upload_npwp">
                        <!-- error message untuk title -->
                        @error('upload_npwp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pangkat / Golongan</label>
                    <div class="col-sm-3">
                        <div class="dropdown">    
                        <select class="form-control select2 select2-danger" name="golongan" id="golongan" style="width: 100%;">
                          <option selected="selected">Pilih Golongan</option>
                          <option value="III/a" name="golongan">III/a</option>
                          <option value="III/b" name="golongan">III/b</option>
                          <option value="III/c" name="golongan">III/c</option>
                          <option value="III/d" name="golongan">III/d</option>
                          <option value="IV/a" name="golongan">IV/a</option>
                          <option value="IV/b" name="golongan">IV/b</option>
                          <option value="IV/c" name="golongan">IV/c</option>
                          <option value="IV/d" name="golongan">IV/d</option>
                          <option value="IV/e" name="golongan">IV/e</option>
                        </select>
                        </div>
                    </div> 
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Eselon</label>
                    <div class="col-sm-3">
                        <div class="dropdown">
                          <select class="form-control select2 select2-danger" name="eselon" id="eselon" style="width: 100%;">
                          <option selected="selected">Pilih Eselon</option>
                          <option value="Eselon-I" name="eselon">Eselon-I</option>
                          <option value="Eselon-II" name="eselon">Eselon-II</option>
                          <option value="Eselon-III" name="eselon">Eselon-III</option>
                          <option value="Eselon-IV" name="eselon">Eselon-IV</option>
                          <option value="Staff" name="eselon">Staff</option>
                        </select>
                        </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pajak" class="col-sm-2 col-form-label">Pajak</label>
                    <div class="col-lg-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak" id="5%" value="5%">
                        <label class="form-check-label" for="5%">5%</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak" id="15%" value="15%">
                        <label class="form-check-label" for="15%">15%</label>
                    </div>

                  </div>
                  </div>    
                  <div class="form-group row">
                    <label for="unit_kerja" class="col-sm-2 col-form-label">Nama Unit Kerja</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror" id="unit_kerja" name="unit_kerja" placeholder="Nama Unit Kerja">
                      <!-- error message untuk title -->
                      @error('unit_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat_unit" class="col-sm-2 col-form-label">Alamat Unit Kerja</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control @error('alamat_unit') is-invalid @enderror" id="alamat_unit" name="alamat_unit" placeholder="Alamat Unit Kerja">
                      <!-- error message untuk title -->
                      @error('alamat_unit')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                  </div>     
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <button type="reset" class="btn btn-md btn-warning">Reset</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>



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