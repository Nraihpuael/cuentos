<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Asegúrate de importar el modelo User

class ProfileController extends Controller
{
    

    public function edit()
    {
        $user = auth()->user(); // Obtener el usuario autenticado actualmente

        return view('profile.edit', compact('user'));
    }

    public function show()
    {
        $user = auth()->user(); // Obtener el usuario autenticado actualmente

        return view('profile.show', compact('user'));
    }
    public function update(Request $request)
    {
        $user = auth()->user(); // Obtener el usuario autenticado actualmente

        // Validar los datos enviados en el formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'name_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Puedes agregar más reglas de validación según tus necesidades
        ]);

        // Actualizar los datos del usuario
        $user->update($validatedData);

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente');
    }

    public function destroy()
    {
        $user = auth()->user(); // Obtener el usuario autenticado actualmente

        // Eliminar el usuario
        $user->delete();

        return redirect()->route('home')->with('success', 'Usuario eliminado exitosamente');
    }
}
