<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocio;

class OcioController extends Controller
{
    public function index()
    {
        $ocios = Ocio::all(); // Recupera todos los registros de la tabla "ocio"
        return view('ocio.index', ['ocios' => $ocios]);
    }

    public function create()
    {
        return view('ocio.create');
    }

    public function store(Request $request)
    {
        // Valida y almacena un nuevo registro en la tabla "ocio"
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required',
        ]);
    
        $ocio = new Ocio; // Crear una nueva instancia de Ocio
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/ocio_imagenes', $nombreImagen);
            $ocio->imagen = 'ocio_imagenes/' . $nombreImagen; // Asignar la imagen a la instancia de Ocio
        }
    
        $ocio->fill($data); // Llenar la instancia con los datos validados
        $ocio->save(); // Guardar el registro en la base de datos
    
        return redirect()->route('ocio.index');
    }


    public function destroy(Ocio $ocio)
{
    $ocio->delete(); // Eliminar el registro
    return redirect()->route('ocio.index')->with('success', 'Registro eliminado correctamente');
}

    

    // Agrega otras acciones como show, edit, update y destroy según tus necesidades.
}

