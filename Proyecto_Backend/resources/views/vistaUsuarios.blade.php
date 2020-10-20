@extends('layouts.plantilla')

@section('title', 'Vista de Usuarios')
@section('h1', 'Vista de Usuarios')

@section('main')

{{-- se genera la tabla de los usuarios --}}

<div class="table-responsive">  
    <table class="table table-bordered table-hover table-striped">
        <thead class="">
        <tr>
            <th class="columna">nombre</th>
            <th class="columna">apellido</th>
            <th class="columna">email</th>
            <th class="columna">pais</th>
            <th colspan="2">
                <a href="/formAgregarUsuario" class="btn btn-dark">
                <i class="far fa-plus-square fa-lg mr-2"></i>
                Agregar
                </a>
            </th>
        </tr>
        </thead>

        <tbody>
        {{-- se recorre el array usuarios y se devuelven los datos de cada uno de ellos --}}
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->nombre}}</td>
                <td>{{$usuario->apellido}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->pais}}</td>

                <!-- MODIFICAR USUARIO -->
                <td>
                    <a href="/formModificarUsuario/{{$usuario->id}}" class="btn btn-outline-info">
                    <i class="far fa-edit fa-lg mr-2"></i>
                        Modificar
                    </a>
                </td>

                <!-- ELIMINAR USUARIO -->
                <td>
                <form action="/eliminarUsuario" method="post">
                    {{csrf_field()}}

                    <input type="hidden" name="id" value="{{$usuario->id}}">
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Quieres eliminar la marca?')">
                        <i class="fas fa-trash-alt fa-lg mr-2"></i>
                        Eliminar
                    </button>

                </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

{{-- en caso de haber muchos, se genera una paginacion --}}
{{$usuarios->links()}}

@endsection