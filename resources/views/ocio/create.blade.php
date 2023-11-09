<x-layout>
    <div class="container">
        <h1>Crear Registro de Ocio</h1>

        <form action="{{ route('ocio.store') }}" method="post" enctype="multipart/form-data">
            @csrf <!-- Agrega el token CSRF para protección -->
            
            <div class="form-group">
                <label for="nombre" style="color: white;">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descripcion" style="color: white;">Descripción:</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>

            <div class="form-group mt-2">
                <label for="latitude" style="color: white;">Latitud:</label>
                <input type="text" name="latitude" class="form-control" placeholder="ej. -34.603722">
            </div>

            <!-- Campo Longitude -->
            <div class="form-group mt-2">
                <label for="longitude" style="color: white;">Longitud:</label>
                <input type="text" name="longitude" class="form-control" placeholder="ej. -58.381592">
            </div>

            <div class="form-group mt-2 mb-2">
                <label for="imagen" style="color: white; text-align: center;">Imagen Principal:</label>
                <input style="color: white; text-align: center;" type="file" name="imagen" class="form-control-file" id="imagenInput">
            </div>

            <!-- Campos nuevos para las imágenes adicionales -->
            <div class="form-group mt-2 mb-2">
                <label for="imagen2" style="color: white; text-align: center;">Imagen 2:</label>
                <input style="color: white; text-align: center;" type="file" name="imagen2" class="form-control-file" id="imagen2Input">
            </div>

            <div class="form-group mt-2 mb-2">
                <label for="imagen3" style="color: white; text-align: center;">Imagen 3:</label>
                <input style="color: white; text-align: center;" type="file" name="imagen3" class="form-control-file" id="imagen3Input">
            </div>

            <div class="form-group mt-2 mb-2">
                <label for="imagen4" style="color: white; text-align: center;">Imagen 4:</label>
                <input style="color: white; text-align: center;" type="file" name="imagen4" class="form-control-file" id="imagen4Input">
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-layout>
