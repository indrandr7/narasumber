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
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Bagian</label>
            <div class="col-sm-9">
              <select class="form-control" id="id_bagian" name="id_bagian">
                @foreach ($bagian as $bg)
                    <option value="{{ $bg->id_bagian }}">{{ $bg->nama_bagian }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Kode MAK</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="kodemak" name="kodemak">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Nama Kegiatan</label>
            <div class="col-sm-9">
              <input type="input" class="form-control" id="namakegiatan" name="namakegiatan">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Tahun</label>
            <div class="col-sm-2">
              <input type="input" class="form-control" id="tahun" name="tahun" number>
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
            url: "{{ url('/mataanggaran/save') }}",
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

        $('#formulir').validate({
          rules: {
            id_bagian: {
              required: true,
            },
            kodemak: {
              required: true,
            },
            namakegiatan: {
              required: true,
            },
            tahun: {
              required: true,
              number: true,
            },
          }
        });
    });
    
  </script>