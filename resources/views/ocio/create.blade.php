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

            <div class="form-group mt-2 mb-2">
                <label for="imagen" style="color: white; text-align: center;">Imagen:</label>
                <input style="color: white; text-align: center;" type="file" name="imagen" class="form-control-file" id="imagenInput">
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-layout>