@extends('adminlte::page')

@section('template_title')
    {{ __('Leer') }} Cuento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Leer') }} Cuento {{ $cuento->titulo }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuento.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>
                </div>
                @foreach ($paginas as $pagina)
                <div class="card">
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-md-6">
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
            @endforeach             
            </div>
        </div>
    </section>
@endsection
