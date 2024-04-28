<style>
  .invalid-feedback{
    font-weight: normal !important;
    margin-left: 8px;
    margin-bottom: -10px;
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
  }
</style>

<div class="modal-header">
    <h4 class="modal-title">{{ $judulhalaman }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <table id="tabeldata2" class="table table-bordered_ table-hover_ table-striped_" width="100%">
      <tbody>
        <tr>
            <td style="width: 30%;" class="top-borderless padtopbot"><strong>Nama narasumber</strong></td>
            <td style="width: 2%;" class="top-borderless padr-0_ padtopbot">:</td>
            <td style="width: 68%;" class="top-borderless padl-2 padtopbot">{{ $kegdetail->namalengkap }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Jumlah jam</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ $kegdetail->jumlah_jam }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Eselon/golongan</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ $kegdetail->eselon.'/'.$kegdetail->golongan }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Honor per jam (Rp)</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ Gudangfungsi::formatrupiah($kegdetail->honor_satujam) }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Jumlah honor (Rp)</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ Gudangfungsi::formatrupiah($kegdetail->jumlahhonor) }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>PPH Pasal 21</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ $kegdetail->pph }}%</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Jumlah potongan (Rp)</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ Gudangfungsi::formatrupiah($kegdetail->potongan_pph) }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Jumlah dibayar (Rp)</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ Gudangfungsi::formatrupiah($kegdetail->jumlah_bayar) }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Surat tugas</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">
              @if ($kegdetail->file_surattugas != '')
                <a href="{{ url('kegiatan/download?id='.$kegdetail->id_kegiatan).'&tipe=kegdetail&klm=surattugas' }}">
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegdetail->file_surattugas }}
                </a>
              @else
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
              @endif
            </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <table id="tabeldata2" class="table table-bordered_ table-hover_ table-striped_" width="100%">
      <tbody>
        <tr>
            <td style="width: 30%;" class="top-borderless padtopbot"><strong>Perjalanan dinas (SPPD)</strong></td>
            <td style="width: 2%;" class="top-borderless padr-0_ padtopbot">:</td>
            <td style="width: 68%;" class="top-borderless padl-2 padtopbot">
              @if ($kegdetail->is_sppd == 'yes')
                  Ya
              @else
                  Tidak
              @endif
            </td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Nominal SPPD (Rp)</strong></td>
            <td class="top-borderless padr-0_ padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ Gudangfungsi::formatrupiah($kegdetail->nominal_sppd) }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>File kwitansi</strong></td>
            <td class="top-borderless padr-0_ padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">
              @if ($kegdetail->file_kwitansi != '')
                <a href="{{ url('kegiatan/download?id='.$kegdetail->id_kegiatan).'&tipe=kegdetail&klm=kwitansi' }}">
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegdetail->file_kwitansi }}
                </a>
              @else
                  <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
              @endif
            </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h5 style="font-weight: bold;"><u>Pembarayan Narasumber</u></h5>
    <table id="tabeldata2" class="table table-bordered_ table-hover_ table-striped_" width="100%">
      <tbody>
        <tr>
            <td style="width: 30%;" class="top-borderless padtopbot"><strong>Status bayar/transfer</strong></td>
            <td style="width: 2%;" class="top-borderless padr-0_ padtopbot">:</td>
            <td style="width: 68%;" class="top-borderless padl-2 padtopbot">
            @if ($kegdetail->is_transfer == 'yes')
              <span class="right badge badge-success">Sudah</span>
            @else
              <span class="right badge badge-danger">Belum</span>
            @endif
            </td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Tanggal bayar/transfer</strong></td>
            <td class="top-borderless padr-0_ padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ ($kegdetail->tanggal_transfer == '' ? '-' : Gudangfungsi::tanggalindo($kegdetail->tanggal_transfer)) }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Nomor SPM</strong></td>
            <td class="top-borderless padr-0_ padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">{{ $kegdetail->no_spm }}</td>
        </tr>
        <tr>
            <td class="top-borderless padtopbot"><strong>Bukti bayar</strong></td>
            <td class="top-borderless padr-0 padtopbot">:</td>
            <td class="top-borderless padl-2 padtopbot">
            @if ($kegdetail->file_transfer != '')
                <a href="{{ url('kegiatan/lihatbuktitransfer?id='.$kegdetail->id_kegiatandetail) }}" target="_blank">
                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;{{ $kegdetail->file_transfer }}
                </a>
            @else
                <i class="nav-icon fas fa-cloud-download-alt"></i>&nbsp;&nbsp;No file available
            @endif
            </td>
        </tr>
      </tbody>
    </table>

    <hr>

    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title">Verifikasi</h3>
      </div>
      <form class="form-horizontal" id="formulir" name="formulir" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group row">
            <label for="judulkegiatan" class="col-sm-3 col-form-label">Status Verifikasi</label>
            <div class="col-sm-9">
              <input type="hidden" class="form-control" name="id_kegiatandetail" value="{{ $kegdetail->id_kegiatandetail }}">
              <select class="form form-control" id="is_verified" name="is_verified" style="width:200px">
                <option value="yes">Disetujui</option>
                <option value="no">Ditolak</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="judulkegiatan" class="col-sm-3 col-form-label">Komentar</label>
            <div class="col-sm-9">
              <textarea id="verified_comment" name="verified_comment" class="form form-control">{{ $kegdetail->verified_comment }}</textarea>
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-success float-right">
                <i class="nav-icon fas fa-save"></i>&nbsp;&nbsp;SIMPAN
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function reloadTable(){
        $('#tabeldata').DataTable().ajax.reload();
    }

    $.validator.setDefaults({
      submitHandler: function(){
        event.preventDefault();
        proceed = true;

        $.ajax({
            url: "{{ url('/kegiatan/verifikasibayar_save') }}",
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
        $('#formulir').validate({
          rules: {
            statusverifikasi: {
              required: true
            },
          }
        });
    });
    
  </script>