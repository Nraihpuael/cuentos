@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dale un Vistazo a tus Cuentos!</h1>
@stop

@section('content')

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
        @foreach ($cuentos as $cuento)
        @if($cuento->estado == 1)
        <div class="col mb-4">
            <div class="card h-100">
                @if($cuento->url != null)<div class="card h-100">
                    <img src="{{ $cuento->url }}" class="card-img-top" alt="...">
                </div>
                @else

                <img src="{{ asset('img/crear_cuento1.jpg') }}" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $cuento->titulo }}</h5>
                    @if ($cuento->cuentopaginas->isNotEmpty())
                    @php
                    $textoPagina = Str::limit($cuento->cuentopaginas[0]->text, 20); // Limitar a 100 caracteres
                    @endphp
                    <input id="text" style="height: max-content">{{ $textoPagina }}> 
                    @else
                    <p>No hay páginas escritas...</p>
                    @endif
                    <a href="{{ route('cuento.show', $cuento->id) }}" class="btn btn-danger">
                        <i class="bi bi-file-pdf">Leer</i>
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/knd91vpohfzu2igrxbf3dhjz4d57uwj7r3l3kkdgjd7kxphb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#text',
        plugins: '',
        menubar: false,
        toolbar: false,
        branding: false,
        statusbar: false,
        readonly: true
    });
</script>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
console.log('Hi!');
</script>
@stop
