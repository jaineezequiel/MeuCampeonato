@extends('layouts.app')
@section('content')        
<div class="container-fluid">
  <div class="row">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <div class="btn-toolbar mb-2 mb-md-0">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('campeonatos.create') }}">
                  <span data-feather="home"></span>
                  Novo campeonato
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('campeonatos.historico') }}">
                  <span data-feather="file"></span>
                  Histórico
                </a>
              </li>       
            </ul>
          </div>
        </nav>
      </div>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        @yield('main') 
      </main>     
  </div>
  </div>
</div>
@endsection