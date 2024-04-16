<div class="modal-header">
    <h4 class="modal-title">{{ $judulhalaman }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="formulir" name="formulir" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group row">
            <label for="judulkegiatan" class="col-sm-3 col-form-label">Judul kegiatan</label>
            <div class="col-sm-9">
                <input type="hidden" class="form-control" id="kodekegiatan" value="{{ $kodekegiatan }}">
                <input type="input" class="form-control" id="judulkegiatan" name="mataanggaran">
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
                <input type="input" class="form-control" id="tempat" name="tempat">
            </div>
          </div>
          <div class="form-group row">
            <label for="file_undangan" class="col-sm-3 col-form-label">Upload undangan</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="file_undangan" name="file_undangan" style="width: 250px;">
            </div>
          </div>
          
          <hr><h5>Daftar Narasumber</h5>

          <div class="container" id="dynamic_form">
            <div class="row baru-data" style="margin-bottom:5px;">
                <div class="col-md-4">
                    <input type="text" name="narasumber" placeholder="Nama narasumber" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <input type="number" name="sbm" placeholder="sbm" class="form-control form-control-sm">
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-sm btn-success btn-tambah"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-danger btn-hapus" style="display:none;"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>



        </div>
      </form>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
  </div>

  <script>
    function addForm(){
   var addrow = '<div class="row baru-data" style="margin-bottom:5px;">\
             <div class="col-md-4">\
                 <input type="text" name="narasumber" placeholder="Nama narasumber" class="form-control form-control-sm">\
             </div>\
             <div class="col-md-2">\
                 <input type="number" name="sbm" placeholder="SBM" class="form-control form-control-sm">\
             </div>\
             <div class="button-group">\
                 <button type="button" class="btn btn-sm btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
             </div>\
      </div>'
   $("#dynamic_form").append(addrow);
}

$("#dynamic_form").on("click", ".btn-tambah", function(){
   addForm()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data').remove();
 var bykrow = $(".baru-data").length;
 if(bykrow==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data').last().find('.btn-tambah').css("display","");
 }
});

    $(function(){
        $('#tanggal').datetimepicker({
            format: 'L'
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
    
  </script>