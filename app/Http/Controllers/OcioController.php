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
            'latitude' => 'nullable|numeric', // Valida como número (ajusta las reglas según tus necesidades)
            'longitude' => 'nullable|numeric', // Valida como número (ajusta las reglas según tus necesidades)
            // Asegúrate de que la validación para las nuevas imágenes sea opcional si no son obligatorias
            'imagen2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'imagen3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'imagen4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);
    
        $ocio = new Ocio; // Crear una nueva instancia de Ocio
    
        // Subir y asignar la imagen principal
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/ocio_imagenes', $nombreImagen);
            $ocio->imagen = 'ocio_imagenes/' . $nombreImagen; // Asignar la imagen a la instancia de Ocio
        }
    
        // Subir y asignar la imagen 2
        if ($request->hasFile('imagen2')) {
            $imagen2 = $request->file('imagen2');
            $nombreImagen2 = time() . '_2_' . $imagen2->getClientOriginalName();
            $imagen2->storeAs('public/ocio_imagenes', $nombreImagen2);
            $ocio->imagen2 = 'ocio_imagenes/' . $nombreImagen2; // Asignar la imagen2 a la instancia de Ocio
        }
    
        // Subir y asignar la imagen 3
        if ($request->hasFile('imagen3')) {
            $imagen3 = $request->file('imagen3');
            $nombreImagen3 = time() . '_3_' . $imagen3->getClientOriginalName();
            $imagen3->storeAs('public/ocio_imagenes', $nombreImagen3);
            $ocio->imagen3 = 'ocio_imagenes/' . $nombreImagen3; // Asignar la imagen3 a la instancia de Ocio
        }
    
        // Subir y asignar la imagen 4
        if ($request->hasFile('imagen4')) {
            $imagen4 = $request->file('imagen4');
            $nombreImagen4 = time() . '_4_' . $imagen4->getClientOriginalName();
            $imagen4->storeAs('public/ocio_imagenes', $nombreImagen4);
            $ocio->imagen4 = 'ocio_imagenes/' . $nombreImagen4; // Asignar la imagen4 a la instancia de Ocio
        }
    
        $ocio->fill($data); // Llenar la instancia con los datos validados
        $ocio->save(); // Guardar el registro en la base de datos
    
        return redirect()->route('ocio.index')->with('success', 'El registro de ocio se ha creado con éxito.');
    }
    


    public function destroy(Ocio $ocio)
{
    $ocio->delete(); // Eliminar el registro
    return redirect()->route('ocio.index')->with('success', 'Registro eliminado correctamente');
}

    

    // Agrega otras acciones como show, edit, update y destroy según tus necesidades.
}

