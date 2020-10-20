@extends('layouts.plantilla')

{{-- estilos de la bandeja desplegable de paises --}}
@section('style')
    <style>
        .form-control{
            margin:5px 5px 5px 0;
            max-width: 400px;
        }
        .select{
            width: 400px;
            padding:10px;
            margin:0 0 5px 0;
        }
    </style>
@endsection

@section('title', 'Modificación de Usuario')
@section('h1', 'Modificación de Usuario')

@section('main')
    
    {{-- mensaje de exito de modificacion de usuario --}}
    @if ( session("estado"))
    <div class="alert alert-success">
    {{ session("estado") }}
    </div>
    @endif
 

    <div class="alert bg-light py-3">
        <form action="/modificarUsuario/{{$usuario->id}}" method="post">
            @csrf
            Usuario:
            <br>

            <!-- Campo nombre -->
            <input type="text" name="nombre" class="form-control" value="{{ $usuario -> nombre}}" id="nombre">
            @error('nombre')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <!-- Campo apellido -->
            <input type="text" name="apellido" class="form-control" value="{{ $usuario -> apellido}}" id="apellido">
            @error('apellido')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <!-- Campo email -->
            <input type="email" name="email" class="form-control" value="{{ $usuario -> email}}" id="email">
            @error('email')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <!-- desplegable de paises -->
            <select name="pais" id="pais" class="select">

            <!-- se recorre el array de paises, 
                y selecciona el pais que anteriormente estaba afiliado al usuario -->

                @foreach($paises as $pais)
                    @if($usuario -> pais == $pais)
                    <option name={{$pais}} class="select-item" selected>{{$pais}}</option>
                    @else
                    <option name={{$pais}} class="select-item">{{$pais}}</option>
                    @endif
                @endforeach
            </select>
            
            <br>
            <button type="submit" class="btn btn-dark px-4" onclick="return confirm('¿Confirmar cambio?')">
                <i class="far fa-check-circle fa-lg mr-2"></i>
                Aceptar
            </button>
            <a href="/vistaUsuarios" class="btn btn-outline-info ml-3">
            <i class="fas fa-undo-alt fa-lg mr-2"></i>
            Volver al panel de Usuarios
            </a>

        </form>
    </div>


@endsection