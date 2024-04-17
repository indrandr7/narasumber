<style>
  .invalid-feedback{
    font-weight: normal !important;
    margin-left: 8px;
    margin-bottom: -10px;
  }
</style>

<div class="modal-header">
    <h4 class="modal-title">{{ $judulhalaman }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="formulir" name="formulir" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <div class="card-body">
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Nama lengkap</label>
            <div class="col-sm-9">
              <input type="hidden" class="form-control" value="{{ $pengguna->id }}" id="id_user" name="id_user">
              <input type="text" class="form-control" id="name" name="name" value="{{ $pengguna->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-7">
              <input type="input" class="form-control" id="username" name="username" value="{{ $pengguna->username }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-7">
              <input type="email" class="form-control" id="email" name="email" value="{{ $pengguna->email }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="password" name="password">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Ketik ulang password</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="password_konfirm" name="password_konfirm">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Level</label>
            <div class="col-sm-2">
              <select class="form-control" id="id_user_level" name="id_user_level" style="width: 250%;">
                @foreach ($level as $br)
                  @if ($br->id_user_level == $pengguna->id_user_level)
                  <option value="{{ $br->id_user_level }}" selected>{{ $br->level }}</option>
                  @else
                  <option value="{{ $br->id_user_level }}">{{ $br->level }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Bagian</label>
            <div class="col-sm-3">
              <select class="form-control" id="id_bagian" name="id_bagian" style="width: 300%;">
                @foreach ($bagian as $br)
                    @if ($br->id_bagian == $pengguna->id_bagian)
                    <option value="{{ $br->id_bagian }}" selected>{{ $br->nama_bagian }}</option>
                    @else
                    <option value="{{ $br->id_bagian }}">{{ $br->nama_bagian }}</option>
                    @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Status aktif</label>
            <div class="col-sm-2">
              <select class="form-control" id="is_active" name="is_active" style="width: 250%;">
                @if ($pengguna->is_active == 'yes')
                <option value="yes" selected>Ya</option>
                <option value="no">Tidak</option>
                @else
                <option value="yes">Ya</option>
                <option value="no" selected>Tidak</option>
                @endif
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer justify-content-between__">
          <button type="submit" class="btn btn-success" value="Simpan">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </form>
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
            url: "{{ url('/pengguna/saveupdate') }}",
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
        $('#name').focus()

        $('#formulir').validate({
          rules: {
            name: {
              required: true
            },
            username: {
              required: true,
            },
            email: {
              required: true,
              email: true,
            },
            password: {
              required: false,
            },
            'password_konfirm':{
              equalTo: '#password'
            },
            id_user_level: {
              required: true,
            },
            id_bagian: {
              required: true,
            },
            is_active: {
              required: true,
            },
          }
        });
    });
    
  </script>