<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barrio;
use Illuminate\Support\Facades\Storage;
use App\Models\Bar;

class BaresController extends Controller
{
    public function create()
    {
        $barrios = Barrio::all(); // Aquí obtienes los barrios de tu base de datos
    
        return view('bares.create', compact('barrios'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string',
        'barrio_id' => 'required|exists:barrios,id',
        'descripcion' => 'required|string',
        'precios' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'horario' => 'required|string',
        'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $bar = new Bar([
        'nombre' => $validatedData['nombre'],
        'direccion' => $validatedData['direccion'],
        'barrio_id' => $validatedData['barrio_id'],
        'descripcion' => $validatedData['descripcion'],
        'precios' => $validatedData['precios'],
        'latitude' => $validatedData['latitude'],
        'longitude' => $validatedData['longitude'],
        'horario' => $validatedData['horario'],
    ]);

    if ($request->hasFile('image1')) {
        $bar->image1 = $request->file('image1')->store('bar_images', 'public');
    }

    if ($request->hasFile('image2')) {
        $bar->image2 = $request->file('image2')->store('bar_images', 'public');
    }

    if ($request->hasFile('image3')) {
        $bar->image3 = $request->file('image3')->store('bar_images', 'public');
    }

    if ($request->hasFile('image4')) {
        $bar->image4 = $request->file('image4')->store('bar_images', 'public');
    }

    $bar->save();

    return redirect('/')->with('success', 'Bar creado correctamente');
}

    

public function index()
{
    $bares = Bar::all(); // Obtén todos los bares de la base de datos
    return view('bares.index', compact('bares'));
}


public function destroy(Bar $bar)
{
    // Verificar si el usuario tiene permisos de administrador
    if (auth()->user()->admin != 1) {
        return redirect()->route('bares.index')->with('error', 'No tienes permiso para eliminar bares.');
    }

    // Realizar la eliminación del bar
    $bar->delete();

    return redirect()->route('bares.index')->with('success', 'Bar eliminado correctamente.');
}


}
