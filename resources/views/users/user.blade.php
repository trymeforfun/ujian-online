@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
    <div class="container">
    <h4>Selamat datang {{Session::get('username')}}</h4>
  {{-- Tabel --}}
    <div class="card-header">
        list User
        <a href="javascript:void(0)" class="btn btn-info ml-2" id="create-new-user">Tambah Pengguna</a>
    </div>
   <div class="card-body mx-auto">
   <table class="table table-bordered table-sm px-auto" id="example" name="example">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>level</th>
            <th>Email</th>
            <th>Active</th>
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
                <h5 class="modal-title" id="user-crud-modal"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="user-form" name="user-form" class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-12">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="" class="col-sm-12 control-label">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                                    value="" >
                                        @error('username')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-12 control-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">level</label>
                                <div class="col-sm-12">
                                    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                        <option value="">Pilih level</option>
                                        <option value="staff">staff</option>
                                        <option value="guru">guru</option>
                                    </select>
                                    @error('level')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">E-mail</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">active</label>
                                <div class="col-sm-12">
                                    <input type="checkbox" name="assignment_active" data-id="id" data-offstyle="warning" data-onstyle="success" data-toggle="toggle" class="toggle-class" {{'is_active' == true ? 'checked' : '' }}>
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
                <p><b>Jika menghapus User maka</b></p>
                <p>*data User tersebut hilang selamanya, apakah anda yakin?</p>
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
            
            $('#example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: 'user/json',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'username', name: 'username'},
                        {data: 'level', name: 'level'},
                        {data: 'email', name: 'email'},
                        {data: 'is_active', name: 'level'},
                        {data: 'action',name: 'action' },
            
                    ]
                });

            
        });
      /*  When user click add user button */
      $('#create-new-user').click(function () {
          $('#btn-save').val("create");
          $('#user-form').trigger("reset");
          $('#user-crud-modal').html("Add New User");
          $('#add-edit-modal').modal('show');
      });
    if ($("#user-form").length > 0) {
         $("#user-form").validate({
    
        submitHandler: function(form) {
    
         var actionType = $('#btn-save').val();
         $('#btn-save').html('Sending..');
         
         $.ajax({
             data: $('#user-form').serialize(),
             url: 'user/store',   
             type: 'post',
             dataType: 'json',
             success: function (data) {
                //  console.log('ok');
                 $('#user-form').trigger("reset"); //form reset
                             $('#add-edit-modal').modal('hide'); //modal hide
                             $('#btn-save').html('Simpan'); //tombol simpan
                             var oTable = $('#example').dataTable(); //inialisasi datatable
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
                alert('Please fill the input field');
                $('#add-edit-modal').on('hidden.bs.modal', function() {
                    $(this).removeData('bs.modal');
                });
                $('#btn-save').html('Save Changes');
             }
         });
       }
     });
    }
   
     /* When click edit user */
      $('body').on('click', '#edit-user', function () {
        var id = $(this).data('id');
        $.get('/user/edit/'+ id , function (data) {
            
           $('#user-crud-modal').html("Edit User");
            $('#btn-save').val("edit-user");
            $('#add-edit-modal').modal('show');
            $('#id').val(data.id);
            $('#username').val(data.username);
            $('#password').val(data.password);
            $('#level').val(data.level);
            $('#email').val(data.email);
            $('#is_active').val(data.is_active);
        });
     });
     //delete user login
    //  $(document).on('click', '.delete', function () {
    //         user_id = $(this).attr('id');
            
      $('body').on('click', '#delete-user', function () {
          var user_id = $(this).data('id');
          $('#konfirmasi-modal').modal('show');
     
   
     $('#tombol-hapus').click(function () {
          $.ajax({
              type: "DELETE",
              url: 'user/delete/'+ user_id,
              beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
              success: function (data) {
                  $('#id' + user_id).remove();
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#example').dataTable();
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


