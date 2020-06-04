@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <h4>Selamat datang  {{$admin}}</h4>
        <hr>
    </div>
   <div class="container">
      <div class="row text-white">
         <div class="col-md-3">
            <div class="card-body rounded bg-success border border-success">
                {{-- @foreach ($data as $dat)
            <span>{{ $dat['active_assignment'] }}</span> <p>Ujian Aktif</p> --}}
             </div>
         </div>
         <div class="col-md-3">
            <div class="card-body rounded bg-primary border border-primary">
               {{-- Contoh passing parameter dari controller --}}
              

            {{-- <span>{{ $dat['total_assignment'] }}</span> <p>Ujian Tersedia</p> --}}
             </div>
         </div>
         <div class="col-md-3">
            <div class="card-body rounded bg-danger border border-danger">
            {{-- <span>{{ $dat['total_student'] }}</span> <p>Siswa</p> --}}
             </div>
         </div>
         <div class="col-md-3">
            <div class="card-body rounded bg-warning border border-warning">
               <span>
                   {{-- @if ($dat['total_graduated'] < 1 OR $dat['total_result'] < 1)
                       {{ $percentage = 0 }}
                   @else
                       {{ ($dat['total_graduated'] / $dat['total_result']) * 100 }}
                       {{ $percecntage = ceil($percentage) }}
                   @endif
               </span> <p>% Kelulusan</p>
               @endforeach  --}}
               
              </div>
         </div>
      </div>
   </div>
@endsection

