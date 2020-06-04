@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')

<link href="{{url('/asset/css/create_question.css')}}" rel="stylesheet" type="text/css">
  <script src="https://cdn.tiny.cloud/1/atbbh9wyoril2odwckek0get6ia5e2kw54f64s1738eburso/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

{{-- <body>
    <div class="container">
        <textarea>Next, get a free Tiny Cloud API key!</textarea>

    </div>
</body> --}}
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{'/question'}}" method="POST" enctype="multipart/form-data">
    @csrf
<input type="hidden" name="assignment_id" value="{{$dataAssignment->id}}">
<input type="hidden" name="assignment_path" value="{{$dataAssignment->assignment_path}}">
<input type="hidden" name="lesson_id" value="{{$dataAssignment->lesson_id}}" >
    <div class="row page-title clearfix" style="margin-top:-10px">
        <div class="container">
            <div class="page-title-left">
                <!-- <h6 class="page-title-heading mr-0 mr-r-5">Tambah Soal</h6>
                    <p class="page-title-description mr-0 d-none d-md-inline-block"></p> -->
                    <a href="/question" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
                    <a href="#save" data-toggle="modal" class="btn btn-info btn-sm"><i class="fas fa-check-square"></i>&nbsp; Simpan!</a>
                </div>
            </div>
        <!-- /.page-title-left -->
    </div><!-- /.page-title -->
    <div class="container">
    <div class="widget-list row" style="margin-top:10px;margin-bottom:80px">
        <div class="widget-holder widget-full-height col-md-12">
            <div class="widget-bg">
                <div class="widget-body">
                    <legend>Pertanyaan <a href="#" onclick="hideShowQuest()"><i id="iconQuest" class="fas fa-chevron-down"></i></a></legend>
                    <!-- QUESTION -->
                    <div id="question_">
                        <textarea data-toggle="tinymce" name="question_name " data-plugin-options='{ "height": 300 }'></textarea>
                        <br />
                    </div><!-- / Question_ -->
                    <!-- END QUESTION -->
    
                    <div class="line"></div>
    
                    <!-- OPTION -->
                    <div class="row">
                        <div class="col-sm-9">
                            <legend>
                                Jawaban 
                                <a href="javascript:;;" onclick="hideShowAnswer()"><i id="iconAnswer" class="fas fa-chevron-down"></i></a>
                            </legend>
                        </div>
                        <div class="col-sm-3" style="text-align:right">
                            <button title="Tambah 1 Jawaban" type="button" onclick="cloneAnswer()" class="btn btn-info btn-circle"><i class="fas fa-plus"></i></button>
                        </div>
                    </div><!-- / Row -->
                    <input type="hidden" id="totalAnswer" name="totalAnswer" value="0">
                    <input type="hidden" id="choosedAnswer" name="choosedAnswer" value="0">
                    <input type="hidden" id="JSONanswer" name="JSONanswer">
                    
                    <div id="option_">
                        @for ($i=0; $i < 1 ; $i++)

                            <div class="row" id="rowAnswer">
                                <div class="col-sm-1">
                                    <div id="chooseAnswer{{$i}} " class="chooseAnswer" onclick="chooseAnswer('{{$i}}')">@include('number_to_char')</div>
                                </div>
                                <div class="col-sm-11">
                                    <textarea class="form-control" style="height:150px" name="option_{{$i}}" data-toggle="tinymce"></textarea>
                                    {{-- <a style="margin-top:10px" href="#answerImage{{$i}}" data-toggle="modal" class="btn btn-sm btn-outline-primary"><i class="fas fa-image"></i>&nbsp; Unggah Gambar</a> --}}
                                </div>
                            </div><!-- / Row -->
                            <br />
                           
                        @endfor
                        <!-- FOR APPEND ANSWER -->
                        <div id="appendAnswer"></div>
                        <!-- FOR APPEND ANSWER -->
                    </div>
                    <!-- END OPTION -->
    
                </div><!-- / BODY -->
            </div><!-- / BG -->
        </div>
    </div> 
    
    
    <!-- MODAL SAVE -->
    <div class="modal modal-info fade" id="save">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-inverse">Apa sudah anda yakin dengan data ini ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-info btn-block">Ya, Simpan dan lanjutkan!</button>
                </div>
            </div>
        </div>
    </div>
</div>
    </form>
    <script src="{{url('/asset/js/create_question.js')}}"></script>
@endsection


    <!-- MODAL IMAGE -->
    {{-- <div class="modal modal-primary fade" id="imageQuestion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-inverse">Unggah Gambar (max. 2mb)</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="question_image" id="question_image" class="form-control">
                        <div id="imagePreview" class="imagePreview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary btn-block" data-dismiss="modal">Simpan!</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- MODAL SOUND -->
    {{-- <div class="modal modal-success fade" id="soundQuestion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-inverse">Unggah Suara (max. 2mb, .mp3)</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="question_sound" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success btn-block" data-dismiss="modal">Simpan!</button>
                </div>
            </div>
        </div>
    </div> --}}

     <!-- MODAL IMAGE FOR OPTION -->
                            {{-- <div class="modal modal-primary fade" id="answerImage{{$i}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title text-inverse">Unggah Gambar (max. 2mb)</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="file" name="option_image{{$i}}" id="option_image{{$i}}" class="form-control">
                                                <div id="imagePreview{{$i}}" class="imagePreview"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary btn-block" data-dismiss="modal">Simpan!</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


    <!-- BUTTON -->
    {{-- <div class="row">
    <div class="col-sm-2">
        <a href="#imageQuestion" data-toggle="modal" class="btn btn-outline-primary btn-block btn-sm"><i class="fas fa-image"></i> Unggah Gambar</a>
    </div>
    <div class="col-sm-2">
        <a href="#soundQuestion" data-toggle="modal" class="btn btn-outline-success btn-block btn-sm"><i class="fas fa-music"></i> Unggah Suara</a>
    </div>
</div><!-- / Row --> --}}