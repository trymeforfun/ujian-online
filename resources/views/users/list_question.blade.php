@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
<div class="container">
</div>

<div class="container">
<div class="row page-title clearfix" style="margin-top:-10px">
    <div class="page-title-left">
    <h6 class="page-title-heading mr-0 mr-r-5">List Soal <a href="/question/create"class="btn btn-circle btn-info btn-sm "><i class="fas fa-plus"></i></a></h6>
        <p class="page-title-description mr-0 d-none d-md-inline-block"></p>
    </div>
    <!-- /.page-title-left -->
</div><!-- /.page-title -->
</div>  <!-- CONTAINER -->
<div class="container">
<div class="widget-list row" style="margin-top:10px;margin-bottom:80px">
    <div class="widget-holder widget-full-height col-md-12">
        <div class="widget-bg">
            <div class="widget-body">
                <a href="< site_url('page/reuse_question/'.$dataAssignment->id_assignment) ?>" class="btn btn-primary"><i class="feather feather-file"></i>&nbsp; Gunakan Soal Lain</a><hr>
                <table class="table table-striped table-responsive" data-toggle="datatables">
                    <thead>
                        <tr>
                            <th style="width:5%">#</th>
                            <th>Pertanyaan</th>
                            <th style="width:10%">Total</th>
                            <th style="width:15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAssignment->question as $row => $value)
                            <tr>
                                <td> {{$row + 1}} </td>
                                <td> {{$value->question_name}} </td>
                                <td> {{$value->totalAnswer}}  Jawaban</td>
                                <td>
                                    <a title="Lihat detail" href="= site_url('page/detail_question/'.$dataAssignment->id_assignment.'/'.$value->id_question) ?>" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                                    <a title="Edit soal" href="= site_url('page/update_question/'.$dataAssignment->id_assignment.'/'.$value->id_question) ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                                    <a href="#delete= $row ?>" data-toggle="modal" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                           
                            <!-- MODAL DELETE -->
                            <div class="modal modal-danger fade" id="delete{{$row}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title text-inverse">Anda yakin ingin menhapus soal ini ?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="= site_url('AssignmentCtrl/removeQuestion/'.$value->id_question.'/'.$dataAssignment->id_assignment) ?>" class="btn btn-outline-danger btn-block">Ya, Hapus soal ini!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </tbody>
                </table>
            </div><!-- / BODY -->
        
        </div><!-- / BG -->
    </div>
</div>
</div>


@endsection