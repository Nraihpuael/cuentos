<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use App\Models\Genero;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Orhanerday\OpenAi\OpenAi;

class PaginaController extends Controller
{
 
    public function index($id)
    {
        $cuento = Cuento::find($id);
        $paginas = Pagina::where('cuento_id', $id)->paginate();
        
        return view('pagina.index', compact('paginas', 'id','cuento'))
            ->with('i', (request()->input('page', 1) - 1) * $paginas->perPage());
    }
    


    public function create($id)
    {
        $pagina = new Pagina();
        return view('pagina.create', compact('pagina', 'id'));
    }

   
    public function store(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
            'numeracion' => 'required|integer',
            'imageUrl' => 'required|url',
            'descripcion' => 'required|string'
        ]);

        $query = Pagina::where('id', $request->numeracion)->where('cuento_id', $id)->exists();
        
        if($query == false){
            $imagen = $request->imageUrl;

            //Creamos nueva imagen
            $imagenContenido = file_get_contents($imagen);
            $imagenNombre = 'imageUrl_' . time() . '.jpg'; // Genera nombre unico
            Storage::disk('public')->put($imagenNombre, $imagenContenido);
        
            //Accedemos a la ruta de la nueva imagen
            $imagenPath = asset('storage/' . $imagenNombre);
        
            $pagina = new Pagina();
            $pagina->id = $request->numeracion;
            $pagina->text = $request->text;
            $pagina->url = $imagenPath;
            $pagina->descripcion = $request->descripcion;
            $pagina->cuento_id = $id;
            
            $pagina->save();
    
            return redirect()->route('pagina.index', ['id' => $id])
                ->with('success', 'Nueva pagina añadida al cuento.');
        }
        return redirect()->route('pagina.create', ['id' => $id])
        ->with('success', 'El numero de pagina ya exite en este cuento.');
    }


    public function show($id,$cuento_id)
    {
        $cuento = Cuento::find($cuento_id);
        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $pagina = $query[0];
        
        return view('pagina.show', compact('pagina','cuento'));
    }

    
    public function edit($id,$cuento_id)
    {
        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $pagina = $query[0];
        return view('pagina.edit', compact('pagina'));
    }

    
    public function update(Request $request, $id, $cuento_id)
    {
        
        $request->validate([
            'text' => 'required|string',
            'imageUrl' => 'required|url',
            'descripcion' => 'required|string'
        ]);

        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
        
        if($query[0]->url != $request->imageUrl){
            //Creamos nueva imagen
            $imagen = $request->imageUrl;
            $imagenContenido = file_get_contents($imagen);
            $imagenNombre = 'imageUrl_' . time() . '.jpg'; // Generate a unique image name
            Storage::disk('public')->put($imagenNombre, $imagenContenido);
        
            //Accedemos a la ruta de la nueva imagen
            $imagePath = asset('storage/' . $imagenNombre);

            //Eliminamos imagen vieja
            $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
            $pagina = $query[0];
            $imageUrl = $pagina->url;

            if ($imageUrl) {
                $deleteImagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $imageUrl); // Remueve la url de imageUrl, deja solo el nombre
                Storage::disk('public')->delete($deleteImagePath);
            }
            DB::table('pagina')
                ->where('id', $id)
                ->where('cuento_id',  $cuento_id)
                ->update(['text' => $request->text,
                        'url' => $imagePath,
                        'descripcion' => $request->descripcion
                        ]);
        }else{
            DB::table('pagina')
                ->where('id', $id)
                ->where('cuento_id',  $cuento_id)
                ->update(['text' => $request->text,
                        'descripcion' => $request->descripcion
                        ]);
        }
        

        //Update
        
    
        return redirect()->route('pagina.index', ['id' => $cuento_id])
            ->with('success', 'Pagina Editada');
    }

    public function destroy($id,$cuento_id)
    {
        //Eliminar imagen
        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $pagina = $query[0];

        $imageUrl = $pagina->url;

        if ($imageUrl) {
            $imagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $imageUrl); // Remueve la url de imageUrl, deja solo el nombre
            Storage::disk('public')->delete($imagePath);
        }

        //Eliminar de la base
        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id);
        $query->delete();
    
        return redirect()->route('pagina.index', ['id' => $cuento_id])
            ->with('success', 'Pagina Borrada.');
    }

    public function generar($id,$prompt)
    {
        $cuento = Cuento::find($id);
        $genero = Genero::find($cuento->genero_id);

        $p = $genero->nombre .' '. $prompt;
        
        $open_ai_key = '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';

        $open_ai = new OpenAi($open_ai_key);
        
        $images = $open_ai->image(
            [
                "prompt" => $p,
                "n" => 2,
                "size" => "512x512",
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

    
}


/*
console.log(imageUrl);
        const defaultImgElement = document.createElement('img');
        defaultImgElement.src = imageUrl;
        defaultImgElement.alt = 'Default Image';

        firstFormImagesContainer.innerHTML = '';
        firstFormImagesContainer.appendChild(defaultImgElement);
*/ 