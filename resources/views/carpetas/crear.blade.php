@extends('layouts.app')

@section('title', 'Crear Carpeta')

@section('css')
    <style>
        /* Estilos aplicados del formulario de "Crear Rol" */

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(128, 0, 32, 0.1);
            backdrop-filter: blur(5px);
            animation: slideIn 0.8s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #800020, #b30000);
            background-size: 200% auto;
            animation: shimmer 6s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        .page-background {
            background-color: #dbd6d7;
            background-image:
                linear-gradient(45deg, rgba(0, 48, 73, 0.03) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(0, 48, 73, 0.03) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(0, 48, 73, 0.03) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(0, 48, 73, 0.03) 75%),
                radial-gradient(circle at 50% 50%, rgba(0, 48, 73, 0.05) 2px, transparent 3px);
            background-size: 50px 50px, 50px 50px, 50px 50px, 50px 50px, 25px 25px;
            background-position: 0 0, 25px 0, 25px -25px, 0 0, 0 0;
            padding: 60px 0;
            min-height: 100vh;
        }

        .page-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 30%, rgba(0, 48, 73, 0.08) 0%, transparent 60%),
                radial-gradient(circle at 70% 70%, rgba(0, 48, 73, 0.08) 0%, transparent 60%);
            pointer-events: none;
            z-index: -1;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 16px;
            letter-spacing: 0.3px;
            display: block;
        }

        .form-control {
            padding: 12px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 16px;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .form-control:focus {
            border-color: #800020;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
            outline: none;
            background-color: #fff;
        }

        .form-control:hover {
            border-color: #800020;
        }

        .form-error {
            border-color: #e53e3e !important;
            box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.2) !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #800020 0%, #b30000 100%);
            color: #fff;
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(128, 0, 32, 0.2);
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        .card-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .card-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #800020, #b30000);
            border-radius: 2px;
        }

        .mb-4 {
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-row .form-group {
            flex: 1;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
        }

        .alert-success,
        .alert-error {
            padding: 16px 20px;
            border-radius: 12px;
            margin: 25px 0;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-left: 5px solid #22c55e;
            color: #166534;
        }

        .alert-error {
            background-color: #fef2f2;
            border-left: 5px solid #ef4444;
            color: #991b1b;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            color: #800020;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-back i {
            margin-right: 8px;
        }

        .btn-back:hover {
            color: #b30000;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            font-size: 17px !important;
        }

        /* Estilos adicionales para el carrito de documentos */
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item button {
            margin-left: 10px;
        }

        .disabled-option {
            color: #6c757d;
            /* Gris claro */
        }


        .document-section {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(128, 0, 32, 0.1);
        }

        .document-section h4 {
            color: #800020;
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(128, 0, 32, 0.1);
        }

        .document-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .document-form-group {
            position: relative;
        }

        .document-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 500;
        }

        .document-form-group input,
        .document-form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .document-form-group input:focus,
        .document-form-group select:focus {
            border-color: #800020;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        }

        .add-document-btn {
            background: linear-gradient(135deg, #800020 0%, #b30000 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
            width: 100%;
            max-width: 200px;
            margin: 20px auto 0;
        }

        .add-document-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.2);
        }

        /* Enhanced Shopping Cart Style */
        .document-cart {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(128, 0, 32, 0.1);
        }

        .document-cart h5 {
            color: #800020;
            font-size: 1.3rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .document-cart h5 i {
            font-size: 1.5rem;
        }

        .cart-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .cart-item:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .cart-item-info {
            flex-grow: 1;
        }

        .cart-item-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .cart-item-details {
            font-size: 0.9rem;
            color: #718096;
        }

        .remove-item-btn {
            background: #fee2e2;
            color: #991b1b;
            border: none;
            padding: 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-item-btn:hover {
            background: #fecaca;
            transform: scale(1.1);
        }

        .cart-empty {
            text-align: center;
            padding: 30px;
            color: #718096;
            font-style: italic;
        }

        .text-warning {
            font-size: 0.9rem;
            font-weight: 600;
            color: #b30000;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cart-item {
            animation: slideIn 0.3s ease-out forwards;
        }

        .text-warning {
            background-color: #fff3f3;
            border-left: 4px solid #b30000;
            padding: 12px 20px;
            border-radius: 8px;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 0.95rem;
            color: #b30000;
            box-shadow: 0 2px 4px rgba(179, 0, 0, 0.1);
            animation: fadeInWarning 0.3s ease-out forwards;
        }

        .text-warning::before {
            content: '\f071';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 1.1rem;
        }

        @keyframes fadeInWarning {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .toggle-documents-btn {
            background: linear-gradient(135deg, #800020 0%, #b30000 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(128, 0, 32, 0.2);
        }

        .toggle-documents-btn i {
            font-size: 1.4rem;
        }

        .toggle-documents-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
            background: linear-gradient(135deg, #990033 0%, #cc0000 100%);
        }

        .toggle-documents-btn:active {
            transform: translateY(1px);
        }

        .toggle-documents-btn.active {
            background: linear-gradient(135deg, #660019 0%, #990000 100%);
        }

        #documentSections {
            animation: slideDown 0.4s ease-out;
        }

        /* Tamaño de Fuente para Inputs y Selects */
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            font-size: 20px !important;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-section {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(128, 0, 32, 0.1);
        }

        .search-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 12px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #800020;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
            outline: none;
        }

        .search-btn {
            background: linear-gradient(135deg, #800020 0%, #b30000 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.2);
        }

        .evaluado-select-container {
            position: relative;
        }

        .evaluado-search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .evaluado-search-results.show {
            display: block;
        }

        .evaluado-search-item {
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .evaluado-search-item:hover {
            background-color: #f7fafc;
        }

        .evaluado-search-item.disabled {
            color: #a0aec0;
            cursor: not-allowed;
            background-color: #f3f4f6;
        }

        input[type="form-label"],
        input[type="document-form-group"],
        select,
        textarea {
            font-size: 17px !important;
        }


        /* Estilos mejorados para los elementos del carrito de documentos */

        /* Estilo para cada ítem del carrito */
        .cart-item {
            background: #f8fafc;
            /* Fondo ligeramente gris */
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Efecto hover para los ítems del carrito */
        .cart-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Contenedor de la información del documento */
        .cart-item-info {
            flex-grow: 1;
            margin-right: 15px;
        }

        /* Título del documento en el carrito */
        .cart-item-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        /* Detalles del documento en el carrito */
        .cart-item-details {
            font-size: 0.95rem;
            color: #4a5568;
        }

        /* Botón para eliminar un documento del carrito */
        .remove-item-btn {
            background: #fee2e2;
            /* Fondo rojo claro */
            color: #991b1b;
            /* Texto rojo oscuro */
            border: none;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Efecto hover para el botón de eliminar */
        .remove-item-btn:hover {
            background: #fecaca;
            /* Fondo rojo más intenso al pasar el cursor */
            transform: scale(1.1);
            /* Aumenta ligeramente el tamaño */
        }

        /* Icono dentro del botón de eliminar */
        .remove-item-btn i {
            font-size: 1rem;
        }

        /* Estilo para el contenedor vacío del carrito */
        .cart-empty {
            text-align: center;
            padding: 30px 0;
            color: #718096;
            font-style: italic;
        }

        /* Icono dentro del contenedor vacío */
        .cart-empty i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #a0aec0;
            /* Gris medio para el icono */
        }

        /* Animación para añadir ítems al carrito */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Aplicar animación a cada ítem del carrito al ser agregado */
        .cart-item {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Estilos mejorados para el título de la sección de documentos */
        .document-cart h5 {
            display: flex;
            align-items: center;
            font-size: 1.3rem;
            color: #800020;
            margin-bottom: 20px;
            gap: 10px;
            /* Espacio entre el icono y el texto */
        }

        .document-cart h5 i {
            font-size: 1.5rem;
            color: var(--gold);
            /* Utiliza el color dorado definido */
        }

        /* Ajustes para la lista de ítems del carrito */
        .cart-items {
            max-height: 300px;
            /* Altura máxima para scroll */
            overflow-y: auto;
            padding-right: 10px;
            /* Espacio para el scrollbar */
        }

        /* Scrollbar personalizado para la lista de ítems del carrito */
        .cart-items::-webkit-scrollbar {
            width: 6px;
        }

        .cart-items::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .cart-items::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .cart-items::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Responsividad para dispositivos móviles */
        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-info {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .remove-item-btn {
                align-self: flex-end;
            }

            .form-error {
                border-color: #e53e3e !important;
                box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.2) !important;
            }

            .error-message {
                color: #e53e3e;
                font-size: 0.875rem;
                margin-top: 0.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .error-message i {
                font-size: 1rem;
            }
        }
        /* Contenedor del input de búsqueda */
.search-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

/* Estilo para el icono de búsqueda */
.search-icon {
    position: absolute;
    right: 16px;
    color: #800020;
    font-size: 1.2rem;
    opacity: 0.7;
    transition: all 0.3s ease;
    pointer-events: none;
}

/* Input de búsqueda */
#evaluado_search {
    padding-right: 45px;  /* Espacio para el icono */
    background-color: #ffffff;
    transition: all 0.3s ease;
}

/* Efectos hover y focus */
#evaluado_search:hover + .search-icon {
    opacity: 1;
}

#evaluado_search:focus + .search-icon {
    opacity: 1;
    color: #b30000;
    transform: scale(1.1);
}

/* Animación suave para el icono */
@keyframes searchPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Aplicar animación cuando el input está activo */
#evaluado_search:focus + .search-icon {
    animation: searchPulse 1.5s ease-in-out infinite;
}

/* Estilo para el contenedor de resultados */
.evaluado-search-results {
    margin-top: 5px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(128, 0, 32, 0.1);
}

/* Estilo para loading state */
.search-loading {
    padding: 12px 16px;
    color: #666;
    font-style: italic;
    text-align: center;
    background: #f8f9fa;
    border-radius: 8px;
}
    </style>
@endsection

@section('content')
    <main class="profile-page">
        <section class="page-background" style="background: transparent">
            <div class="container">
                <div class="text-left mb-4">
                    <a href="{{ route('carpetas.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                </div>
                <div class="text-center mb-4">
                    <h3 class="card-title">Crear Nueva Carpeta</h3>
                </div>

                <!-- Formulario -->
                <form action="{{ route('carpetas.store') }}" method="POST" enctype="multipart/form-data" id="carpetaForm">
                    @csrf

                    <input type="hidden" name="documentos" id="documentos-input">

                  
                    <div class="form-group mb-4">
                        <label class="form-label" for="evaluado_search">Buscar Evaluado</label>
                        <div class="evaluado-select-container">
                            <div class="search-input-group">
                                <input type="text" id="evaluado_search" class="form-control"
                                    placeholder="Comience escribiendo el primer nombre..." autocomplete="off">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                            <div id="evaluado-search-results" class="evaluado-search-results"></div>
                            <input type="hidden" name="id_evaluado" id="id_evaluado" required>
                        </div>
                        <div id="search-help" class="text-sm text-gray-600 mt-2">
                            Escriba el nombre del evaluado. Puede continuar escribiendo más detalles para refinar la búsqueda.
                        </div>
                    </div>


                    <!-- Información del Evaluado -->
                    <div id="evaluado-info" class="mb-4">
                        <!-- Los datos se cargarán aquí mediante JavaScript -->
                    </div>

                    <!-- Selección de Caja -->
                    <!-- Selección de Caja -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="id_caja">Caja</label>
                        <select name="id_caja" id="id_caja" class="form-control" required>
                            <option value="">Seleccione una caja</option>
                            @foreach ($cajas as $caja)
                                <option value="{{ $caja->id }}">
                                    Caja #{{ $caja->numero_caja }} - {{ $caja->mes }} {{ $caja->anio }}
                                </option>
                            @endforeach
                        </select>
                        <div class="caja-info" id="caja-info"></div>
                    </div>

                    <div class="toggle-documents-section text-center mb-4">
                        <button type="button" id="toggleDocumentsBtn" class="toggle-documents-btn"
                            onclick="toggleDocumentSections()" style="display: none;">
                            <i class="fas fa-file-medical"></i>
                            <span>Agregar Documentos</span>
                        </button>
                    </div>

                    <button type="submit" class="btn-submit" onclick="enviarCarrito()">Crear Carpeta</button>
                </form>

                <!-- Mensajes de éxito o error -->
                @if (session('success'))
                    <div class="alert-success">
                        <strong>¡Éxito!</strong> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-error">
                        <strong>¡Error!</strong> Por favor, revisa los siguientes campos:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let searchTimeout;
        const searchInput = $('#evaluado_search');
        const searchResults = $('#evaluado-search-results');
        const evaluadoIdInput = $('#id_evaluado');
        const searchHelp = $('#search-help');
        const cajaSelect = $('#id_caja');

        searchInput.on('input', function() {
            const searchText = $(this).val().trim();

            clearTimeout(searchTimeout);

            if (searchText.length < 2) {
                searchResults.hide().empty();
                searchHelp.text(
                    'Escriba el nombre del evaluado. Puede continuar escribiendo más detalles para refinar la búsqueda.'
                );
                return;
            }

            searchTimeout = setTimeout(() => {
                searchResults.html('<div class="search-loading">Buscando...</div>').show();

                $.get('{{ route('evaluados.search') }}', {
                        term: searchText
                    })
                    .done(function(data) {
                        if (data.length === 0) {
                            searchResults.html(
                                '<div class="evaluado-search-item">No se encontraron resultados</div>'
                            );
                            searchHelp.text(
                                'Intente con un nombre diferente o verifique la ortografía.'
                            );
                            return;
                        }

                        const searchTerms = searchText.toLowerCase().split(' ');

                        const resultsHtml = data.map(evaluado => {
                            let highlightedName = evaluado.nombre_completo;

                            searchTerms.forEach(term => {
                                if (term.length > 1) {
                                    const regex = new RegExp(`(${term})`,
                                        'gi');
                                    highlightedName = highlightedName
                                        .replace(regex,
                                            '<span class="highlight">$1</span>'
                                        );
                                }
                            });

                            return `
                        <div class="evaluado-search-item ${evaluado.tiene_carpeta ? 'disabled' : ''}" 
                             data-id="${evaluado.id}" 
                             data-nombre="${evaluado.nombre_completo}">
                            <div class="item-name">${highlightedName}</div>
                            <div class="item-details">
                                <span>CURP: ${evaluado.curp}</span>
                            </div>
                            ${evaluado.tiene_carpeta ? 
                                '<div class="item-warning">Ya tiene carpeta asignada</div>' : 
                                ''}
                        </div>
                    `;
                        }).join('');

                        searchResults.html(resultsHtml);
                        searchHelp.text(
                            `Se encontraron ${data.length} resultado(s). Puede seguir escribiendo para refinar la búsqueda.`
                        );
                    })
                    .fail(function() {
                        searchResults.html(
                            '<div class="evaluado-search-item">Error al buscar evaluados</div>'
                        );
                        searchHelp.text(
                            'Ocurrió un error al buscar. Por favor, intente nuevamente.'
                        );
                    });
            }, 300);
        });

        $(document).on('click', '.evaluado-search-item:not(.disabled)', function() {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            
            evaluadoIdInput.val(id);
            searchInput.val(nombre);
            searchResults.hide();
            
            // Cargar datos del evaluado y filtrar cajas
            fetch(`/evaluados/${id}/datos`)
                .then(response => response.json())
                .then(data => {
                    const infoDiv = document.getElementById('evaluado-info');
        const nombreCompleto = `${data.primer_nombre} ${data.segundo_nombre} ${data.primer_apellido} ${data.segundo_apellido}`.trim();
        const iniciales = `${data.primer_nombre.charAt(0)}${data.primer_apellido.charAt(0)}`;
        const fechaApertura = new Date(data.fecha_apertura);
        const mesApertura = fechaApertura.toLocaleDateString('es-ES', { month: 'long' }).toLowerCase();
        const anioApertura = fechaApertura.getFullYear();

                    
                    // Mostrar información del evaluado
                    infoDiv.innerHTML = `
                        <p><strong>Nombre:</strong> ${data.primer_nombre} ${data.segundo_nombre} ${data.primer_apellido} ${data.segundo_apellido}</p>
                        <p><strong>Fecha de Apertura:</strong> ${fechaApertura.toLocaleDateString('es-ES', {
                            year: 'numeric', month: 'long', day: 'numeric'
                        })}</p>
                    `;

                    // Obtener las cajas disponibles para el mes y año
                    $.get(`/cajas-disponibles/${id}`, {
                        mes: mesApertura,
                        anio: anioApertura
                    })
                    .done(function(cajas) {
                        // Limpiar el select de cajas
                        cajaSelect.empty();
                        cajaSelect.append('<option value="">Seleccione una caja</option>');
                        
                        // Agregar las cajas filtradas
                        if (cajas.length > 0) {
                            cajas.forEach(caja => {
                                cajaSelect.append(`
                                    <option value="${caja.id}">
                                        Caja #${caja.numero_caja} - ${caja.mes} ${caja.anio}
                                    </option>
                                `);
                            });
                            $('#caja-info').html('');
                        } else {
                            $('#caja-info').html(`
                                <div class="text-warning mt-2">
                                    No hay cajas disponibles para ${mesApertura} ${anioApertura}
                                </div>
                            `);
                        }
                    })
                    .fail(function() {
                        $('#caja-info').html(`
                            <div class="text-warning mt-2">
                                Error al cargar las cajas disponibles
                            </div>
                        `);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los datos del evaluado:', error);
                    document.getElementById('evaluado-info').innerHTML = 'Error al cargar los datos del evaluado.';
                });
        });

        // Cerrar resultados al hacer clic fuera
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.evaluado-select-container').length) {
                searchResults.hide();
            }
        });
    });

    
    const form = $('#carpetaForm');
    
    // Manejar el envío del formulario
    // Modificar el manejador del formulario
$('#carpetaForm').on('submit', function(e) {
    e.preventDefault();

    // Verificar campos requeridos
    if (!$('#id_evaluado').val()) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, seleccione un evaluado',
            icon: 'error',
            confirmButtonColor: '#800020'
        });
        return false;
    }

    if (!$('#id_caja').val()) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, seleccione una caja',
            icon: 'error',
            confirmButtonColor: '#800020'
        });
        return false;
    }

    // Mostrar loading
    Swal.fire({
        title: 'Procesando',
        text: 'Creando la carpeta...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Preparar los datos
    const formData = new FormData(this);
    
    // Agregar token CSRF
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    // Enviar petición AJAX
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: '¡Éxito!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#800020'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/carpetas/${response.id}`;
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.message || 'Ocurrió un error al crear la carpeta',
                    icon: 'error',
                    confirmButtonColor: '#800020'
                });
            }
        },
        error: function(xhr) {
            let errorMessage = 'Ocurrió un error al crear la carpeta';
            
            if (xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                } else if (xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
            }
            
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                confirmButtonColor: '#800020'
            });
        }
    });
});
</script>
@endsection
