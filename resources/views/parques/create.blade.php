<x-layout>
    <div class="container">
        <h1 class="text-center mt-5 mb-4">Crear un Nuevo Parque</h1>
        <div class="row justify-content-center" style="color: azure">
            <div class="col-md-6">
                <form action="{{ route('parques.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Parque</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control" id="calle" name="calle" required>
                    </div>
                    <div class="mb-3">
                        <label for="barrio_id" class="form-label">Barrio</label>
                        <select class="form-select" id="barrio_id" name="barrio_id" required>
                            @foreach ($barrios as $barrio)
                                <option value="{{ $barrio->id }}">{{ $barrio->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitud</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitud</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>
                    @if (auth()->user()->admin == 1)
                    <button type="submit" class="btn btn-primary mb-2">Crear Parque</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-layout>
