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
            <label for="narasumber" class="col-sm-3 col-form-label">Nama Narasumber</label>
            <div class="col-sm-9">
                <input type="hidden" class="form-control" id="kodekegiatan" name="kodekegiatan" value="{{ $kodekegiatan }}">
                <select class="form-control select2bs4" id="narasumber" name="narasumber" style="width: 100%;">
                  <option value="">Pilih Narasumber</option>
                  @if ($narasumber->count() == 0)
                    <option value="">Tidak ditemukan data narasumber</option>
                  @else
                    @foreach ($narasumber->get() as $narsum)
                      <option value="{{ $narsum->id_narasumber }}">{{ $narsum->namalengkap.($narsum->unitkerja == '' ? '' : ' - '.$narsum->unitkerja) }}</option>
                    @endforeach    
                  @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Jumlah jam</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="jumlahjam" name="jumlahjam" min="1" max="12" style="width: 100px">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Eselon/golongan</label>
            <div class="col-sm-2">
              <input type="input" class="form-control" id="eselon" name="eselon">
            </div>
            <div class="col-sm-1">
              <input type="input" class="form-control" id="golongan" name="golongan">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Honor per jam (Rp)</label>
            <div class="col-sm-3">
              <input type="input" class="form-control" id="sbm" name="sbm">
            </div>
          </div>
          <div class="form-group row">
            <label for="tempat" class="col-sm-3 col-form-label">Jumlah honor (Rp)</label>
            <div class="col-sm-3">
                <input type="input" class="form-control" id="jumlahhonor" name="jumlahhonor">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">PPH Pasal 21</label>
            <div class="col-sm-2">
              <input type="input" class="form-control" id="pph" name="pph" value=""> 
            </div>
            <label class="col-sm-1 col-form-label">%</label>
          </div>
          <div class="form-group row">
            <label for="potongan" class="col-sm-3 col-form-label">Jumlah potongan (Rp)</label>
            <div class="col-sm-3">
                <input type="input" class="form-control" id="jumlahpotongan" name="jumlahpotongan">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Jumlah dibayar (Rp)</label>
            <div class="col-sm-3">
                <input type="input" class="form-control" id="jumlahbayar" name="jumlahbayar">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Upload surat tugas</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" id="surattugas" name="surattugas">
            </div>
            <div class="col-sm-5 mt-2">
              <a href="" target="_blank">Draft ST internal</a> | <a href="" target="_blank">Draft surat keterangan</a>
            </div>
          </div>
          <hr />
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Perjalanan dinas</label>
            <div class="col-sm-3">
              <select class="form-control" id="perjadin" name="perjadin" style="width: 130%;">
                <option value="yes">Ya</option>
                <option value="no" selected>Tidak</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Nomimal Perjadin (Rp)</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="nominalperjadin" name="nominalperjadin">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Upload kwitansi</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" id="kwitansiperjadin" name="kwitansiperjadin">
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

    $('#narasumber').change(function(){
      var id_narsum = $('#narasumber').val();

      $.ajax({
        url: "{{ url('/kegiatan/getnarsum') }}",
        type: 'POST',
        data: { "_token": "{{ csrf_token() }}", "id_narsum": id_narsum},
        dataType: 'json',
        processData: true,
        success: function(resp){
            if (resp.status == 'sukses'){
              $('#jumlahjam').focus();
              $('#eselon').val(resp.data['eselon'])
              $('#golongan').val(resp.data['golongan'])
              $('#sbm').val(formatUang(resp.data['sbm']))
              $('#pph').val(resp.data['pph'])
            }else{
              alert('Status: '+resp.status+', '+resp.msg)
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
                console.log('jqXMLHTTReq: '+jqXHR+', Status: '+textStatus+', Error: '+errorThrown);
            },
      });
    })

    $('#jumlahjam').change(function(){
      var jumlahhonor = parseInt($('#jumlahjam').val()) * parseInt(formatRawNumber($('#sbm').val()))
      var jumlahpotongan = jumlahhonor * (parseInt($('#pph').val()) / 100)
      var jumlahbayar = jumlahhonor - jumlahpotongan

      $('#jumlahhonor').val(formatUang(jumlahhonor))
      $('#jumlahpotongan').val(formatUang(jumlahpotongan))
      $('#jumlahbayar').val(formatUang(jumlahbayar))
    })

    function formatUang(nominal) {
      //Seperates the components of the number
      var components = nominal.toString().split(".");
      //Comma-fies the first part
      components [0] = components [0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      //Combines the two sections
      return components.join(".");
    }

    function formatRawNumber(nominal){
      return nominal.split('.').join('')
    }

    $('#perjadin').change(function(){
      if ($('#perjadin').val() == 'yes'){
        $('#nominalperjadin').prop('disabled', false);
        $('#kwitansiperjadin').prop('disabled', false);
        $('#nominalperjadin').val('0')
      }else{
        $('#nominalperjadin').prop('disabled', true);
        $('#kwitansiperjadin').prop('disabled', true);
        $('#nominalperjadin').val('');
      }
    });

    $.validator.setDefaults({
      submitHandler: function(){
        event.preventDefault();
        proceed = true;

        $.ajax({
            url: "{{ url('/kegiatan/narsumsave') }}",
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
        $('#nominalperjadin').prop('disabled', true);
        $('#kwitansiperjadin').prop('disabled', true);

        $('#formulirNarsum').validate({
          rules: {
            narasumber: {
              required: true
            },
            jumlahjam: {
              required: true,
              number: true
            },
            jumlahhonor: {
              required: true,
            },
            jumlahpotongan: {
              required: true,
            },
            jumlahbayar: {
              required: true,
            },
          }
        });
    });
    
  </script>