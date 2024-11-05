@extends('layouts.app')

@section('title', 'Editar Carpeta')

@section('css')
<style>
    /* Estilos aplicados para el formulario de edición */
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
        color: #6c757d; /* Gris claro */
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


</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background">
        <div class="container">
            <div class="text-left mb-4">
                <a href="{{ route('carpetas.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="card-title">Editar Carpeta #{{ $carpeta->id }}</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('carpetas.update', $carpeta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label class="form-label" for="id_evaluado">Evaluado</label>
                    <p id="evaluado-info" class="form-control-static">
                        {{ $carpeta->evaluado->primer_nombre }} {{ $carpeta->evaluado->segundo_nombre ?? '' }} {{ $carpeta->evaluado->primer_apellido }} {{ $carpeta->evaluado->segundo_apellido ?? '' }}
                    </p>
                    <input type="hidden" name="id_evaluado" value="{{ $carpeta->id_evaluado }}">
                </div>

                <div class="form-group mb-4">
                    <label class="form-label" for="id_caja">Caja</label>
                    <select name="id_caja" id="id_caja" class="form-control" required>
                        <option value="">Seleccione una caja</option>
                        @foreach($cajas as $caja)
                        <option value="{{ $caja->id }}"
                            {{ $caja->id == $carpeta->id_caja ? 'selected' : '' }}>
                            Caja #{{ $caja->numero_caja }} - {{ $caja->mes }} {{ $caja->anio }}
                        </option>
                        @endforeach
                    </select>
                    <div class="caja-info" id="caja-info"></div>
                </div>

                <!-- Botón de Guardar Cambios -->
                <button type="submit" class="btn-submit">Guardar Cambios</button>
            </form>

            <!-- Mensajes de éxito o error -->
            @if(session('success'))
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
document.addEventListener('DOMContentLoaded', function() {
    var evaluadoId = "{{ $carpeta->id_evaluado }}";
    var cajaSelect = document.getElementById('id_caja');

    if (evaluadoId) {
        fetch(`/evaluados/${evaluadoId}/datos`)
            .then(response => response.json())
            .then(data => {
                var fechaApertura = new Date(data.fecha_apertura);
                var mesApertura = fechaApertura.toLocaleDateString('es-ES', { month: 'long' }).toLowerCase();
                var anioApertura = fechaApertura.getFullYear();

                // Filtrar y mostrar solo las cajas del mes y año del evaluado
                Array.from(cajaSelect.options).forEach(option => {
                    if (option.value) {
                        var [cajaMes, cajaAnio] = option.text.match(/\w+/g).slice(-2);
                        cajaMes = cajaMes.toLowerCase();

                        option.style.display = (cajaMes === mesApertura && parseInt(cajaAnio) === anioApertura) ? '' : 'none';
                    }
                });
            })
            .catch(error => {
                console.error('Error al obtener los datos del evaluado:', error);
                document.getElementById('evaluado-info').innerText = 'Error al cargar los datos del evaluado.';
            });
    }
});
</script>
@endsection
