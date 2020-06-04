@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
    <div class="container">
    <h4>Selamat datang {{Session::get('username')}}</h4>
  {{-- Tabel --}}
  <div class="card">
    <div class="card-header">
        list User
        <a href="javascript:void(0)" class="btn btn-info ml-2" id="add_student">Tambah Murid</a>
    </div>
   <div class="card-body">
   <table class="table table-bordered table-sm px-auto" id="student" name="student">
    <thead>
        <tr>
            <th>Name</th>
            <th>NIS</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    </table>
    </div>
</div>
</div>
{{--  akhir tabel --}}

{{-- Modal Edit & Tambah--}}
<div class="modal fade" id="add-edit-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crud_student_modal"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="student_form" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="row">
                <div class="form-group col-sm-12">
                    <label for="studentname">Nama lengkap</label>
                    <input type="text" class="form-control" id="student_name" name="student_name">
                </div>
                </div>
                <div class="row">
                <div class="form-group col-sm-12">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="student_password" name="student_password">
                </div>
                </div>
            
                <div class="row">
                <div class="form-group col-sm-12">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" id="student_nis" name="student_nis" placeholder="masukkan nis">
                </div>
                <div class="form-group col-sm-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="student_email" name="student_email" placeholder="masukkan email">   </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                    <label for="inputCity">No. telepon</label>
                    <input type="text" class="form-control" id="student_phone" name="student_phone" placeholder="masukkan nomor telepon">     
                    </div>
                    <div class="form-group col-sm-12">
                    <label for="inputState">Kelas</label>
                    <select id="class_id" name="class_id" class="form-control">
                        <option selected>Choose...</option>
                        <option>1</option>
                    </select>
                    </div>
                </div>
                    <br>
                <button type="submit" class="btn btn-primary" id="btn-save">submit</button>
        </form>
            </div>
                <div class="modal-footer">
                </div>
        </div>
    </div>
</div>
{{-- End Modal --}}

 

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
                <p><b>Jika dihapus maka</b></p>
                <p>*data murid tersebut hilang, apakah anda yakin?</p>
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
            
            $('#student').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/student',
                    columns: [
                        {data: 'student_name', name: 'student_name'},
                        {data: 'student_nis', name: 'student_nis'},
                        {data: 'student_email', name: 'student_email'},
                        {data: 'student_phone', name: 'student_Phone'},
                        {data: 'action', name: 'action' },
            
                    ]
                });

            });
  
      /*  When user click add user button */
      $('#add_student').click(function () {
          $('#btn-save').val("create");
          $('#student_form').trigger("reset");
          $('#crud_student_modal').html("Add New Student");
          $('#add-edit-modal').modal('show');
      });
      
    if ($("#student_form").length > 0) {
         $("#student_form").validate({
    
        submitHandler: function(form) {
    
         var actionType = $('#btn-save').val();
         $('#btn-save').html('Sending..');
         
         $.ajax({
             data: $('#student_form').serialize(),
             url: '/student',   
             type: 'post',
             dataType: 'json',
             success: function (data) {
                //  console.log('ok');
                 $('#student_form').trigger("reset"); //form reset
                             $('#add-edit-modal').modal('hide'); //modal hide
                             $('#btn-save').html('Simpan'); //tombol simpan
                             var oTable = $('#student').dataTable(); //inialisasi datatable
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
      $('body').on('click', '#edit-stdnt', function () {
        var id = $(this).data('id');
        $.get('/student/'+ id +'/edit' , function (data) {
            
           $('#crud_student_modal').html("Edit User");
            $('#btn-save').val("edit-stdnt");
            $('#add-edit-modal').modal('show');
            $('#id').val(data.id);
            $('#student_name').val(data.student_name);
            $('#student_nis').val(data.student_nis);
            $('#student_email').val(data.student_email);
            $('#student_phone').val(data.student_phone);
            $('#class_id').val(data.class_id);
        });
     });
    //  //delete user login
    //  $(document).on('click', '.delete', function () {
    //         user_id = $(this).attr('id');
            
      $('body').on('click', '#delete-stdnt', function () {
          var stdnt_id = $(this).data('id');
          $('#konfirmasi-modal').modal('show');
     
   
     $('#tombol-hapus').click(function () {
          $.ajax({
              type: "DELETE",
              url: '/student/'+ stdnt_id,
              beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
              success: function (data) {
                  $('#id' + stdnt_id).remove();
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#student').dataTable();
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


