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

@section('title', 'Alta de Usuarios')
@section('h1', 'Alta de Usuarios')

@section('main')

    {{-- mensaje de exito de modificacion de usuario --}}
    @if ( session("estado"))
    <div class="alert alert-success">
    {{ session("estado") }}
    </div>
    @endif
 

    <div class="alert bg-light py-3">
        <form action="/agregarUsuario" method="post">
            @csrf
            Usuario:
            <br>
            <!-- Campo nombre -->
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" id="nombre" placeholder="Nombre">
            @error('nombre')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        
            <!-- Campo apellido -->
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" id="apellido" placeholder="Apellido">
            @error('apellido')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <!-- Campo email --> 
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Email">
            @error('email')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <!-- desplegable de paises -->
            <select name="pais" id="pais" class="select" id="pais">
            
             <!-- se recorre el array de paises y devuelve cada uno de ellos-->
                <option disabled selected>-- Selecciona un Pais --</option>
                @foreach($paises as $pais)
                    <option name={{$pais}} class="select-item">{{$pais}}</option>
                @endforeach
            </select>
            <br>
            <button class="btn btn-dark">
              <i class="far fa-plus-square fa-lg mr-2"></i>
              Agregar usuario
            </button>

            </button>
            <a href="/vistaUsuarios" class="btn btn-outline-info ml-3">
            <i class="fas fa-undo-alt fa-lg mr-2"></i>
                Volver al panel de usuarios
            </a>

        </form>
    </div>


@endsection
