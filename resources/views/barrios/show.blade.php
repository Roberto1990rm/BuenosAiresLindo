<x-layout>
    <div class="container text-center">
        <h1 class="title">{{ $barrio->title }}</h1>
        <img src="{{ asset('storage/' . $barrio->img) }}" alt="Imagen del Barrio" class="img-fluid">
        <div class="body-text">
            <p>{{ $barrio->body }}</p>
        </div>

        @if($barrio->latitude && $barrio->longitude)
            <div id="map"></div> <!-- Aquí iría el mapa -->
        @endif

        <!-- Sección de comentarios o reseñas aquí -->

    </div>

    <script>
        // Código JavaScript para inicializar el mapa
    </script>

    <style>
        #map {
            height: 400px; /* O el tamaño que prefieras */
        }
        .title, .body-text {
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .body-text {
            margin: 0 auto;
            max-width: 800px; /* Ajusta según prefieras */
            max-height: 300px; /* Altura máxima para la caja de texto */
            overflow-y: scroll; /* Permite desplazamiento vertical */
            padding: 15px; /* Espacio interno para una mejor lectura */
            border: 1px solid #ccc; /* Borde opcional para la caja */
            border-radius: 5px; /* Bordes redondeados */
            background-color: #f8f9fa; /* Fondo claro para la caja */
        }
        /* Aquí puedes agregar más estilos personalizados */
    </style>
</x-layout>

