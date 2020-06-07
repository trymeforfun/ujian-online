@extends('layouts.app_user')

@section('title', 'Page User')
@section('content')
<!-- Page Title Area -->
<div class="container">
<div class="row page-title clearfix" style="margin-top:-10px">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Rincial Soal</h6>
        <p class="page-title-description mr-0 d-none d-md-inline-block"></p>
    </div>
    <!-- /.page-title-left -->

</div><!-- /.page-title -->

<style type="text/css">
    .line {
        width: 100%;
        min-height: 1px;
        border-bottom: 1px solid #E9E9E9;
        margin: 10px 0px;
    }
    .bigLine {
        width: 100%;
        border-bottom: 1px solid black;
        min-height: 2px;
    }
    .audio {
        margin-top:20px;
        background-color: black;
        width: 100% !important;
    }
</style>
<div class="widget-list row" style="margin-top:10px;margin-bottom:80px">
    <div class="widget-holder widget-full-height col-md-12">
        <div class="widget-bg">
            <div class="widget-body">
                <legend>Pertanyaan</legend>
                <div class="question_">
                    <div class="container">
                    <div class="row">
                            {{ $dataQuestion->question_name}}
                            <div class="line"></div>
                        </div><!-- / Row -->
                    </div>
                </div><!-- / Question -->
                <br />
                <div class="bigLine"></div>
                <legend>Jawaban</legend>
                <div class="option_">
                    @foreach ($dataQuestion->option as $row => $value)
                        <div class="row" style="margin-bottom:20px;border-bottom:1px solid #E9E9E9">
                            <div class="col-sm-1">
                                <center><?php $i = $row;  ?> @include("number_to_char")</center>
                            </div>
                            <div class="col-sm-11">
                                <div class="row">
                                    @if ($value->option_image != '')
                                        <div class="col-sm-9">
                                    @else
                                        <div class="col-sm-12">
                                    @endif
                                        @if ($value->option_true == 1)
                                            <div class="alert alert-success" style="padding:5px">
                                                Jawaban Benar
                                            </div>
                                        @endif
                                        {{$value->option_}} 
                                    </div>
                                    @if ($value->option_image != '')
                                        <div class="col-sm-3">

                                            {{-- <a data-fancybox="gallery" href="<?= base_url('assets/images/assignments/'.$dataAssignment->assignment_path.'/'.$value->option_image) ?>"><img src="<?= base_url('assets/images/assignments/'.$dataAssignment->assignment_path.'/'.$value->option_image) ?>" class="img-thumbnail"></a> --}}
                                        </div>
                                    @endif
                                </div><!-- / Row -->
                            </div>
                        </div><!-- / Row -->
                    </div>
                    @endforeach
                </div>
            </div><!-- / BODY -->
        </div><!-- / BG -->
    </div>
</div>
@endsection