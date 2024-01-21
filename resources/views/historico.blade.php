@extends('layouts.admin')
@section('main')        
  <div class="table-responsive">
    <h2>Campeonatos anteriores</h2>
    
    @if (!$campeonatos->isEmpty())
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>código</th>
            <th>Nome</th>
            <th>Vencedores</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($campeonatos as $campeonato)
          <tr>
            <td>{{ $campeonato->id }}</td>
            <td>Lorem</td>
            <td>ipsum</td>
          </tr>
          @endforeach
        </tbody>
      </table>        
    @else
        Nenhum campeonato cadastrado até momento
    @endif

  </div>
@endsection