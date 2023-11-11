<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barrio;
use Illuminate\Support\Facades\Storage;
use App\Models\Bar;
use Illuminate\Support\Str;

class BaresController extends Controller
{
    public function create()
    {
        $barrios = Barrio::all(); // Aquí obtienes los barrios de tu base de datos
    
        return view('bares.create', compact('barrios'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
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
    
        $bar = new Bar();
        $bar->nombre = $request->input('nombre');
        $bar->direccion = $request->input('direccion');
        $bar->barrio_id = $request->input('barrio_id');
        $bar->descripcion = $request->input('descripcion');
        $bar->precios = $request->input('precios');
        $bar->latitude = $request->input('latitude');
        $bar->longitude = $request->input('longitude');
        $bar->horario = $request->input('horario');
        $bar->image1 = $request->hasFile('image1') ? $request->file('image1')->store('bar_images', 'public') : null;
        $bar->image2 = $request->hasFile('image2') ? $request->file('image2')->store('bar_images', 'public') : null;
        $bar->image3 = $request->hasFile('image3') ? $request->file('image3')->store('bar_images', 'public') : null;
        $bar->image4 = $request->hasFile('image4') ? $request->file('image4')->store('bar_images', 'public') : null;
    
        $bar->save();
    
        return redirect('/')->with('success', 'Bar creado correctamente');
    }
    
    

    

public function index()
{
    $bares = Bar::all(); // Obtén todos los bares de la base de datos
    return view('bares.index', compact('bares'));
}


public function show($id)
{
    $bar = Bar::findOrFail($id);
    return view('bares.show', compact('bar'));
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
