@extends('layout.app')
@section('content')

<style>
  .ratatengah{
    text-align: center;
  }
  .kolom-narsum{
    border:none;border-bottom:1px solid #ED7115;background-color: #F7CD9C;
  }
</style>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">        
        <nav class="navbar navbar-light bg-light justify-content-between">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-body">
                
                <table id="tabeldata" class="table table-bordered table-hover_ table-striped" width="100%px">
                  <thead>
                    <tr>
                      <th class="ratatengah" width="5%">No</th>
                      <th class="ratatengah" width="22%">Judul Kegiatan</th>
                      <th class="ratatengah" width="15%">Tanggal</th>
                      <th class="ratatengah" width="15%">Tempat</th>
                      <th class="ratatengah" width="35%">Narasumber</th>
                      <th class="ratatengah" width="8%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @foreach ($kegiatan->get() as $keg)
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $keg->nama_kegiatan }}</td>
                          <td>{{ Gudangfungsi::tanggalindoshort($keg->tanggal) }}</td>
                          <td>{{ $keg->tempat }}</td>
                          <td>
                            @php
                                $narsum = Gudangfungsi::getKegiatanDetail($keg->kode_kegiatan);
                            @endphp

                            @if ($narsum->count() == 0)
                              Narasumber not available
                            @else
                              <table width="100%">
                                @foreach ($narsum->get() as $key => $dtnarsum)
                                  @php
                                      $warnaTransfer = ($dtnarsum->is_transfer == 'yes' ? 'btn-success' : 'btn-danger');
                                      $warnaVerifikasi = ($dtnarsum->is_verified == 'yes' ? 'btn-success' : 'btn-danger');
                                  @endphp
                                  <tr>
                                    <td style="padding: 4px;width:5%;border:none;border-bottom:1px solid #ED7115;background-color: #F7CD9C;">{{ $key+1 }}.</td>
                                    <td style="padding: 4px;width:50%;border:none;border-bottom:1px solid #ED7115;background-color: #F7CD9C;">{{ $dtnarsum->namalengkap }}</td>
                                    <td style="padding: 4px;width:10%;text-align:center;border:none;border-bottom:1px solid #ED7115;background-color: #F7CD9C;">
                                      <button class="btn btn-xs {{ $warnaTransfer }}" id="statusTransfer" onclick="statusTransfer('{{$dtnarsum->id_kegiatandetail}}')">Transfer</button>
                                    </td>
                                    <td style="padding: 4px;width:10%;text-align:center;border:none;border-bottom:1px solid #ED7115;background-color: #F7CD9C;">
                                      <button class="btn btn-xs {{ $warnaVerifikasi }}" id="statusVerifikasi" onclick="statusVerifikasi('{{$dtnarsum->id_kegiatandetail}}')">Verifikasi</button>
                                    </td>
                                  </tr>
                                @endforeach
                              </table>
                            @endif
                          </td>
                          <td class="ratatengah">
                            <a href="{{ url('kegiatan/cetakusulan?id='.$keg->id_kegiatan) }}" class="btn btn-xs btn-primary" title="Cetak Usulan" target="_blank">
                              <i class="nav-icon fas fa-file-pdf"></i>
                            </a>
                            <a href="{{ url('kegiatan/cetakkwitansi?id='.$keg->id_kegiatan) }}" class="btn btn-xs btn-primary" title="Cetak Kwitansi" target="_blank">
                              <i class="nav-icon fas fa-file-pdf"></i>
                            </a>
                            <a href="{{ url('kegiatan/verifikasilihat/'.$keg->kode_kegiatan) }}" class="btn btn-xs btn-success" title="Lihat Detail Kegiatan">
                              <i class="nav-icon fas fa-check"></i>
                            </a>
                            {{-- <button class="btn btn-sm btn-secondary"><i class="nav-icon fas fa-trash"></i></button> --}}
                          </td>
                        </tr>

                        @php $no++ @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="modalku">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="modalku_content"></div>
    </div>
  </div>

  <script type="text/javascript">
    function statusTransfer(id_kegiatandetail){
      alert('Transfer '+id_kegiatandetail)
    }

    function statusVerifikasi(id_kegiatandetail){
      alert('Verifikasi')
    }

    function showFormAdd(){
      // $('#modalku').modal('show').find('#modalku_content').load("{{ url('/kegiatan/add') }}");
      location.href = "{{ url('/kegiatan/add') }}";
    }

    function showFormEdit(){
      $('#modalku').modal('show').find('#modalku_content').load("{{ url('/kegiatan/edit') }}");
    }

    function reloadTable(){
        $('#tabelku').DataTable().ajax.reload();
    }

    $(function (){
      $('#tabeldata').DataTable();
    })
  </script>
@endsection

