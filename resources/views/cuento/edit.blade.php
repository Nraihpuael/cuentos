@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Cuento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Editar') }} Cuento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuento.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cuento.update', $cuento->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
                                    {{--Titulo--}}
                                    <div class="row">
                                        <label for="titulo" class="col-sm-2 col-form-label"> TÍtulo </label>
                                        <div class="col-sm-7">
                                            <input type="text" id="titulo" class="form-control" name="titulo" 
                                            value="{{ $cuento->titulo }}">
                                        </div>
                                    </div>
                            
                                    {{--Fecha--}}
                                    <div class="row">
                                        <label for="fecha" class="col-sm-2 col-form-label"> Fecha </label>
                                        <div class="col-sm-7">
                                            <input type="date" id="fecha" class="form-control" name="fecha" 
                                            value="{{ $cuento->fecha }}">
                                        </div>
                                    </div>
                                    
                                    {{--Genero--}}
                                    <div class="row">
                                        <label for="genero_id" class="col-sm-2 col-form-label"> Genero </label>
                                        <div class="col-sm-7">
                                            <select id="genero_id" name="genero_id" class="form-control">
                                                        @foreach ($generos as $genero)
                                                            <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                                                        @endforeach
                                            </select>
                                        </div>
                                    </div>
                            
                            
                                </div>
                            
                                <div class="center" style="text-align: center; margin-top:20px;">
                                    <button  class="btn btn-success">
                                        <img src="{{ asset('img/crear_cuento1.jpg') }}" alt="Imagen"> 
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
