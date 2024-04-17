@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <style>
        .ratatengah{ text-align: center !important; }
        .ratakanan{ text-align: right; }
        .ratakiri{ text-align: left; }
        .vertikaltengah{ vertical-align: middle !important; }
        .warnabg-gray{
            background-color: #F8F9FA;
        }
    </style>

    <div class="content-header">
      <div class="row">
        <div class="col-10">
            <nav class="navbar navbar-light__ bg-light__ justify-content-between">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('/narasumber') }}">{{ $judulhalaman }}</a></li>
                  <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
              </nav>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success float-right" style="margin-right: 10px;" data-toggle="modal" data-target="#modalku" onclick="showFormAdd()">
                <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Tambah Baru
            </button>
        </div>
        
      </div>
    </div>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-info">
                        <div class="card-body">
                            <table id="tabeldata" class="table table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="5%">No</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="25%">Nama Lengkap</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="25%">Username</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="15%">Level</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="15%">Bagian</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="10%">Is Active</th>
                                        <th class="ratatengah warnabg-gray vertikaltengah" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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

    function showFormAdd(){
        $('#modalku').modal('show').find('#modalku_content').load("{{ url('/pengguna/add') }}");
    }

    function showFormEdit(id){
        $('#modalku').modal('show').find('#modalku_content').load("{{ url('/pengguna/edit') }}?id="+id);
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
					url: "{{ url('/pengguna/delete') }}",
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

    $(function (){
        // $('#judulkegiatan').focus();
        // $('.select2bs4').select2({ theme: 'bootstrap4' });

        var table = $('#tabeldata').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/pengguna/getlist') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namalengkap', name: 'namalengkap'},
                {data: 'username', name: 'username'},
                {data: 'level', name: 'level'},
                {data: 'bagian', name: 'bagian'},
                {data: 'isactive', name: 'isactive'},
                {data: 'action'}
            ],
            columnDefs: [
                // { className: "ratakanan", "targets": [3,4,5,6,7]},
                { className: "ratatengah", "targets": [5,6]},
                // { className: "ndrparagraf", "targets": "_all"},
            ]
        });
    })
  </script>
@endsection

