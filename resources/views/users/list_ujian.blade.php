@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
    <div class="container">
    <h4>Selamat datang {{Session::get('username')}}</h4>
  {{-- Tabel --}}
    <div class="card-header">
        list Ujian
    </div>
   <div class="card-body mx-auto">
   <table class="table table-bordered table-sm px-auto" id="example" name="example">
    <thead>
        <tr>
            <th>Id</th>
            <th>Pelajaran - Tipe</th>
            <th>KKM</th>
            <th>Total Soal</th>
            <th>Penulis</th>
            <th>Dibuat</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach ($dataAssignment as $row => $value)   
    <tbody>
        <tr>
        <td>{{$value->id}}</td>
        <td>{{$value->lesson->lesson_name.'-'.$value->assignment_type }}</td>
        <td>{{$value->assignment_kkm}}</td>
        <td>{{$value->totalQuestion}}
        <a href="/question/list/{{$value->id}}" class="ml-2 btn btn-warning"><i class="far fa-eye"></i></a>
        </td>
        <td>{{$value->assignment_author}}</td>
        <td>{{$value->assignment_created}}</td>
        <td>
            @if ($value->totalQuestion < 1)
                <center><i class="text-danger">Anda belum membuat soal</i></center>   
                @else
                <input type="checkbox" name="assignment_active" data-id="{{$value->id}}" data-toggle="toggle" class="toggle-class" {{$value->assignment_active == true ? 'checked' : '' }}>
                <span id="textLoading{{$value->id}}" style="display:none" class="text-muted d-inline-block">&nbsp;</span>
            @endif
        </td>
        <td>
        <a title="Buat Soal" href="/question/{{$value->id}}" class="btn btn-success btn-sm"><i class="far fa-plus-square"></i></a>
            <a title="Ubah Data Ujian" href="#" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
            <a title="Hapus Ujian" href="javascript:void(0)" data-toggle="modal" id="delete-assignment" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
        </td>
        </tr>
    </tbody>
    @endforeach
    </table>
    </div>
</div>
{{--  akhir tabel --}}

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
                <p><b>Jika menghapus data maka</b></p>
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

<script type="text/javascript">

       
$(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    }); 

    $('.toggle-class').bootstrapToggle({
        on:'Active',
        off:'InActive',
        onstyle:'success',
        offstyle:'danger'
    });

    $('.toggle-class').on('change', function(){
        
        var assignment_active = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
        $.ajax({
            type: 'post',
            dataType: 'JSON',
            url: '{{route("changestatus")}}',
            data: {'assignment_active': assignment_active,'id':id, },
            success: function(data){
                if (assignment_active){
                    setTimeout(function(){
                        swal({
                            title: "Woohoo!",
                            text: "Status ujian berhasil diubah menjadi aktif",
                            type: "success",
                            });
                        },1200);
                    } else {
                    setTimeout(function(){
                        swal({
                            title: "Woohoo!",
                            text: "Status ujian berhasil diubah menjadi tidak aktif",
                            type: "success",
                            });
                        },1200);
                    }
                } 
    
        });
    });

    
   

    $('body').on('click', '#delete-assignment', function () {
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
{{-- function changeStatus(idAssignment,param) {
    $.ajax({
        url : '/assignment/changestatus/'+idAssignment+'/'+param ,
        type : 'get',
        success:function(res){
            return res;
        }
    });
}
    function change(data) {
    const assign_id = $(this).data('id');
    $.get('/assignment/changestatus/'+assign_id, function(data){
    $("#assignment_active"+idAssignment).val(data.assignment_active = 2);
    }

    }) --}}

    {{-- function forCheck(idAssignment) {
        
        // const assign_active = document.getElementById("assignment_active"+idAssignment);
        if (document.getElementById("assignment_active"+idAssignment).checked == true) {
            $("#assignment_active"+idAssignment).prop("disabled",true);
            $("#textLoading"+idAssignment).text('loading');
            $.ajax({
                url :'/assignment/changestatus/'+idAssignment,
                type : 'get',
                success:function(res){
                    if(res === 'limit') {
                        document.getElementById("assignment_active"+idAssignment).checked = false;
                        setTimeout(function(){
                            $("#assignment_active"+idAssignment).prop("disabled",false);
                            $("#textLoading"+idAssignment).text('');
                            swal({
                                title: "Ooppss! Ujian aktif sudah 10",
                                text: "Memuat ulang dalam 2 detik",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                window.location ='/assignment';
                            },2000)
                        },1200);
                        console.log('ok');
                    } else {
                        setTimeout(function(){
                            $("#assignment_active"+idAssignment).prop("disabled",false);
                            $("#textLoading"+idAssignment).text('');
                            swal({
                              title: "Woohoo!",
                              text: "Status ujian berhasil diubah menjadi aktif",
                              type: "success",
                            });
                        },1200);
                        console.log('ok2');
                    }
                }
                });
            
        } else if(document.getElementById("assignment_active"+idAssignment).checked == false) {
            $("#assignment_active"+idAssignment).prop("disabled",true);
            setTimeout(function(){
                $("#assignment_active"+idAssignment).prop("disabled",false);
                $("#textLoading"+idAssignment).text('');
                swal({
                    title: "Woohoo!",
                    text: "Status ujian berhasil diubah menjadi tidak aktif",
                    type: "success",
                });
            },1200);
            console.log('ok3');
        }
    } --}}