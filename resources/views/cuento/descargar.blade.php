<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cuento</title>
  </head>
  <body>
    @foreach ($paginas as $pagina)
      <div class="card">
        <div class="card-body"> 
          <div class="form-group">
            <strong>Pagina:</strong>{{ $pagina->id }}
          </div>          
          <div class="form-group">
          <strong>Text:</strong>{{ $pagina->text }}
          </div>
          <div class="form-group">
            <img src="{{ public_path() . '/storage/'.$pagina->url }}" alt="Image">
          </div>
          <div class="form-group">
            <strong>Descripcion:</strong>{{ $pagina->descripcion }}
          </div>
        </div>
      </div>   
    @endforeach           
  </body>
</html>