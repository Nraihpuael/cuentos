@section('content')
@section('css')
@extends('adminlte::page')

@section('content_header')

@stop

@endsection

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Cuentos') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('cuento.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Nuevo Cuento') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table table-hover table-dark">
                            <thead class="thead">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Titulo</th>
                                    <th>Leer</th>
                                    <th>Descargar</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>

                                </tr>
                            </thead>
                         
                                <tbody>
                                    @foreach ($cuentos as $cuento)
                                    <tr>
                                        <td>{{ $cuento->fecha }}</td>
                                        <td>
                                            @csrf
                                            <a href="{{ route('pagina.index', ['id' => $cuento->id]) }}" class="table"
                                                type="submit">
                                                <i>{{ $cuento->titulo }}</i>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('cuento.show',$cuento->id) }}" class="btn btn-dark ">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('cuento.descargar', ['id' => $cuento->id]) }}"
                                                class="btn btn-danger btn-sm float-none">
                                                <i class="bi bi-file-pdf"></i>
                                            </a>
                                        </td>

                                        <td>
                                            {{--Ver PDF--}}
                                            <a href="{{ route('cuento.edit',$cuento->id) }}"
                                                class="btn btn-dark btn-sm float-none">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                        </td>

                                        <td>
                                            {{--Eliminar--}}
                                            <form action="{{ route('cuento.destroy',$cuento->id) }}" method="POST"
                                                style="display: inline-block;"
                                                onsubmit="return confirm('¿Está seguro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-success btn-sm float-none "><i
                                                        class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection