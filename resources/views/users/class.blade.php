@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
    <div class="container">
    <h4>Selamat datang {{Session::get('username')}}</h4>
  {{-- Tabel --}}
    <div class="card-header">
        list Kelas
        <a href="javascript:void(0)" class="btn btn-info ml-2" id="create-new-class">Tambah Kelas</a>
    </div>
   <div class="card-body mx-auto">
   <table class="table table-bordered table-sm px-auto" id="kelas" name="kelas">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama Kelas</th>
            <th>Dibuat</th>
            <th>Action</th>
        </tr>
    </thead>
    </table>
    </div>
</div>
{{--  akhir tabel --}}

 <!-- MULAI MODAL FORM TAMBAH/EDIT-->
 <div class="modal fade" id="add-edit-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kelas_modal"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="kelas_form" name="kelas_form" class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-12">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="" class="col-sm-12 control-label">Nama Kelas</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="class_name" name="kelas_name"
                                        value="" required>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-offset-2 col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-save"
                                value="create">Simpan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- AKHIR MODAL -->

<!-- MULAI MODAL KONFIRMASI DELETE-->

<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus Kelas maka</b></p>
                <p>*data tersebut hilang selamanya, apakah anda yakin?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div>

<!-- AKHIR MODAL -->

{{-- script --}}

<script type="text/javascript">

    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    }); 
        $(document).ready(function () {
            
            $('#kelas').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/kelas',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'kelas_name', name: 'kelas_name'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'}
            
                    ]
                });

            
        });
      /*  When user click add user button */
      $('#create-new-class').click(function () {
          $('#btn-save').val("create");
          $('#kelas_form').trigger("reset");
          $('#kelas_modal').html("Add New kelas");
          $('#add-edit-modal').modal('show');
      });
    if ($("#kelas_form").length > 0) {
         $("#kelas_form").validate({
    
        submitHandler: function(form) {
    
         var actionType = $('#btn-save').val();
         $('#btn-save').html('Sending..');
         
         $.ajax({
             data: $('#kelas_form').serialize(),
             url: '/kelas',   
             type: 'post',
             dataType: 'json',
             success: function (data) {
                //  console.log('ok');
                 $('#kelas_form').trigger("reset"); //form reset
                             $('#add-edit-modal').modal('hide'); //modal hide
                             $('#btn-save').html('Simpan'); //tombol simpan
                             var oTable = $('#kelas').dataTable(); //inialisasi datatable
                             oTable.fnDraw(false); //reset datatable
                             iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                 title: 'Data Berhasil Disimpan',
                                 message: '{{ Session('
                                 success ')}}',
                                 position: 'bottomRight'
                             });
                         }
                 ,
             error: function (data) {
                 console.log('Error:', data);
                 $('#btn-save').html('Save Changes');
             }
         });
       }
     });
    }
   
     /* When click edit user */
      $('body').on('click', '#edit_kelas', function () {
        var id = $(this).data('id');
        $.get('/kelas/'+ id +'/edit', function (data) {
            
           $('#kelas_modal').html("Edit Kelas");
            $('#btn-save').val("Simpan");
            $('#add-edit-modal').modal('show');
            $('#id').val(data.id);
            $('#class_name').val(data.kelas_name);
            // $('#lesson_created').val(data.lesson_created);
        });
     });
     //delete user login
    //  $(document).on('click', '.delete', function () {
    //         user_id = $(this).attr('id');
            
      $('body').on('click', '#delete_kelas', function () {
          var lesson_id = $(this).data('id');
          $('#konfirmasi-modal').modal('show');
     
   
     $('#tombol-hapus').click(function () {
          $.ajax({
              type: "DELETE",
              url: 'kelas/'+ lesson_id,
              beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
              success: function (data) {
                  $('#id' + lesson_id).remove();
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#kelas').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });   
    });
</script>
    
    

 

    
@endsection


