<x-layout>
    <div class="container mt-4">
        <h1>Crear Barrio</h1>
        <form method="POST" action="{{ route('barrios.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título del Barrio</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            
            <div class="mb-3">
                <label for="body" class="form-label">Descripción</label>
                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitud</label>
                <input type="text" class="form-control" id="latitude" name="latitude">
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitud</label>
                <input type="text" class="form-control" id="longitude" name="longitude">
            </div>
            @if (auth()->check() && auth()->user()->admin == 1)
            <button type="submit" class="btn btn-primary mb-2">Guardar</button>
        @endif
        
        </form>
    </div>
    




</x-layout>