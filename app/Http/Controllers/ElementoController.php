<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use App\Models\Elemento;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Orhanerday\OpenAi\OpenAi;

class ElementoController extends Controller
{
   
    public function index($id)
    {
        $cuento = Cuento::find($id);
        $tipos = Tipo::all();
        $elementos = Elemento::where('cuento_id', $id)->paginate();
        
        return view('elemento.index', compact('elementos', 'id','cuento','tipos'))
            ->with('i', (request()->input('page', 1) - 1) * $elementos->perPage());
    }

    
    

    public function create($id)
    {
        $elemento = new Elemento();
        $tipos = Tipo::all();
        return view('elemento.create', compact('elemento', 'id','tipos'));
    }

   
    public function store(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'text' => 'required|string',
            'imageUrl' => 'required|url',
            'descripcion' => 'required|string',
            'tipo' => 'required'
        ]);

            $imagen = $request->imageUrl;

            //Creamos nueva imagen
            $imagenContenido = file_get_contents($imagen);
            $imagenNombre = 'imageUrl_' . time() . '.jpg'; // Genera nombre unico
            Storage::disk('public')->put($imagenNombre, $imagenContenido);
        
            //Accedemos a la ruta de la nueva imagen
            $imagenPath = asset('storage/' . $imagenNombre);
        
            $elemento = new Elemento();
            $elemento->nombre = $request->nombre;
            $elemento->text = $request->text;
            $elemento->url = $imagenPath;
            $elemento->descripcion = $request->descripcion;
            $elemento->cuento_id = $id;
            $elemento->tipo_id = $request->tipo;
            
            $elemento->save();
    
            return redirect()->route('elemento.index', ['id' => $id])
                ->with('success', 'Nuevo elemento añadida al cuento.');
    }


    public function show($id,$cuento_id)
    {
        $cuento = Cuento::find($cuento_id);
        $query1 = Elemento::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $elemento = $query1[0];
        $query2 = Tipo::where('id', $elemento->tipo_id)->get();
        $tipo= $query2[0];

        return view('elemento.show', compact('elemento','cuento','tipo'));
    }

    
    public function edit($id,$cuento_id)
    {
        $query = Elemento::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $elemento = $query[0];
        return view('elemento.edit', compact('elemento'));
    }

    
    public function update(Request $request, $id, $cuento_id)
    {
        
        $request->validate([
            'nombre' => 'required|string',
            'text' => 'required|string',
            'imageUrl' => 'required|url',
            'descripcion' => 'required|string'
        ]);

        $query = Elemento::where('id', $id)->where('cuento_id', $cuento_id)->get();
        
        if($query[0]->url != $request->imageUrl){
            //Creamos nueva imagen
            $imagen = $request->imageUrl;
            $imagenContenido = file_get_contents($imagen);
            $imagenNombre = 'imageUrl_' . time() . '.jpg'; // Generate a unique image name
            Storage::disk('public')->put($imagenNombre, $imagenContenido);
        
            //Accedemos a la ruta de la nueva imagen
            $imagePath = asset('storage/' . $imagenNombre);

            //Eliminamos imagen vieja
            $query = Elemento::where('id', $id)->where('cuento_id', $cuento_id)->get();
            $elemento = $query[0];
            $imageUrl = $elemento->url;

            if ($imageUrl) {
                $deleteImagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $imageUrl); // Remueve la url de imageUrl, deja solo el nombre
                Storage::disk('public')->delete($deleteImagePath);
            }
            DB::table('elemento')
                ->where('id', $id)
                ->where('cuento_id',  $cuento_id)
                ->update(['text' => $request->text,
                        'url' => $imagePath,
                        'descripcion' => $request->descripcion
                        ]);
        }else{
            DB::table('elemento')
                ->where('id', $id)
                ->where('cuento_id',  $cuento_id)
                ->update(['text' => $request->text,
                        'descripcion' => $request->descripcion
                        ]);
        }
        

        //Update
        
    
        return redirect()->route('elemento.index', ['id' => $cuento_id])
            ->with('success', 'Elemento actualizado');
    }

    public function destroy($id,$cuento_id)
    {
        //Eliminar imagen
        $query = Elemento::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $elemento = $query[0];

        $imageUrl = $elemento->url;

        if ($imageUrl) {
            $imagePath = str_replace(url('http://127.0.0.1:8000/storage/'), '', $imageUrl); // Remueve la url de imageUrl, deja solo el nombre
            Storage::disk('public')->delete($imagePath);
        }

        //Eliminar de la base
        $query = Elemento::where('id', $id)->where('cuento_id', $cuento_id);
        $query->delete();
    
        return redirect()->route('elemento.index', ['id' => $cuento_id])
            ->with('success', 'Elemento borrada.');
    }

    public function generar($id,$prompt)
    {
        $cuento = Cuento::find($id);
        
        $open_ai_key = '';

        $open_ai = new OpenAi($open_ai_key);
        
        $images = $open_ai->image(
            [
                "prompt" => $prompt,
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
