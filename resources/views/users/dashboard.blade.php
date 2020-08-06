@extends('layouts.app_user')

@section('title', 'Dashboard')

@section('content')
S

    <div class="container">
    <h4>Selamat datang {{Session::get('username')}}</h4>
        <hr>
    </>
   <div class="container">
      <div class="row text-white">
         <div class="col-md-3">
            <div class="card-body rounded bg-success border border-success">
                {{-- @foreach ($data as $dat) --}}
            <span></span> <p>Ujian Aktif</p>
             </div>
         </div>
         <div class="col-md-3">
            <div class="card-body rounded bg-primary border border-primary">
               {{-- Contoh passing parameter dari controller --}}
            <span></span> <p>Ujian Tersedia</p>
             </div>
         </div>
         <div class="col-md-3">
            <div class="card-body rounded bg-danger border border-danger">
            <span>{{ $total_students }}</span> <p>Siswa</p>
             </div>
         </div>
         <div class="col-md-3">
            <div class="card-body rounded bg-warning border border-warning">
               <span>
                  
               </span> <p>% Kelulusan</p>
               {{-- @endforeach   --}}
               
              </div>
         </div>
      </div>
   </div>
@endsection

