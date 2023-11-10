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
    dd($request->all()); 
    $request->validate([
        'title' => 'required|string',
        'body' => 'required|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    // Crear una nueva instancia del modelo Barrio y asignar valores usando input()
    $barrio = new Barrio();
    $barrio->title = $request->input('title');
    $barrio->body = $request->input('body');
    $barrio->img = $request->hasFile('img') ? $request->file('img')->store('barrios', 'public') : null; // Verifica si hay archivo de imagen y lo almacena
    $barrio->latitude = $request->input('latitude');
    $barrio->longitude = $request->input('longitude');

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




public function show(Barrio $barrio)
{
    return view('barrios.show', compact('barrio'));
}

}
