@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
{{-- <!-- Page Title Area -->
<link rel="stylesheet" href="{{url('/asset/switchery/switchery.css')}}">
  <script src="{{url('/asset/switchery/switchery.js')}}"></script> --}}
<div class="container">
<form action="/assignment/store" method="POST">
    @csrf 
    <div class="container">
    <div class="row page-title clearfix" style="">
        <div class="page-title-left">
            <!-- <h6 class="page-title-heading mr-0 mr-r-5">Buat Soal</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block"></p> -->
            <div class="row">
                <div class="col-lg-2">
                    <a href="#save" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-check-square"></i>&nbsp;Simpan!</a><br>
                </div>
                <div class="col-lg-2">
                    <a href="#classes" data-toggle="modal" class="btn btn-success btn-sm"><i class="far fa-house"></i>&nbsp;Kelas</a>
                </div>
                <div class="col-lg-4">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="show_report" class="js-switch" data-toggle="toggle" data-onstyle="success" value="1"  data-offstyle="danger"> <b>Tampil Hasil</b>   
                    </label>
                </div>
                <div class="col-lg-4">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="show_analytic"  class="js-switch" data-toggle="toggle" data-onstyle="success" value="1"  data-offstyle="danger"><b>Analisis Soal</b>
                      </label>
                </div>
            </div>
        </div>
     </div><!-- /.page-title -->
    </div>
    <hr>
    
    <div class="widget-list row" style="margin-top:10px;margin-bottom:80px">
        <div class="widget-holder widget-full-height col-md-12">
            <div class="widget-bg">
                <div class="widget-body">
                    <!-- FOR FORM BEFORE -->
                        <div class="row">
                            <input type="hidden" name="id">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mata Pelajaran</label>
                                    <select class="form-control" name="id_lesson">
                                        @foreach ($getLesson as $rLesson => $vLesson)
                                        <option value="{{$vLesson->id}}">{{$vLesson->lesson_name}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tipe Ujian</label>
                                            <input type="text" class="form-control" name="assignment_type" required placeholder="ex: UTS / UAS">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Urutkan Soal</label>
                                            <?php $order = [['val'=>'asc','name'=>'Urutkan Terlama'],['val'=>'desc','name'=>'Urutkan Terbaru'],['val'=>'random','name'=>'Acak Soal']] ?>
                                            <select class="form-control" name="assignment_order">
                                               @foreach ($order as $vOrder)
                                                    <option value="{{$vOrder['val']}}">{{$vOrder['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- / Row -->
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nilai KKM</label>
                                            <input type="number" class="form-control" name="assignment_kkm" required placeholder="ex: 50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Durasi Ujian (menit)</label>
                                            <input type="number" class="form-control" name="assignment_duration" required placeholder="Durasi Ujian (menit)">
                                        </div>
                                    </div>
                                </div><!-- / Row -->
                                <div class="form-group">
                                    <label>Penulis Ujian</label>
                                    <input type="text" class="form-control" name="assignment_author" required placeholder="Penulis Ujian">
                                </div>
                            </div>
                        </div><!-- / Row -->
                        <!-- MODAL CLASSES --> 
                        <div class="modal fade modal-success" id="classes">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-inverse">Pilih Kelas</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%">#</th>
                                                    <th>Nama Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($getClass as $vClass)
                                                    <tr>
                                                        <td><input type="checkbox" name="kelas_id[]" value="{{$vClass->id}}"></td>
                                                        <td>{{ $vClass->kelas_name}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-success btn-block" data-dismiss="modal">Simpan!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL SAVE -->
                        <div class="modal fade modal-info" id="save">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-inverse">Apa anda sudah yakin dengan data ini ?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-info btn-block">Ya, Simpan dan lanjutkan!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.widget-body -->
            </div><!-- /.widget-bg -->
        </div>
    </div>
</div>
<script type="text/javascript" >
function switchFunc() {
 var check = document.getElementsByClassName('.js-switch');
 if (check.checked == true){
     console.log('ok');
 }
    
}

</script>
@endsection