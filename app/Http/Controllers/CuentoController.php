<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use App\Models\Genero;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Orhanerday\OpenAi\OpenAi;

class CuentoController extends Controller
{
   
    public function index()
    {
        $cuentos = Auth::user()->miscuentos()->paginate(10);
        
        return view('cuento.index', compact('cuentos'))
            ->with('i', (request()->input('page', 1) - 1) * $cuentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::all();
        return view('cuento.create', compact('generos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'fecha' => ['required'],
            'imageUrl' => 'required|url',
            'genero_id' => ['required']
        ]);

        //Creamos nueva imagen
        $imagen = $request->imageUrl;

        $imagenContenido = file_get_contents($imagen);
        $imagenNombre = 'imageUrl_' . time() . '.jpg'; // Genera nombre unico
        Storage::disk('public')->put($imagenNombre, $imagenContenido);
     
        //Accedemos a la ruta de la nueva imagen
        $imagenPath = asset('storage/' . $imagenNombre);
     

        $cuento  = new Cuento();

        $cuento->titulo = $request->titulo;
        $cuento->fecha = $request->fecha;
        $cuento->url = $imagenPath;
        $cuento->genero_id = $request->genero_id;
        $cuento->user_id = Auth::user()->id;
        
        $cuento->save();

        return redirect()->route('cuento.index')
            ->with('success', 'Una nueva historia nacio Vuela');
    }


    public function show($id)
    {
        $cuento = Cuento::find($id);
        $paginas = Pagina::where('cuento_id', $id)->paginate();;
        //dd($paginas);
        return view('cuento.show', compact('cuento','paginas'));
    }

    public function edit($id)
    {
        $cuento = Cuento::find($id);
        $generos = Genero::all();
        return view('cuento.edit', compact('cuento','generos'));
    }

    public function update(Request $request, Cuento $cuento)
    {
        $request->validate([
            'titulo' => 'required|string',
            'imageUrl' => 'required|url',
            'genero_id' => ['required']
        ]);

        if($cuento->url != $request->imageUrl){
            //Creamos nueva imagen
            $imagen = $request->imageUrl;
            $imagenContenido = file_get_contents($imagen);
            $imagenNombre = 'imageUrl_' . time() . '.jpg'; // Generate a unique image name
            Storage::disk('public')->put($imagenNombre, $imagenContenido);
        
            //Accedemos a la ruta de la nueva imagen
            $imagePath = asset('storage/' . $imagenNombre);

            //Eliminamos imagen vieja
            
            $imageUrl = $cuento->url;
            if ($imageUrl) {
                $deleteImagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $imageUrl); // Remueve la url de imageUrl, deja solo el nombre
                Storage::disk('public')->delete($deleteImagePath);
            }
            $cuento->url = $imagePath;
        }
        $cuento->titulo = $request->titulo;
        $cuento->genero_id = $request->genero_id;
      
        $cuento->update();

        return redirect()->route('cuento.index')
            ->with('success', 'Cuento actualizado');
    }


    public function destroy($id)
    {
        $cuento = Cuento::find($id);

        $imageUrl = $cuento->url;

        if ($imageUrl) {
            $imagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $imageUrl); // Remueve la url de imageUrl, deja solo el nombre
            Storage::disk('public')->delete($imagePath);
        }

        $cuento->delete();
        return redirect()->route('cuento.index')
            ->with('success', 'Cuento eliminado');
    }

    public function generar($prompt)
    {
        $p = $prompt;
        
        $open_ai_key = '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';

        $open_ai = new OpenAi($open_ai_key);
        
        $images = $open_ai->image(
            [
                "prompt" => $p,
                "n" => 2,
                "size" => "256x256",
             ]
        );
       

        $responseData = json_decode($images, true);
        
        $urls = [];
        foreach ($responseData['data'] as $item) {
            $urls[] = $item['url'];
        }

        return response()->json([
            'images' => $urls
        ]);
    }
    
    public function descargar($id)
    {
        $cuento = Cuento::find($id);
        $usuario = User::find($cuento->user_id);
        $paginas = Pagina::where('cuento_id', $id)->paginate();
        
        for ($i=0; $i < count($paginas); $i++) { 
            $deleteImagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $paginas[$i]->url);
            $paginas[$i]->url = $deleteImagePath ;
        }
        
        // Agregado para la imagen del cuento
        $deleteImagePathCuento = str_replace(url('http://127.0.0.1:8000/storage/'), '', $cuento->url);
        $cuento->url = $deleteImagePathCuento ;


        $formattedPages = [];

        foreach ($paginas as $pagina) {
        // Get the HTML content from the TinyMCE editor instance
            $formattedContent = $pagina->text;
            $formattedPages[] = $formattedContent;
        }

        $pdf = Pdf::loadView('cuento.descargar', compact('cuento', 'formattedPages', 'usuario', 'paginas'));
        return $pdf->download("$cuento->titulo.pdf");

        //return view('cuento.show', compact('cuento','paginas'));
    }
}
