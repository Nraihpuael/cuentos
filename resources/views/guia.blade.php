@section('content')
@section('css')
@extends('adminlte::page')

@section('content_header')

@stop

@endsection
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3">
                <a class="navbar-brand" href="#">Como usar el Generador de Cuentos</a>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#scrollspyHeading1">Crear Cuento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#scrollspyHeading2">Escribir Pagina</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#scrollspyHeading3">Compartir Cuentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#scrollspyHeading4">Guia en video</a>
                    </li>
                </ul>
            </nav>

            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
                <h2>Iniciar sesión</h2>
                <p> Si ya tienes una cuenta, entra a la página de generador de cuentos. En caso de que no la tengas, regístrate en nuestra plataforma </p>
                
                <h2 id="scrollspyHeading1">Crear un Cuento</h2>
                Tanto en la pagina principal como en mis cuentos puede dar clic en el botón de Nuevo Cuento
                    Aqui es necesario que introduzcas un titulo, fecha, género.
                </p>
                <p>Luego en la parte de abajo veras un recuedro llamado generar Imagen, puedes escribir y dictar lo que quieras que te dibuje cuando estes satisfecho as click en generar,
                    aparecera 2 imagenes si alguna te gusta puedes cliquearla o volver generar, la imagen que selecciones sera la portada de tu libro cuando estes satisfecho dale en Comienza a escribir.
                </p>
                <strong><p>FELICIDADES ESCRIBISTE UN NUEVO CUENTO </p></strong>
                <br><br>
                
               
                <h2 id="scrollspyHeading2">Paginas del Cuento</h2>
                <p>Una vez tu cuento creado mucho botones, sirven para Leer, Descargar, Editar tu cuento o eliminarlo <br>
                    Por el momento iremos dentro del cuento cliqueando en el nombre del cuento.
                </p>
                
                <h4>Escribir página</h4>
                <p>Aqui podras ver la lista de tus paginas la cual estara vacia, dale en crear nueva pagina.</p>
             
                <p>El proceso es muy similar, en el recuadro grande escribir todo lo que quieras que contenga tu pagina con el formato de tu agrado, y luego genera tu imagen de la pagina.</p>
                <p>Aqui podras ver la lista de tus paginas la cual estara vacia, dale en crear nueva pagina.</p>

                <h4>Opciones de página</h4>
                <p>Ahora que tienes una pagina escrita puedes editar, elimanar y leerla para que veas el acabado que tuvo.</p>
                <br><br>


                <h2 id="scrollspyHeading3">Compartir Cuentos</h2>
                <h4>Publicar</h4>
                <p>En la lista de paginas podras publicar tu libro y deshacer esa publicacion a voluntad, lo libros publicados apareceran en la pagina principal</p>
              
                <h4>Descargar pdf</h4>
                <p>En la lista de cuento puedas Dar clic en el botón de pdf. te descargará tu libro un archivo en pdf</p>

                <h1 id="scrollspyHeading4">Guía Generador de Cuentos</h1>
                <div>
                    <iframe width="600" height="400" src="https://www.youtube.com/embed/kI-xGxpKR3w" frameborder="0" allowfullscreen></iframe>
                </div>
                
            </div>    
        </div>
    </div>
</section>
@endsection