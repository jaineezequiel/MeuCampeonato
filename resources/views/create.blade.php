@extends('layouts.admin')

@section('main')      

Nome do campeonato 
<input type="text" name="nome_campeonato" />

<label for="time">Selecione os times:</label>
<input list="times" name="time" id="time">

<datalist id="times">
  <option value="Time1">
  <option value="Time2">
</datalist>

<button class="btn btn-success">Simular</button>

@endsection

