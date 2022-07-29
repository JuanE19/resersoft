@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Reservas</h1>
@stop

@section('content')
<form action="/reserva/{{$reserva->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="container m-4 w-25">
    <div class="mb-3">
        <label for="" class="form-label">Cantidad de personas</label>
        <input id="cantidadDePersonas" name="cantidadDePersonas" type="text" class="form-control" tabindex="1" value="{{$reserva->cantidadDePersonas}}">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Fecha de ingreso</label>
        <input id="fechaDeIngreso" name="fechaDeIngreso" type="date" class="form-control" tabindex="1" value="{{$reserva->fechaDeIngreso}}">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Fecha de salida</label>
        <input id="FechaDeSalida" name="FechaDeSalida" type="date" class="form-control" tabindex="1" value="{{$reserva->fechaDeSalida}}">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Precio</label>
        <input id="precio" name="precio" type="text" class="form-control" tabindex="1" value="{{$reserva->precio}}">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Tipo de Habitación</label>
        <input id="tipoDeHabitacion" name="tipoDeHabitacion" type="text" class="form-control" tabindex="1" value="{{$reserva->tipoDeHabitacion}}">
    </div>

    <a href="/reserva" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    </div>

</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
