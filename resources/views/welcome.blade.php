<x-layout>
    <style>
        /* Estilo para el efecto hover de los botones */
        .btn-primario, .btn-secundario {
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            transition: background 0.3s;
        }

        .btn-primario {
            background: #02475e;
        }

        .btn-secundario {
            background: #FF6B6B;
        }

        .btn-primario:hover {
            background: #2500cc; /* Cambia el color al pasar el mouse */
        }

        .btn-secundario:hover {
            background: #dd0808; /* Cambia el color al pasar el mouse */
        }
    </style>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    @section('content')
        <!-- Sección de bienvenida -->
        <section class="welcome-section" style="background: linear-gradient(to bottom, #007BFF, #00BFFF); color: #fff; padding: 60px; opacity: 0.8;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 style="font-size: 36px;">¡Bienvenido a Buenos Aires Lindo!</h1>
                        <p style="font-size: 18px; color: #0e0e0e;">La guía definitiva de Buenos Aires.</p>
                        <p style="font-size: 18px;">Explora los parques y barrios más hermosos de Buenos Aires.</p>
                        <a href="{{ route('parques.index') }}" class=" btn-primario">Ver Parques</a>
                    </div>
                    <div class="col-md-6">
                        <!-- Agrega una imagen o animación atractiva aquí -->
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Otra sección interesante -->
        <section class="another-section" style="background: #F8F9FA; padding: 60px; opacity: 0.8;">
            <div class="container">
                <h2 style="font-size: 30px; color: #333;">Descubre más</h2>
                <p style="font-size: 18px; color: #555;">Encuentra los mejores bares y restaurantes en los barrios porteños.</p>
                <a href="{{ route('bares.index') }}" class=" btn-secundario">Ver Bares</a>
            </div>
        </section>
    </div>
</x-layout>
