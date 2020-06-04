@extends('layouts.app_user')

@section('title', 'Create Student')
@section('content')


<div class="container">
  
    <h4 id=""></h4>
    <hr>
{{-- <div class="card px-2"> --}}
<form id="imageUploadForm" method="post" action="/student" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" id="id">
    <div class="row">
    <div class="form-group col-md-6">
      <label for="studentname">Nama lengkap</label>
      <input type="text" class="form-control" id="student_name" name="student_name">
  </div>
    </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="student_password" name="student_password">
    </div>
  </div>

    <div class="row">
    <div class="form-group col-md-3">
      <label for="nis">NIS</label>
      <input type="text" class="form-control" id="student_nis" name="student_nis" placeholder="masukkan nis">
    </div>
    <div class="form-group col-md-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="student_email" name="student_email" placeholder="masukkan email">   </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="inputCity">No. telepon</label>
        <input type="text" class="form-control" id="student_phone" name="student_phone" placeholder="masukkan nomor telepon">     
      </div>
      <div class="form-group col-md-3">
        <label for="inputState">Kelas</label>
        <select id="class_id" name="class_id" class="form-control">
          <option selected>Choose...</option>
          <option>1</option>
        </select>
      </div>
    </div>
      <br>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>

{{-- <script type="text/javascript">
 $(document).on('click', '.delete', function () {
            
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

</script> --}}
@endsection