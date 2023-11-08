<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parque;
use App\Models\Barrio;
use Illuminate\Support\Facades\Storage;

class ParqueController extends Controller
{
    public function index()
    {
        $parques = Parque::all();
        return view('parques.index', compact('parques'));
    }

    public function create()
    {
        $barrios = Barrio::all(); // Obtén todos los barrios disponibles desde tu modelo Barrio

        return view('parques.create', compact('barrios'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'calle' => 'required|string|max:255',
            'barrio_id' => 'required|exists:barrios,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen (formato y tamaño)
        ]);
    
        // Crear una nueva instancia del modelo Parque
        $parque = new Parque();
        $parque->nombre = $request->input('nombre');
        $parque->descripcion = $request->input('descripcion');
        $parque->calle = $request->input('calle');
        $parque->barrio_id = $request->input('barrio_id');
        $parque->latitude = $request->input('latitude');
        $parque->longitude = $request->input('longitude');
    
        // Procesar la imagen si se ha cargado
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('public/parque_imagenes', $nombreImagen);
            $parque->imagen = 'parque_imagenes/' . $nombreImagen;
        }
    
        // Guardar el parque en la base de datos
        $parque->save();
    
        // Redireccionar a una vista de éxito o a la lista de parques
        return redirect()->route('parques.index')->with('success', 'Parque creado correctamente');
    }
    
    

    public function show($id)
    {
        $parque = Parque::find($id);
        return view('parques.show', compact('parque'));
    }

    

    


    public function destroy($id)
{
    // Encuentra el parque por su ID
    $parque = Parque::find($id);

    // Verifica si el parque existe
    if (!$parque) {
        return redirect()->route('parques.index')->with('error', 'Parque no encontrado');
    }

    // Elimina el parque de la base de datos
    $parque->delete();

    return redirect()->route('parques.index')->with('success', 'Parque eliminado correctamente');
}

}
