<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
      body {
          font-family: Arial, sans-serif;
      }
  
      .page {
          page-break-after: always;
      }
  
      .page:last-child {
          page-break-after: avoid;
      }
  
      .card {
          width: 100%;
          padding: 10px;
          margin-bottom: 20px;
          border: 1px solid #ccc;
          box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      }
  
      .card-body {
          text-align: center;
      }
  
      .card-img-top {
          max-width: 100%;
          height: auto;
          margin-bottom: 10px;
      }
  
      .card-title {
          font-size: 30px;
          margin-bottom: 10px;
          margin-top: 100px;
          text-align: center;
      }
  
      .card-autor {
          font-size: 15px;
          margin-bottom: 10px;
          margin-top: 100px;
          text-align: center;
      }
  
      .card-text {
          font-size: 16px;
          margin-bottom: 10px;
          text-align: center;
      }
  
      .card-page-number {
          font-size: 14px;
          text-align: right;
          margin-top: 10px;
      }
      </style>

    <title>Cuento</title>
  </head>
  <body>

    <div class="page">
        <div class="card-body">
            <h5 class="card-title">{{ $cuento->titulo }}</h5>
            <div class="form-group">
                <img src="{{ public_path() . '/storage/'.$cuento->url }}" alt="Image" class="card-img-top">
            </div>
            <h5 class="card-autor">Autor: {{ $usuario->name }}</h5>

        </div>
    </div>
    @foreach ($paginas as $pagina)
    <div class="card-page-number">{{ $pagina->id }}</div>
    <div class="page">
        <div class="card-body">
            <div class="form-group">
                <img src="{{ public_path() . '/storage/'.$pagina->url }}" alt="Image" class="card-img-top">
            </div>
            <div class="form-group">
                <strong>Descripcion:</strong>{{ $pagina->descripcion }}
            </div>
            <div class="form-group">
                <p class="card-text"><strong></strong>{{ $pagina->text }}</p>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>