@extends('adminlte::page')

@section('template_title')
{{ __('Mostrar') }} Elemento 
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Leer') }} {{$tipo->nombre}} {{$elemento->nombre}} </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('elemento.index', ['id' => $elemento->cuento_id]) }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                                       
                                <div class="form-group">
                                    <strong>Descripcion:</strong>
                                    {{ $elemento->text }}
                                </div>
                            </div>                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ $elemento->url }}" alt="Image">
                                </div>
                        
                                <div class="form-group">
                                    <strong>Imagen:</strong>
                                    {{ $elemento->descripcion }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
