<x-layout>
    <div class="container">
        <h1 class="mt-3" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #007BFF; font-size: 38px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff; ">Actividades</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle; background-color:aqua; opacity: 0.9;">Actividad</th>
                    <th style="text-align: center; vertical-align: middle;  background-color:rgb(128, 255, 0); opacity: 0.9;">Descripción</th>
                    <th style="text-align: center; vertical-align: middle; background-color:aqua; opacity: 0.9;">Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ocios as $ocio)
                    <tr>
                        <td style="text-align: center; vertical-align: middle; opacity: 0.9;">{{ $ocio->nombre }}</td>
                        <td style="text-align: center; vertical-align: middle; opacity: 0.9;">{{ $ocio->descripcion }}<form action="{{ route('ocio.destroy', $ocio->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            @if (auth()->check() && auth()->user()->admin == 1)
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                        </form>
                        @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle; opacity: 0.9;">
                            @if ($ocio->imagen)
                                <img src="{{ asset('storage/' . $ocio->imagen) }}" alt="{{ $ocio->nombre }}" width="100">
                            @else
                                No hay imagen
                            @endif
                        </td>
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
