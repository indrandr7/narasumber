@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <style>
        .ratatengah{ text-align: center !important; }
        .ratakanan{ text-align: right; }
        .ratakiri{ text-align: left; }
        .warnabg-gray{
            background-color: #F8F9FA;
        }
        .top-borderless{
            border-top: 0px !important;
        }
        .padr-0{
            padding-right: 0px !important;
        }
        .padl-2{
            padding-left: 2px !important;
        }
        .padtopbot{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>

    <div class="content-header">
      <div class="container-fluid">        
        <nav class="navbar navbar-light bg-light justify-content-between">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/kegiatan') }}">Kegiatan</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
      </div>
    </div>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-info">
                        <div class="card-body">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="kodekegiatan" name="kodekegiatan" value="{{ $kegiatan->kode_kegiatan }}">
                                <h3>Kegiatan: {{ $kegiatan->nama_kegiatan }}</h3>
                                <hr>
                                <table id="tabeldata2" class="table table-bordered_ table-hover_ table-striped_" width="100%px" style="margin-left:-12px !important;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%px;" class="top-borderless padtopbot"><strong>Mata anggaran</strong></td>
                                            <td style="width: 2%;" class="top-borderless padr-0 padtopbot">:</td>
                                            <td style="width: 78%;" class="top-borderless padl-2 padtopbot">{{ $kegiatan->namakegiatan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="top-borderless padtopbot"><strong>MAK</strong></td>
                                            <td class="top-borderless padr-0 padtopbot">:</td>
                                            <td class="top-borderless padl-2 padtopbot">{{ $kegiatan->kodemak }}</td>
                                        </tr>
                                        <tr>
                                            <td class="top-borderless padtopbot"><strong>Tanggal pelaksanaan</strong></td>
                                            <td class="top-borderless padr-0 padtopbot">:</td>
                                            <td class="top-borderless padl-2 padtopbot">{{ Gudangfungsi::tanggalindo($kegiatan->tanggal) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="top-borderless padtopbot"><strong>Tempat</strong></td>
                                            <td class="top-borderless padr-0 padtopbot">:</td>
                                            <td class="top-borderless padl-2 padtopbot">{{ $kegiatan->tempat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="top-borderless padtopbot"><strong>File undangan</strong></td>
                                            <td  class="top-borderless padr-0 padtopbot">:</td>
                                            <td class="top-borderless padl-2 padtopbot">
                                            @if ($kegiatan->file_undangan != '')
                                                <a href="#" target="_blank">
                                                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegiatan->file_undangan }}
                                                </a>
                                            @else
                                                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="top-borderless padtopbot"><strong>File Laporan</strong></td>
                                            <td class="top-borderless padr-0 padtopbot">:</td>
                                            <td class="top-borderless padl-2 padtopbot">
                                                @if ($kegiatan->file_laporankegiatan != '')
                                                    <a href="#" target="_blank">
                                                    <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegiatan->file_laporankegiatan }}
                                                    </a>
                                                @else
                                                    <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <div class="row form-group">
                                <h5 style="font-weight: bold;margin-left:10px;">Daftar Narasumber</h5>
                                {{-- &nbsp;&nbsp;
                                <button id="btnTambahNarsum" class="btn btn-xs btn-success" title="Tambah narasumber" style="padding-left: 10px;padding-right:10px;" data-toggle="modal" data-target="#modalku" onclick="showAddFormNarsum()">
                                    <i class="nav-icon fas fa-plus"></i>
                                </button>
                                <button id="btnMuatUlang" class="btn btn-xs btn-primary" title="Muat ulang data narasumber" style="padding-left: 10px;padding-right:10px;margin-left:5px;" onclick="reloadTable()">
                                    <i class="nav-icon fas fa-sync"></i>
                                </button> --}}
                            </div>

                            <table id="tabeldata" class="table table-bordered table-hover_ table-striped__" width="100%px">
                                <thead>
                                  <tr>
                                    <th class="ratatengah warnabg-gray" width="3%">No</th>
                                    <th class="ratatengah warnabg-gray" width="19%">Nama narasumber</th>
                                    <th class="ratatengah warnabg-gray" width="3%">Jam</th>
                                    <th class="ratatengah warnabg-gray" width="11%">Honor 1 Jam</th>
                                    <th class="ratatengah warnabg-gray" width="12%">Jumlah Honor</th>
                                    <th class="ratatengah warnabg-gray" width="8%">PPH</th>
                                    <th class="ratatengah warnabg-gray" width="11%">Potongan PPH</th>
                                    <th class="ratatengah warnabg-gray" width="13%">Jumlah Dibayar</th>
                                    <th class="ratatengah warnabg-gray" width="12%">Status</th>
                                    <th class="ratatengah warnabg-gray" width="7%">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
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

    function showAddFormNarsum(){
        var kodekegiatan = $('#kodekegiatan').val();
        $('#modalku').modal('show').find('#modalku_content').load("{{ url('/kegiatan/narsumadd') }}?kode="+kodekegiatan);
    }

    function showEditFormNarsum(id_kegiatandetail){
        $('#modalku').modal('show').find('#modalku_content').load("{{ url('/kegiatan/verifikasidetail') }}?id="+id_kegiatandetail);
    }

    function reloadTable(){
        $('#tabeldata').DataTable().ajax.reload();
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
					url: "{{ url('/kegiatan/narsumdelete') }}",
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
									reloadTable();
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

    $.validator.setDefaults({
      submitHandler: function(){
        event.preventDefault();
        proceed = true;

        var url;
        url = "{{ url('/kegiatan/saveupdatedata') }}"

        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#formulir')[0]),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(resp){
                if (resp.result == "success"){
                  toastr.success(resp.message)
                  window.location = "{{ url('kegiatan/edit') }}/"+resp.data.kode_kegiatan
                }else{
                  toastr.error(resp.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                toastr.error('jqXMLHTTReq: '+jqXHR+', Status: '+textStatus+', Error: '+errorThrown);
            },
        });
      },
      errorPlacement: function errorPlacement(error, element) {
        var $parent = $(element).parents('.form-group');
        if ($parent.find('.jquery-validation-error').length) {
            return;
        }
        $parent.append(error.addClass('jquery-validation-error small form-text invalid-feedback'));
      },
      highlight: function(element) {
        var $el = $(element);
        var $parent = $el.parents('.form-group');
        $el.addClass('is-invalid');
        if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
            $el.parent().addClass('is-invalid');
        }
      },
      unhighlight: function(element) {
          $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
      },
    });

    $(function (){
      $('#judulkegiatan').focus();
      $('#tanggal').datetimepicker({ format: 'L' });
      $('.select2bs4').select2({ theme: 'bootstrap4' });

      // Validasi input formulir kegiatan
      $('#formulir').validate({
          rules: {
            judulkegiatan: {
              required: true
            },
            mataanggaran: {
              required: true,
            },
            tanggal: {
              required: true,
            },
            tempat: {
              required: true,
            },
          }
        });

        $('#tabeldata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: 'post',
                url: "{{ url('/kegiatan/narsumlist') }}",
                data: { 'kodekegiatan': $('#kodekegiatan').val() }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namalengkap', name: 'namalengkap'},
                {data: 'jumlah_jam', name: 'jumlah_jam'},
                {data: 'honor_satujam', name: 'honor_satujam'},
                {data: 'jumlahhonor', name: 'jumlahhonor'},
                {data: 'pph', name: 'pph'},
                {data: 'potongan_pph', name: 'potongan_pph'},
                {data: 'jumlah_bayar', name: 'jumlah_bayar'},
                {data: 'status', name: 'status'},
                {data: 'action'}
            ],
            columnDefs: [
                { className: "ratakanan", "targets": [3,4,5,6,7]},
                { className: "ratatengah", "targets": [2,8,9]},
                // { className: "ndrparagraf", "targets": "_all"},
            ],
            "dom": 'rtip',
            "paging": false,
            "ordering": false,
            "bInfo": false,
        });
    })

  </script>
  @endsection