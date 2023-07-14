@extends('adminlte::page')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <strong><span class="card-title">Perfil de usuario</span></strong>
        </div>
        <div class="card-body">
            <p>Nombre: {{ $user->name }}</p>
            <p>NombreUser: {{ $user->name_user }}</p>
            <p>Email: {{ $user->email }}</p>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar</a>

            <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">Eliminar</button>
            </form>
        </div>
    </div>
@endsection
