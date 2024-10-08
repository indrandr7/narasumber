@extends('layout.app')
@section('content')

<style>
  .ratatengah{
    text-align: center;
  }
  .warnabg{
    background-color: #F8F9FA;
  }
  .pbody{ font-size: 13.5px;}
  .phead{ font-size: 14px; }
</style>

<div class="content-wrapper">

    <div class="content-header">
      <div class="row">
        <div class="col-5">
            <nav class="navbar navbar-light__ bg-light__ justify-content-between">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </nav>
        </div>
        <div class="col-7 float-right">
          <form class="form-inline float-right" id="formulir" name="formulir" action="{{ url('kegiatan/cari/') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
              <div class="col-sm-9">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="tanggal" name="tanggal">
                  </div>
              </div>
            </div>
            <div class="form-group row" style="margin-right: 10px;">
              <button type="submit" class="btn btn-sidebar btn-success" style="padding-left: 18px;">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <div class="form-group row" style="margin-right: 10px;">
              <a href="{{ url('kegiatan/cetakmatrik') }}" target="_blank" class="btn btn-sidebar btn-danger">
                <i class="fas fa-file-pdf"></i> Cetak Matrik
              </a>
            </div>
            <div class="form-group row" style="margin-right: 10px;">
              <a href="{{ url('kegiatan/add') }}" class="btn btn-sidebar btn-primary">
                <i class="fas fa-plus fa-fw"></i> Tambah
              </a>
            </div>
          </form>
          
        </div>
        
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
                      <th class="ratatengah warnabg phead" width="3%">No</th>
                      <th class="ratatengah warnabg phead" width="15%">Judul Kegiatan</th>
                      <th class="ratatengah warnabg phead" width="10%">Tanggal/Tempat</th>
                      <th class="ratatengah warnabg phead" width="41%">Narasumber</th>
                      <th class="ratatengah warnabg phead" width="10%">Kelengkapan</th>
                      <th class="ratatengah warnabg phead" width="10%">Penginput</th>
                      <th class="ratatengah warnabg phead" width="11%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @foreach ($kegiatan->get() as $keg)
                        <tr>
                          <td class="pbody">{{ $no }}</td>
                          <td class="pbody">{{ $keg->nama_kegiatan }}</td>
                          <td class="pbody">
                            {{ Gudangfungsi::tanggalindoshort($keg->tanggal) }} <hr style="margin-top:0px;margin-bottom:0px;">
                            {{ $keg->tempat }}
                          </td>
                          <td class="pbody">
                            @php
                                $narsum = Gudangfungsi::getKegiatanDetail($keg->kode_kegiatan);
                            @endphp

                            @if ($narsum->count() == 0)
                              Narasumber not available
                            @else
                              <table width="100%">
                                <tr>
                                  <td style="text-align:center;border:0px;" colspan="2" class="pbody"></td>
                                  <td style="text-align:center;background-color:#cdcdcd;" class="pbody">Honor (Rp)</td>
                                  <td style="text-align:center;background-color:#cdcdcd;" class="pbody">SPPD (Rp)</td>
                                  <td style="text-align:center;background-color:#cdcdcd;" class="pbody" colspan="3">Status</td>
                                </tr>
                                @foreach ($narsum->get() as $key => $dtnarsum)
                                  @php
                                      // $warnaTransfer = ($dtnarsum->is_transfer == 'yes' ? 'btn-success' : 'btn-danger');
                                      // $warnaVerifikasi = ($dtnarsum->is_verified == 'yes' ? 'btn-success' : 'btn-danger');
                                      // $warnaCair = ($dtnarsum->is_cair == 'yes' ? 'btn-success' : 'btn-danger');

                                      $warnaTransfer = ($dtnarsum->is_transfer == 'yes' ? 'success' : 'danger');
                                      $warnaVerifikasi = ($dtnarsum->is_verified == 'yes' ? 'success' : 'danger');
                                      $warnaCair = ($dtnarsum->is_cair == 'yes' ? 'success' : 'danger');
                                  @endphp
                                  <tr>
                                    <td class="pbody" style="padding: 4px;width:5%;border:1px solid #cdcdcd;">{{ $key+1 }}.</td>
                                    <td class="pbody" style="padding: 4px;width:30%;border:1px solid #cdcdcd;">{{ $dtnarsum->namalengkap }}</td>
                                    <td class="pbody" style="padding: 4px;width:20%;border:1px solid #cdcdcd;text-align:right;">{{ Gudangfungsi::formatuang($dtnarsum->jumlah_bayar) }}</td>
                                    <td class="pbody" style="padding: 4px;width:20%;border:1px solid #cdcdcd;text-align:right;">{{ Gudangfungsi::formatuang($dtnarsum->nominal_sppd) }}</td>
                                    <td class="pbody" style="padding: 4px 1px 4px 4px;width:10%;text-align:center;border:1px solid #cdcdcd;border-right:0px !important;">
                                      <span class="right badge badge-{{ $warnaTransfer }}">Transfer</span>
                                      {{-- <button class="btn btn-xs {{ $warnaTransfer }}" id="statusTransfer" onclick="statusTransfer('{{$dtnarsum->id_kegiatandetail}}')">Transfer</button> --}}
                                    </td>
                                    <td class="pbody" style="padding: 4px 0px 4px 1px;width:10%;text-align:center;border:1px solid #cdcdcd;border-right:0px !important;border-left:0px !important;">
                                      <span class="right badge badge-{{ $warnaCair }}">Cair</span>
                                      {{-- <button class="btn btn-xs {{ $warnaCair }}" id="statusCair" onclick="statusCair('{{$dtnarsum->id_kegiatandetail}}')">Cair</button> --}}
                                    </td>
                                    <td class="pbody" style="padding: 4px 4px 4px 1px;width:10%;text-align:center;border:1px solid #cdcdcd;border-left:0px !important;">
                                      <span class="right badge badge-{{ $warnaVerifikasi }}">Ver</span>
                                      {{-- <button class="btn btn-xs {{ $warnaVerifikasi }}" id="statusVerifikasi" onclick="statusVerifikasi('{{$dtnarsum->id_kegiatandetail}}')">Verifikasi</button> --}}
                                    </td>
                                  </tr>
                                @endforeach
                              </table>
                            @endif
                          </td>
                          <td class="pbody ratatengah">
                            @php
                            $warnaUndangan = ($keg->file_undangan == '' ? 'danger' : 'success');
                            $warnaKegiatan = ($keg->file_laporankegiatan == '' ? 'danger' : 'success');
                            @endphp
                            <span class="right badge badge-{{ $warnaUndangan }}">Undangan</span>
                            <span class="right badge badge-{{ $warnaKegiatan }}">Laporan Kegiatan</span>
                          </td>
                          <td class="pbody">{{ $keg->name }}</td>
                          <td class="ratatengah">
                            {{-- <a href="{{ url('kegiatan/cetakusulan?id='.$keg->id_kegiatan) }}" class="btn btn-xs btn-primary" title="Cetak Usulan" target="_blank">
                              <i class="nav-icon fas fa-file-pdf"></i>
                            </a>
                            <a href="{{ url('kegiatan/cetakkwitansi?id='.$keg->id_kegiatan) }}" class="btn btn-xs btn-primary" title="Cetak Kwitansi" target="_blank">
                              <i class="nav-icon fas fa-file-pdf"></i>
                            </a> --}}
                            <a href="{{ url('kegiatan/downloaddokumen?id='.$keg->kode_kegiatan) }}" class="btn btn-xs btn-primary" title="Download dokumen" target="_self">
                              <i class="nav-icon fas fa-download"></i>
                            </a>
                            <a href="{{ url('kegiatan/edit/'.$keg->kode_kegiatan) }}" class="btn btn-xs btn-success" title="Edit">
                              <i class="nav-icon fas fa-edit"></i>
                            </a>
                            <button class="btn btn-xs btn-secondary" onclick="hapus({{ $keg->id_kegiatan }})" title="Hapus"><i class="nav-icon fas fa-trash"></i></button>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function statusTransfer(id_kegiatandetail){
      alert('Transfer '+id_kegiatandetail)
    }

    function statusVerifikasi(id_kegiatandetail){
      alert('Verifikasi')
    }

    function cetakMatrik(){
      event.preventDefault();
      // alert('cetak matrik')
      // location.href = "{{ url('/kegiatan/add') }}";
      // window.open({{ url('kegiatan/cetakmatrik') }}, '_blank');
    }

    function showFormEdit(){
      $('#modalku').modal('show').find('#modalku_content').load("{{ url('/kegiatan/edit') }}");
    }

    function reloadTable(){
        $('#tabelku').DataTable().ajax.reload();
    }

    function hapus(id){
      event.preventDefault(); // prevent form submit

      swal({
        title: "Apakah kamu yakin?",
        text: "Kamu akan kehilangan data untuk selamanya! ",
        icon: "warning",
        buttons: {
              confirm: 'Ya',
              cancel: 'Batal'
            },
        dangerMode: false,
      }).then((willDelete) => {
        if (willDelete) {
        	$.ajax({
        		url: "{{ url('/kegiatan/delete') }}",
        		type: 'POST',
        		data: {"id":id},
        		dataType: 'json',
                      // processData: false,
                      // contentType: false,
        		success: function(resp){
        			if (resp.result == "success"){
        				swal({
        						title: "",
        						text: resp.message,
        						icon: "success",
        					}).then(function(){
        						// reloadTable();
                    location.reload()
        					}
        				);
        			}
        		},
        		error: function(jqXHR, textStatus, errorThrown){
        			console.log('jqXMLHTTReq: '+jqXHR+', Status: '+textStatus+', Error: '+errorThrown);
        		}
         		});
        }
      });
    }

    $(function (){
      $('#tanggal').datetimepicker({
        format: 'L'
      });

      $('#tanggal').daterangepicker()
      $('#tabeldata').DataTable({
        "ordering":false
      });
    })
  </script>
@endsection

