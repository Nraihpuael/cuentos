<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cuentos =  Cuento::with('cuentopaginas')->paginate(10);
        
        return view('home', compact('cuentos'))
            ->with('i', ($cuentos->currentPage() - 1) * $cuentos->perPage());
    }

    public function guia()
    {
        return view('guia');
    }
    /*public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $imageUrl = asset('uploads/' . $imageName);

            return response()->json(['imageUrl' => $imageUrl], 200);
        }

        return response()->json(['message' => 'Image upload failed'], 400);
    }*/
    
}
