<x-layout>
    <div class="container text-center">
        <h1 class="title" style="color: rgb(8, 67, 103)">{{ $parque->nombre }}</h1>

        <!-- Carrusel de imágenes para el parque -->
        <div id="carouselParque" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ([$parque->imagen] as $img)
                    @if ($img)
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $img) }}" class="d-block w-100" alt="Imagen del Parque">
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselParque" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselParque" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

        <!-- Descripción del parque con opacidad en el fondo -->
        <div class="body-text" style="background-color: rgba(255, 253, 253, 0.5);">
            <p><strong>Descripción:</strong> {{ $parque->descripcion }}</p>
            <p><strong>Calle:</strong> {{ $parque->calle }}</p>
        </div>

        <!-- Botón de regreso con estilos .danger -->
        <a href="{{ url('/parques') }}" class="btn mt-3 mb-3 danger">Volver a Parques</a>
    </div>

    <!-- Estilos personalizados -->
    <style>
        .title, .body-text {
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .body-text {
            margin: 0 auto;
            text-align: justify;
            max-width: 800px;
            max-height: 300px;
            overflow-y: scroll;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .danger {
            background-color: #e05b5b;
        }
        .danger:hover {
            background-color: #fa0606;
        }
    </style>
</x-layout>
