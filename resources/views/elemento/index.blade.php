@extends('adminlte::page')

@section('title', 'Dashboard')
@section('template_title')
Elementos Escenarios
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card text-center">
                        <P></P>
                        <h6 class="card-title">{{ $cuento->titulo }}</h6>
                        <P></P>
                    </div>
           
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div class="float-left">
                            <a href="{{ route('elemento.create', ['id' => $id]) }}" class="btn  btn-sm float-right shadow sm" style="background-color: #12CB55; width:300px"
                                data-placement="left">
                                {{ __('Escribir Nuevo Elemento') }}
                            </a>     
                        </div>   
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagina.index', ['id' => $id]) }}"> {{ __('Volver') }}</a>
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
                        <table class="table table table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Fecha</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                    <th>Escenario</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-secondary table-hover">
                            <tbody>
                                @foreach ($elementos as $elemento)
                                <tr>
                                    <!--  <td>{{ ++$i }}</td>-->
                                    <td>{{$elemento->created_at}}</td>

                                    <td>
                                        @csrf
                                        <a class="table" type="submit"
                                            href="{{ route('elemento.show',[$elemento->id, $elemento->cuento_id]) }}">Elemento
                                            {{$elemento->nombre}}</a>
                                    </td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form action="{{ route('elemento.destroy',[$elemento->id, $elemento->cuento_id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success btn-sm float-none "><i
                                                    class="fa fa-fw fa-trash"></i></button>

                                        </form>
                                    </td>

                                    <td><a class="btn btn-dark btn-sm float-none"
                                            href="{{ route('elemento.edit',[$elemento->id, $elemento->cuento_id]) }}"><i
                                                class="fa fa-fw fa-edit"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $elementos->links() !!}
        </div>
    </div>
</div>
@endsection