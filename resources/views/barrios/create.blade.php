<x-layout>
    <div class="container mt-4" style="color: white;">
        <h1 style="color: black">Crear Barrio</h1>
        <form method="POST" action="{{ route('barrios.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título del Barrio</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Descripción</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3" minlength="179" required></textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitud</label>
                <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude">
                @error('latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitud</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude">
                @error('longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="img" class="form-label">Imagen</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Campos para imágenes adicionales -->
            <div class="mb-3">
                <label for="imagen2" class="form-label">Imagen 2</label>
                <input type="file" class="form-control" id="imagen2" name="imagen2">z
            </div>
            <div class="mb-3">
                <label for="imagen3" class="form-label">Imagen 3</label>
                <input type="file" class="form-control" id="imagen3" name="imagen3">
            </div>
            <div class="mb-3">
                <label for="imagen4" class="form-label">Imagen 4</label>
                <input type="file" class="form-control" id="imagen4" name="imagen4">
            </div>
            <div class="mb-3">
                <label for="imagen5" class="form-label">Imagen 5</label>
                <input type="file" class="form-control" id="imagen5" name="imagen5">
            </div>


           
            @if (auth()->check() && auth()->user()->admin == 1)
            <button type="submit" class="btn btn-primary mb-2">Guardar</button>
        @endif
        
        </form>
    </div>
    




</x-layout>