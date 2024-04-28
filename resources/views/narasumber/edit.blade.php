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
    <form class="form-horizontal" id="formulirNarsum" name="formulirNarsum" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <div class="card-body">
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Nama lengkap</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" value="{{ $narasumber->namalengkap }}" id="namalengkap" name="namalengkap">
              <input type="hidden" class="form-control" value="{{ $narasumber->id_narasumber }}" id="id_narasumber" name="id_narasumber">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">NIP/NIK</label>
            <div class="col-sm-5">
              <input type="input" class="form-control" value="{{ $narasumber->nomor_identitas }}" id="nomor_identitas" name="nomor_identitas">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Status kepegawaian</label>
            <div class="col-sm-3">
              <select class="form-control" id="status_kepegawaian" name="status_kepegawaian" style="width: 130%;">
                @if ($narasumber->status_kepegawaian == 'asn')
                <option value="asn" selected>ASN</option>
                <option value="nonasn" selected>Non ASN</option>
                @else
                <option value="asn">ASN</option>
                <option value="nonasn" selected>Non ASN</option>
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-8">
              <input type="input" class="form-control" value="{{ $narasumber->jabatan }}" id="jabatan" name="jabatan">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Eselon</label>
            <div class="col-sm-4">
              <select class="form-control" id="eselon" name="eselon" style="width: 130%;">
                @foreach ($eselon as $es)
                  @if ($es->id_eselon == $narasumber->id_eselon)
                  <option value="{{ $es->id_eselon }}" selected>{{ $es->eselon }}</option>
                  @else
                  <option value="{{ $es->id_eselon }}">{{ $es->eselon }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Golongan</label>
            <div class="col-sm-3">
              <select class="form-control" id="golongan" name="golongan" style="width: 130%;">
                @foreach ($golongan as $gol)
                  @if ($gol->id_golongan == $narasumber->id_golongan)
                  <option value="{{ $gol->id_golongan }}" selected>{{ $gol->golongan }}</option>
                  @else
                  <option value="{{ $gol->id_golongan }}">{{ $gol->golongan }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tempat" class="col-sm-3 col-form-label">Unit kerja</label>
            <div class="col-sm-9">
                <input type="input" class="form-control" value="{{ $narasumber->unitkerja }}" id="unit_kerja" name="unit_kerja">
            </div>
          </div>
          <div class="form-group row">
            <label for="tempat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <input type="input" class="form-control" value="{{ $narasumber->alamat_unitkerja }}" id="alamat" name="alamat">
            </div>
          </div>
          <div class="form-group row">
            <label for="tempat" class="col-sm-3 col-form-label">Nomor telpon</label>
            <div class="col-sm-4">
                <input type="input" class="form-control" value="{{ $narasumber->nomor_telpon }}" id="nomor_telpon" name="nomor_telpon">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-5">
              <input type="input" class="form-control" value="{{ $narasumber->email }}" id="email" name="email" value=""> 
            </div>
          </div>
          <div class="form-group row">
            <label for="potongan" class="col-sm-3 col-form-label">Nama bank</label>
            <div class="col-sm-5">
                <input type="input" class="form-control" value="{{ $narasumber->nama_bank }}" id="nama_bank" name="nama_bank">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Nomor rekening</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" value="{{ $narasumber->nomor_rekening }}" id="nomor_rekening" name="nomor_rekening">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Nama di rekening</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" value="{{ $narasumber->nama_rekening }}" id="nama_rekening" name="nama_rekening">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Nomor NPWP</label>
            <div class="col-sm-5">
                <input type="input" class="form-control" value="{{ $narasumber->nomor_npwp }}" id="nomor_npwp" name="nomor_npwp">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Upload NPWP</label>
            <div class="col-sm-5">
                <input type="file" class="form-control" id="file_npwp" name="file_npwp">
                <input type="hidden" class="form-control" value="{{ $narasumber->file_npwp }}" id="file_npwpcurrent" name="file_npwpcurrent">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              @if ($narasumber->file_npwp != '')
                <a href="{{ url('/narasumber/unduh?id='.$narasumber->id_narasumber) }}">
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $narasumber->file_npwp }}
                </a>
              @else
                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
              @endif
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
            url: "{{ url('/narasumber/saveupdate') }}",
            type: 'POST',
            data: new FormData($('#formulirNarsum')[0]),
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

        $('#formulirNarsum').validate({
          rules: {
            namalengkap: {
              required: true
            },
            eselon: {
              required: true,
            },
            golongan: {
              required: true,
            },
            nama_bank: {
              required: true,
            },
            nomor_rekening: {
              required: true,
            },
            email: {
              email: true
            },
          }
        });
    });
    
  </script>