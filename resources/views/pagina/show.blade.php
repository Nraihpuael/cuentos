@extends('adminlte::page')

@section('template_title')
{{ __('Mostrar') }} Pagina 
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Leer') }} Pagina {{ $pagina->id }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagina.index', ['id' => $pagina->cuento_id]) }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Nombre del libro:</strong>
                                    {{ $cuento->titulo }}
                                </div>

                                <div class="form-group">
                                    <strong>Pagina:</strong>
                                    {{ $pagina->id }}
                                </div>
                        
                                <div class="form-group">
                                    <strong>Text:</strong>
                                    {{ $pagina->text }}
                                </div>
                            </div>                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ $pagina->url }}" alt="Image">
                                </div>
                        
                                <div class="form-group">
                                    <strong>Descripcion:</strong>
                                    {{ $pagina->descripcion }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
