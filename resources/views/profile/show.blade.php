@extends('adminlte::page')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card"style="top:20px">
            <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end bg-primary-lt">
                    <div class="card-body">
                        <h4 class="subheader">Configuraciones de Cuenta</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg  list-group-item-action d-flex align-items-center active" style="margin-bottom: 10px">Editar perfil</a>
                            <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg list-group-item-action d-flex align-items-center active" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">Eliminar cuenta</button>
                            </form>
                        </div>   
                    </div>
                </div>
                <div class="col d-flex flex-column">
                    <form action="" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h2 class="mb-3">Mi Cuenta</h2>
                            <h3 class="card-title">Detalles de Perfil</h3>                           
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-label text-primary"></div>
                                    <p><strong></strong></p>                               
                                </div>
                            </div>                          
                            <div class="mt-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-label text-primary">Nombre</div>
                                        <div class="form-floating mb-1">
                                        <p><strong></strong> {{ $user->name }}</p>                                           
                                        </div>
                                        @error('passwordActual')
                                            <small class="text-danger mb-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-label text-primary">Nombre de usuario:</div>
                                        <div class="form-floating mb-1">
                                        <p><strong></strong> {{ $user->name_user }}</p>                                          
                                        </div>
                                        @error('passwordActual')
                                            <small class="text-danger mb-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-label text-primary">Email:</div>
                                        <div class="form-floating mb-1">
                                        <p><strong></strong> {{ $user->email }}</p>                                        
                                        </div>
                                        @error('passwordActual')
                                            <small class="text-danger mb-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-start">                            
                            </div>
                        </div>
                    </form>
                </div>


<!---
<div class="card card-default"style="width: 550px; top: 20px">

<div class="card-body" >
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Nombre de usuario:</strong> {{ $user->name_user }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
</div>
</div>
            </div>
        </div>
    </div>
</div>-->   
@endsection
