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
                                    
                                    <div class="row">
                                        {{--Edita el texto de la pagina--}}
                                        <div id="imagen" style="display: flex; justify-content: center; align-items: center; border: 1px solid grey; margin: 10px auto;" name="imagen" ></div>
                                        <input type="hidden" name="imageUrl" id="imageUrl" value="{{ $cuento->url }}">
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

                <div class="col-md-12">

                    @includeif('partials.errors')
    
                    <div class="card card-default">
                        <div class="card-header">
                            <span class="card-title">{{ __('Generar') }} Imagen</span>
                        </div>
                        <div class="card-body">
                            <!-- Prompt input form -->
                            <form id="prompt-form">
                                <div class="row">
                                    <input type="text" name="prompt" id="prompt-input" class="form-control" maxlength="350" placeholder="Ingrese descripcion" x-webkit-speech> 
                                </div>
                                <div class="row">
                                    <button id="promptSpeechButton" type="button">Escribir por voz</button>
                                    <button type="submit">Generar</button>
                                </div>
                            </form>
    
                            <!-- Generated images -->
                            <div id="images-container" style="display: flex; margin: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        const promptInput = document.getElementById('prompt-input');
        const promptSpeechButton = document.getElementById('promptSpeechButton');

        if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();

        recognition.lang = 'es-ES'; // Set the language if needed

        promptSpeechButton.addEventListener('click', () => {
            recognition.start();
            promptInput.focus();
        });

        promptInput.addEventListener('blur', () => {
            recognition.stop();
        });

        recognition.addEventListener('result', (event) => {
            const transcript = event.results[0][0].transcript;

            if (document.activeElement === promptInput) {
                promptInput.value += ' ' + transcript;
            }
        });

        } else {
        console.log('SpeechRecognition API is not supported in this browser.');
        }
        
        const promptForm = document.getElementById('prompt-form');
        const imagesContainer = document.getElementById('images-container');
        const firstFormImagesContainer  = document.getElementById('imagen');
        const imageUrl = document.getElementById('imageUrl').value;
       
        console.log(imageUrl);

        const defaultImgElement = document.createElement('img');
        defaultImgElement.src = imageUrl;
        defaultImgElement.alt = 'Default Image';

        firstFormImagesContainer.innerHTML = '';
        firstFormImagesContainer.appendChild(defaultImgElement);


        promptForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const prompt = promptInput.value;

            try {
            const response = await axios.get(`/cuento/generar/${prompt}`);
            const images = response.data.images;
            console.log(images);
            imagesContainer.innerHTML = '';

            images.forEach(image => {
                const imgElement = document.createElement('img');
                imgElement.src = image;
                imgElement.alt = 'Generated Image';

                imgElement.addEventListener('click', () => {
                    selectedImage = image;
                    firstFormImagesContainer.innerHTML = '';

                    const imgElement = document.createElement('img');
                    imgElement.src = selectedImage;
                    imgElement.alt = 'Selected Image';

                    firstFormImagesContainer.appendChild(imgElement);

                    document.getElementById('imageUrl').value = selectedImage;
                });
                imagesContainer.appendChild(imgElement);
            });
        } catch (error) {
            console.error('Error:', error);
        }
    });
    </script>
@endsection
