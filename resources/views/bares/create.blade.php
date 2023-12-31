<x-layout>
    <div class="container">
        <h1 style="color: rgb(102, 100, 100);">Crear un Nuevo Bar</h1>
        <form action="{{ route('bares.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            
                        <div class="form-group">
                            <label for="nombre" style="color: white;">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" style="color: rgb(46, 45, 45);">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="direccion" style="color: white;">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" style="color: rgb(36, 35, 35);">
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="barrio_id" style="color: white;">Barrio:</label>
                            <select name="barrio_id" id="barrio_id" class="form-control @error('barrio_id') is-invalid @enderror" style="color: rgb(16, 15, 15);">
                                @foreach($barrios as $barrio)
                                    <option value="{{ $barrio->id }}">{{ $barrio->title }}</option>
                                @endforeach
                            </select>
                            @error('barrio_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="descripcion" style="color: white;">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4" style="color: rgb(22, 20, 20);"></textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="precios" style="color: white;">Precios:</label>
                            <input type="text" name="precios" id="precios" class="form-control @error('precios') is-invalid @enderror" style="color: rgb(20, 20, 20);">
                            @error('precios')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="horario" style="color: white;">Horario:</label>
                            <input type="text" name="horario" id="horario" class="form-control @error('horario') is-invalid @enderror" style="color: rgb(64, 63, 63);">
                            @error('horario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="latitude" style="color: white;">Latitud:</label>
                            <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" style="color: rgb(30, 29, 29);">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="longitude" style="color: white;">Longitud:</label>
                            <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" style="color: rgb(19, 19, 19);">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

            
                        <!-- Campos para Imágenes con validación -->
                        <div class="form-group">
                            <label for="image1" style="color: white;">Imagen 1:</label>
                            <input type="file" name="image1" id="image1" class="form-control @error('image1') is-invalid @enderror" style="color: rgb(64, 63, 63);">
                            @error('image1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
