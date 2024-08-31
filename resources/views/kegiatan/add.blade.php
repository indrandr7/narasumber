@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <style>
        .ratatengah{ text-align: center !important; }
        .ratakanan{ text-align: right; }
        .ratakiri{ text-align: left; }
        .vertikaltengah{ vertical-align: middle !important;}
        .warnabg-gray{
            background-color: #F8F9FA;
        }
    </style>

    <div class="content-header">
      <div class="container-fluid">        
        <nav class="navbar navbar-light bg-light justify-content-between">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/kegiatan') }}">Kegiatan</a></li>
            <li class="breadcrumb-item active">Tambah Baru</li>
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
                            <form class="form-horizontal" id="formulir" name="formulir" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="judulkegiatan" class="col-sm-3 col-form-label">Judul kegiatan</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="kodekegiatan" name="kodekegiatan" value="{{ $kodekegiatan }}">
                                            <input type="hidden" class="form-control" id="formmode" name="formmode" value="{{ $formmode }}">
                                            <input type="input" class="form-control" id="judulkegiatan" name="judulkegiatan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mataanggaran" class="col-sm-3 col-form-label">Mata Anggaran</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2bs4" id="mataanggaran" name="mataanggaran" style="width: 100%;">
                                                @foreach ($mataanggaran as $mak)
                                                <option value="{{ $mak->id_mak }}">{{ $mak->namakegiatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date" id="tanggal" data-target-input="nearest" style="width: 150px;">
                                                <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tanggal"/>
                                                <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tempat" class="col-sm-3 col-form-label">Tempat pelaksanaan</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control" id="tempat" name="tempat" style="width: 450px;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="file_undangan" class="col-sm-3 col-form-label">Upload undangan</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="file_undangan" name="file_undangan" style="width: 250px;">
                                            <input type="hidden" class="form-control" id="file_undangancurrent" name="file_undangancurrent" style="width: 250px;">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="divFile"></div>
                                    <div>
                                        <button type="submit" class="btn btn-success float-right">
                                            <i class="nav-icon fas fa-save"></i>&nbsp;&nbsp;SIMPAN
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <hr>
                            <div class="row form-group">
                                <h5 style="font-weight: bold;margin-left:10px;">Daftar Narasumber</h5>
                                &nbsp;&nbsp;
                                <button id="btnTambahNarsum" class="btn btn-xs btn-success" title="Tambah narasumber" style="padding-left: 10px;padding-right:10px;" data-toggle="modal" data-target="#modalku" onclick="showAddFormNarsum()">
                                    <i class="nav-icon fas fa-plus"></i>
                                </button>
                                <button id="btnMuatUlang" class="btn btn-xs btn-primary" title="Muat ulang data narasumber" style="padding-left: 10px;padding-right:10px;margin-left:5px;" onclick="reloadTable()">
                                    <i class="nav-icon fas fa-sync"></i>
                                </button>
                            </div>

                            <table id="tabeldata" class="table table-bordered table-hover_ table-striped__" width="100%px">
                                <thead>
                                    <tr>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="3%">No</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="18%">Nama narasumber</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="3%">Jam</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="11%">Honor 1 Jam</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="11%">Jumlah Honor</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="5%">PPH</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="10%">Potongan PPH</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="10%">Jumlah Dibayar</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="10%">SPPD</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="12%">Status</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="7%">Aksi</th>
                                      </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
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
        $('#modalku').modal('show').find('#modalku_content').load("{{ url('/kegiatan/narsumedit') }}?id="+id_kegiatandetail);
    }

    function reloadTable(){
        $('#tabeldata').DataTable().ajax.reload();
    }

    function hapus(id_kegiatandetail, id_kegiatan){
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
                    data: {"id_kegiatandetail":id_kegiatandetail, "id_kegiatan":id_kegiatan},
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
        if ($('#formmode').val() == 'addnew'){
            url = "{{ url('/kegiatan/save') }}"
        }else{
            url = "{{ url('/kegiatan/saveupdate') }}"
        }

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

                  var kode_kegiatan = resp.data.kode_kegiatan;
                  window.location.href = "{{ url('/kegiatan/edit') }}"+"/"+kode_kegiatan;
                  
                //   $('#formmode').val('update')
                //   $('#divFile').html('')

                //   var fileUndangan = resp.data.file_undangan;
                //   var id_kegiatan = resp.data.id_kegiatan;
                //   var html;
                //   $('#file_undangan').val('')
                //   $('#file_undangancurrent').val(fileUndangan)

                //   if (fileUndangan == ''){
                //     html = $('#divFile').html('<label for="file_undangan" class="col-sm-3 col-form-label"></label><div class="col-sm-9"><i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;File not available</div>')
                //   }else{
                //     html = $('#divFile').html('<label for="file_undangan" class="col-sm-3 col-form-label"></label><div class="col-sm-9"><a href="{{ url('kegiatan/download?tipe=kegiatan&klm=undangan&id=') }}'+id_kegiatan+'"><i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;'+fileUndangan+'</a></div>')
                //   }
                
                //   $('#btnTambahNarsum').prop('disabled', false)
                //   $('#btnMuatUlang').prop('disabled', false)
                //   reloadTable()
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

        // Inisialisasi tombol
        $('#btnTambahNarsum').prop('disabled', true)
        $('#btnMuatUlang').prop('disabled', true)

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
                {data: 'sppd', name: 'sppd'},
                {data: 'status', name: 'status'},
                {data: 'action'}
            ],
            columnDefs: [
                { className: "ratakanan", "targets": [3,4,5,6,7]},
                { className: "ratatengah", "targets": [2,8]},
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

