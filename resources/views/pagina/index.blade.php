@extends('adminlte::page')

@section('title', 'Dashboard')
@section('template_title')
Pagina
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
                            
                            <a href="{{ route('pagina.create', ['id' => $id]) }}" class="btn  btn-sm float-right shadow sm" style="background-color: #12CB55; width:300px"
                                data-placement="left">
                                {{ __('Escribir nueva pagina') }}
                            </a>
                            
                        </div>     
                        <div class=float-right>

                            @if ($cuento->estado == 0)
                            <a href="{{ route('cuento.publicar', ['id' => $cuento->id]) }}" class="btn btn-warning" style="margin: 10px">Publicar
                            </a>
                            @else
                            <a href="{{ route('cuento.publicar', ['id' => $cuento->id]) }}" class="btn btn-danger" style="margin: 10px">Deshacer
                            </a>
                            @endif


                            <a class="float-right" href="{{ route('elemento.index', ['id' => $id]) }}" type="buttom" >
                            <img width="60" height="60" src="{{ asset('img/crear_escenario.jpg') }}"/>
                            </a>

                            <a class="float-right" href="{{ route('elemento.index', ['id' => $id]) }}" type="buttom" >
                                <img width="64" height="64" src="{{ asset('img/crear_personaje.jpg') }}" alt="standing-man"/>
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
                        <table class="table table table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Fecha</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                    <th>Pagina</th>
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
                                @foreach ($paginas as $pagina)
                                <tr>
                                    <!--  <td>{{ ++$i }}</td>-->
                                    <td>{{$pagina->created_at}}</td>

                                    <td>
                                        @csrf
                                        <a class="table" type="submit"
                                            href="{{ route('pagina.show',[$pagina->id, $pagina->cuento_id]) }}">Pagina
                                            {{$pagina->id}}</a>
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
                                        <form action="{{ route('pagina.destroy',[$pagina->id, $pagina->cuento_id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success btn-sm float-none "><i
                                                    class="fa fa-fw fa-trash"></i></button>

                                        </form>
                                    </td>

                                    <td><a class="btn btn-dark btn-sm float-none"
                                            href="{{ route('pagina.edit',[$pagina->id, $pagina->cuento_id]) }}"><i
                                                class="fa fa-fw fa-edit"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $paginas->links() !!}
        </div>
    </div>
</div>
@endsection