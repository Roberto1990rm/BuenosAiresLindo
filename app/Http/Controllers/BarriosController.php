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
    $request->validate([
        'title' => 'required|string',
        'body' => 'required|string|min:179',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // Valida las imágenes adicionales
        'imagen2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imagen3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imagen4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imagen5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    $barrio = new Barrio();
    $barrio->title = $request->input('title');
    $barrio->body = $request->input('body');
    $barrio->img = $request->hasFile('img') ? $request->file('img')->store('barrios', 'public') : null;

    // Manejar la subida de las imágenes adicionales
    $barrio->imagen2 = $request->hasFile('imagen2') ? $request->file('imagen2')->store('barrios', 'public') : null;
    $barrio->imagen3 = $request->hasFile('imagen3') ? $request->file('imagen3')->store('barrios', 'public') : null;
    $barrio->imagen4 = $request->hasFile('imagen4') ? $request->file('imagen4')->store('barrios', 'public') : null;
    $barrio->imagen5 = $request->hasFile('imagen5') ? $request->file('imagen5')->store('barrios', 'public') : null;

    $barrio->latitude = $request->input('latitude');
    $barrio->longitude = $request->input('longitude');
    $barrio->save();

    return redirect('/')->with('success', 'Barrio creado correctamente');
}


public function delete($id)
{
    $barrio = Barrio::with('bares')->find($id);

    if (!$barrio) {
        return redirect('/')->with('error', 'Barrio no encontrado');
    }

    if ($barrio->bares) {
        foreach ($barrio->bares as $bar) {
            $bar->delete();
        }
    }

// Eliminar la imagen principal y las imágenes adicionales
$imageFields = ['img', 'imagen2', 'imagen3', 'imagen4', 'imagen5'];
foreach ($imageFields as $fieldName) {
    if ($barrio->$fieldName && Storage::disk('public')->exists($barrio->$fieldName)) {
        Storage::disk('public')->delete($barrio->$fieldName);
    }
}


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
