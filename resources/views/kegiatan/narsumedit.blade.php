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
                <input type="hidden" class="form-control" id="id_kegiatandetail" name="id_kegiatandetail" value="{{ $kegdetail->id_kegiatandetail }}">
                <select class="form-control select2bs4" id="narasumber" name="narasumber" style="width: 100%;">
                  <option value="">Pilih Narasumber</option>
                  @if ($narasumber->count() == 0)
                    <option value="">Tidak ditemukan data narasumber</option>
                  @else
                    @foreach ($narasumber->get() as $narsum)
                      @if ($narsum->id_narasumber == $kegdetail->id_narasumber)
                        <option value="{{ $narsum->id_narasumber }}" selected>{{ $narsum->namalengkap.($narsum->unitkerja == '' ? '' : ' - '.$narsum->unitkerja) }}</option>
                      @else
                        <option value="{{ $narsum->id_narasumber }}">{{ $narsum->namalengkap.($narsum->unitkerja == '' ? '' : ' - '.$narsum->unitkerja) }}</option>
                      @endif
                    @endforeach    
                  @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Jumlah jam</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="jumlahjam" name="jumlahjam" value="{{ $kegdetail->jumlah_jam }}" min="1" max="12" style="width: 100px">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Eselon/golongan</label>
            <div class="col-sm-2">
              <input type="input" class="form-control" id="eselon" name="eselon" value="{{ $goles->eselon }}">
            </div>
            <div class="col-sm-1">
              <input type="input" class="form-control" id="golongan" name="golongan" value="{{ $goles->golongan }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">Honor per jam (Rp)</label>
            <div class="col-sm-3">
              <input type="input" class="form-control" id="sbm" name="sbm" value="{{ Gudangfungsi::formatuang($kegdetail->honor_satujam) }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="tempat" class="col-sm-3 col-form-label">Jumlah honor (Rp)</label>
            <div class="col-sm-3">
                <input type="input" class="form-control" id="jumlahhonor" name="jumlahhonor" value="{{ Gudangfungsi::formatuang($kegdetail->jumlahhonor) }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="mataanggaran" class="col-sm-3 col-form-label">PPH Pasal 21</label>
            <div class="col-sm-2">
              <input type="input" class="form-control" id="pph" name="pph" value="{{ $kegdetail->pph }}"> 
            </div>
            <label class="col-sm-1 col-form-label">%</label>
          </div>
          <div class="form-group row">
            <label for="potongan" class="col-sm-3 col-form-label">Jumlah potongan (Rp)</label>
            <div class="col-sm-3">
                <input type="input" class="form-control" id="jumlahpotongan" name="jumlahpotongan" value="{{ Gudangfungsi::formatuang($kegdetail->potongan_pph) }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Jumlah dibayar (Rp)</label>
            <div class="col-sm-3">
                <input type="input" class="form-control" id="jumlahbayar" name="jumlahbayar" value="{{ Gudangfungsi::formatuang($kegdetail->jumlah_bayar) }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Upload surat tugas</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" id="surattugas" name="surattugas">
                <input type="hidden" class="form-control" id="surattugas_current" name="surattugas_current" value="{{ $kegdetail->file_surattugas }}">
            </div>
            <div class="col-sm-5 mt-2">
              <a href="{{ url('kegiatan/downloadst') }}">Draft Surat Tugas</a>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              @if ($kegdetail->file_surattugas != '')
                <a href="{{ url('kegiatan/download?id='.$kegdetail->id_kegiatan).'&tipe=kegdetail&klm=surattugas' }}">
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegdetail->file_surattugas }}
                </a>
              @else
                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
              @endif
            </div>
          </div>
          <hr />
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Perjalanan dinas</label>
            <div class="col-sm-3">
              <select class="form-control" id="perjadin" name="perjadin" style="width: 130%;">
                <option value="">Pilih perjalanan dinas</option>
                @if ($kegdetail->is_sppd == 'yes')
                  <option value="yes" selected>Ya</option>
                  <option value="no">Tidak</option>    
                @else
                  <option value="yes">Ya</option>
                  <option value="no" selected>Tidak</option>
                @endif
                
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Nomimal Perjadin (Rp)</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="nominalperjadin" name="nominalperjadin" value="{{ Gudangfungsi::formatuang($kegdetail->nominal_sppd) }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Upload kwitansi</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" id="kwitansiperjadin" name="kwitansiperjadin">
                <input type="hidden" class="form-control" id="kwitansiperjadin_current" name="kwitansiperjadin_current" value="{{ $kegdetail->file_surattugas }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              @if ($kegdetail->file_kwitansi != '')
                <a href="{{ url('kegiatan/download?id='.$kegdetail->id_kegiatan).'&tipe=kegdetail&klm=kwitansi' }}">
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegdetail->file_kwitansi }}
                </a>
              @else
                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
              @endif
            </div>
          </div>

          <hr />
          <h5 style="font-weight: bold;"><u>Status Pembayaran Narasumber</u></h5>
          <br>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Status cair</label>
            <div class="col-sm-3">
              <select class="form-control" id="statuscair" name="statuscair" style="width: 130%;">
                @if ($kegdetail->is_cair == 'yes')
                  <option value="yes" selected>Ya</option>
                  <option value="no">Tidak</option>    
                @else
                  <option value="yes">Ya</option>
                  <option value="no" selected>Tidak</option>
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Status bayar/transfer</label>
            <div class="col-sm-3">
              <select class="form-control" id="statustransfer" name="statustransfer" style="width: 130%;">
                @if ($kegdetail->is_transfer == 'yes')
                  <option value="yes" selected>Ya</option>
                  <option value="no">Tidak</option>    
                @else
                  <option value="yes">Ya</option>
                  <option value="no" selected>Tidak</option>
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal bayar/transfer</label>
            <div class="col-sm-9">
                <div class="input-group date" id="tanggaltransfer" data-target-input="nearest" style="width: 150px;">
                    @php
                      if ($kegdetail->tanggal_transfer == ''){
                        $tanggaltf = '';
                      }else{
                        $tanggaltf = Gudangfungsi::tanggalformulir($kegdetail->tanggal_transfer);
                      }
                    @endphp
                    <input type="text" name="tanggaltransfer" value="{{ $tanggaltf }}" class="form-control datetimepicker-input" data-target="#tanggaltransfer"/>
                    <div class="input-group-append" data-target="#tanggaltransfer" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Nomor SPM</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nomorspm" name="nomorspm" value="{{ $kegdetail->no_spm }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Upload bukti bayar</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" id="buktitransfer" name="buktitransfer">
                <input type="hidden" class="form-control" id="buktitransfer_current" name="buktitransfer_current" value="{{ $kegdetail->file_transfer }}">
            </div>
            <div class="col-sm-5 mt-2">
              Tipe file gambar (png/jpg/jpeg/gif)
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              @if ($kegdetail->file_transfer != '')
                <a href="{{ url('kegiatan/download?id='.$kegdetail->id_kegiatan).'&tipe=kegdetail&klm=transfer' }}">
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegdetail->file_transfer }}
                </a>
              @else
                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahdibayar" class="col-sm-3 col-form-label">Komentar Verifikasi</label>
            <div class="col-sm-9">
              <textarea disabled class="form form-control">{{ $kegdetail->verified_comment }}</textarea>
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
        $('#nominalperjadin').focus();
      }else{
        $('#nominalperjadin').prop('disabled', true);
        $('#kwitansiperjadin').prop('disabled', true);
      }
    });

    $.validator.setDefaults({
      submitHandler: function(){
        event.preventDefault();
        proceed = true;

        $.ajax({
            url: "{{ url('/kegiatan/narsumsaveupdate') }}",
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
        $('#tanggaltransfer').datetimepicker({ format: 'L' });
        $('.select2bs4').select2({ theme: 'bootstrap4' });
        $('#narasumber').prop('disabled', true);
        $('#eselon').prop('disabled', true);
        $('#golongan').prop('disabled', true);
        $('#pph').prop('disabled', true);
        $('#sbm').prop('disabled', true);

        if ("{{ $kegdetail->is_sppd }}" == 'yes'){
          $('#nominalperjadin').prop('disabled', false);
          $('#kwitansiperjadin').prop('disabled', false);
        }else{
          $('#nominalperjadin').prop('disabled', true);
          $('#kwitansiperjadin').prop('disabled', true);
        }

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