<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barrio;
use App\Models\Bar;
use Illuminate\Support\Facades\Storage;





class BarriosController extends Controller
{
    public function create()
{
    return view('barrios.create');
}



public function store(Request $request)
{
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|max:2000',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida y permite imágenes (ajusta los formatos y el tamaño según tus necesidades)
        'latitude' => 'nullable|numeric', // Valida como número (ajusta las reglas según tus necesidades)
        'longitude' => 'nullable|numeric', // Valida como número (ajusta las reglas según tus necesidades)
    ]);

    // Crear un nuevo Barrio con los datos validados, incluyendo las nuevas columnas
    $barrio = new Barrio([
        'title' => $validatedData['title'],
        'body' => $validatedData['body'],
        'img' => $request->file('img')->store('barrios', 'public'), // Almacena la imagen y ajusta la ubicación según tu configuración
        'latitude' => $validatedData['latitude'],
        'longitude' => $validatedData['longitude'],
    ]);

    // Guardar el Barrio en la base de datos
    $barrio->save();

    // Redirigir a la página de inicio o a donde desees después de guardar
    return redirect('/')->with('success', 'Barrio creado correctamente');
}


public function delete($id)
{
    // Encuentra el barrio por su ID
    $barrio = Barrio::with('bares')->find($id);

    // Si el barrio no se encuentra, redirige con un mensaje de error
    if (!$barrio) {
        return redirect('/')->with('error', 'Barrio no encontrado');
    }

    // Elimina primero los registros dependientes en la tabla bares
    if ($barrio->bares) {
        foreach ($barrio->bares as $bar) {
            $bar->delete();
        }
    }

    // Elimina la imagen asociada si existe
    if (Storage::disk('public')->exists($barrio->img)) {
        Storage::disk('public')->delete($barrio->img);
    }

    // Elimina el barrio de la base de datos
    $barrio->delete();

    return redirect('/')->with('success', 'Barrio eliminado correctamente');
}






public function index()
{
    $barrios = Barrio::whereNotNull('latitude')->whereNotNull('longitude')->get();

    foreach ($barrios as $barrio) {
        if (empty($barrio->imagen)) {
            $barrio->imagen = asset('storage/bar.jpg');
        }
    }
    return view('barrios.index', compact('barrios'));
}






}
