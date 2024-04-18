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
                  <li class="breadcrumb-item active"><a href="{{ url('/narasumber') }}">{{ $judulhalaman }}</a></li>
                </ol>
              </nav>
        </div>
        <div class="col-2"></div>
        
      </div>
    </div>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">

                    <div class="card card-info">
                        <div class="card-body">
                          <form class="form-horizontal" id="formulir" name="formulir" method="post" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
                            <div class="card-body">
                              <div class="form-group row">
                                <label for="mataanggaran" class="col-sm-5 col-form-label">Password sekarang</label>
                                <div class="col-sm-7">
                                  <input type="password" class="form-control" id="password_sekarang" name="password_sekarang">
                                  <input type="hidden" class="form-control" value="{{ Session::get('sesUserID') }}" id="id_user" name="id_user">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="mataanggaran" class="col-sm-5 col-form-label">Password baru</label>
                                <div class="col-sm-7">
                                  <input type="password" class="form-control" id="password_baru" name="password_baru">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="mataanggaran" class="col-sm-5 col-form-label">Password baru konfirmasi</label>
                                <div class="col-sm-7">
                                  <input type="password" class="form-control" id="password_baru_konfirm" name="password_baru_konfirm">
                                </div>
                              </div>
                            </div>
                    
                            <div class="modal-footer justify-content-between__">
                              <button type="submit" class="btn btn-success" value="Simpan">Simpan</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                            </div>
                          </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
  </div>
</div>
  
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.setDefaults({
      submitHandler: function(){
        event.preventDefault();
        proceed = true;

        $.ajax({
            url: "{{ url('/pengguna/passwordupdate') }}",
            type: 'POST',
            data: new FormData($('#formulir')[0]),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(resp){
                if (resp.result == "success"){
                  toastr.success(resp.message)
                  $('#modalku').modal('toggle');
                  reloadTable()
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

    $(function(){
        $('#tanggal').datetimepicker({ format: 'L' });
        $('.select2bs4').select2({ theme: 'bootstrap4' });
        $('#password_sekarang').focus()

        $('#formulir').validate({
          rules: {
            password_sekarang: {
              required: true
            },
            password_baru: {
              required: true,
            },
            'password_baru_konfirm':{
              required: true,
              equalTo: '#password_baru'
            },
          }
        });
    });
    
  </script>
  @endsection