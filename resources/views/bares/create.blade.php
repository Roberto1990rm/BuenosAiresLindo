<x-layout>
    <div class="container">
        <h1 style="color: rgb(102, 100, 100);">Crear un Nuevo Bar</h1>
        <form action="{{ route('bares.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre" style="color: white;">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" style="color: rgb(46, 45, 45);">
            </div>
            <div class="form-group">
                <label for="direccion" style="color: white;">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control" style="color: rgb(36, 35, 35);">
            </div>
            <div class="form-group">
                <label for="barrio_id" style="color: white;">Barrio:</label>
                <select name="barrio_id" id="barrio_id" class="form-control" style="color: rgb(16, 15, 15);">
                    @foreach($barrios as $barrio)
                        <option value="{{ $barrio->id }}">{{ $barrio->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion" style="color: white;">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" style="color: rgb(22, 20, 20);"></textarea>
            </div>
            <div class="form-group">
                <label for="precios" style="color: white;">Precios:</label>
                <input type="text" name="precios" id="precios" class="form-control" style="color: rgb(20, 20, 20);">
            </div>
            <div class="form-group">
                <label for="latitude" style="color: white;">Latitud:</label>
                <input type="text" name="latitude" id="latitude" class="form-control" style="color: rgb(30, 29, 29);">
            </div>
            <div class="form-group">
                <label for="longitude" style="color: white;">Longitud:</label>
                <input type="text" name="longitude" id="longitude" class="form-control" style="color: rgb(19, 19, 19);">
            </div>
            <div class="form-group">
                <label for="horario" style="color: white;">Horario:</label>
                <input type="text" name="horario" id="horario" class="form-control" style="color: rgb(64, 63, 63);">
            </div>
            <div class="form-group">
                <label for="image1" style="color: white;">Imagen 1:</label>
                <input type="file" name="image1" id="image1" class="form-control" style="color: rgb(64, 63, 63);">
            </div>
            <div class="form-group">
                <label for="image2" style="color: white;">Imagen 2:</label>
                <input type="file" name="image2" id="image2" class="form-control" style="color: rgb(64, 63, 63);">
            </div>
            <div class="form-group">
                <label for="image3" style="color: white;">Imagen 3:</label>
                <input type="file" name="image3" id="image3" class="form-control" style="color: rgb(64, 63, 63);">
            </div>
            <div class="form-group">
                <label for="image4" style="color: white;">Imagen 4:</label>
                <input type="file" name="image4" id="image4" class="form-control" style="color: rgb(64, 63, 63);">
            </div>
            <button type="submit" class="btn btn-primary mb-2 mt-2" style="color: white;">Guardar</button>
        </form>
    </div>
</x-layout>
