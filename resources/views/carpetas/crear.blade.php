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
                <h3 class="card-title">Crear Nueva Carpeta</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('carpetas.store') }}" method="POST">
                @csrf

                <input type="hidden" name="documentos" id="documentos-input">

                <div class="form-group mb-4">
                    <label class="form-label" for="id_evaluado">Seleccionar Evaluado</label>
                    <select name="id_evaluado" id="id_evaluado" class="form-control" required>
                        <option value="">Seleccione un evaluado</option>
                        @foreach($evaluados as $evaluado)
                        <option value="{{ $evaluado->id }}" @if($evaluado->carpetas->isNotEmpty())
                            disabled
                            class="disabled-option"
                            @endif>
                            {{ $evaluado->primer_nombre }} {{ $evaluado->segundo_nombre }} {{ $evaluado->primer_apellido
                            }} {{ $evaluado->segundo_apellido }}
                            @if($evaluado->carpetas->isNotEmpty())
                            (Ya tiene carpeta)
                            @endif
                        </option>
                        @endforeach
                    </select>
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
                        @foreach($cajas as $caja)
                        <option value="{{ $caja->id }}">
                            Caja #{{ $caja->numero_caja }} - {{ $caja->mes }} {{ $caja->anio }}
                        </option>
                        @endforeach
                    </select>
                    <div class="caja-info" id="caja-info"></div>
                </div>

                <div class="toggle-documents-section text-center mb-4">
                    <button type="button" id="toggleDocumentsBtn" class="toggle-documents-btn" onclick="toggleDocumentSections()" style="display: none;">
                        <i class="fas fa-file-medical"></i>
                        <span>Agregar Documentos</span>
                    </button>
                </div>
                
                <div id="documentSections" style="display: none;">
                    <div class="document-section">
                        <h4><i class="fas fa-file-alt"></i> Agregar Documento</h4>
                        <div class="document-form-grid">
                            <div class="document-form-group">
                                <label for="numero_hojas">Número de Hojas</label>
                                <input type="number" id="numero_hojas" name="numero_hojas" placeholder="Ej: 10" min="1">
                            </div>

                            <div class="document-form-group">
                                <label for="area">Área</label>
                                <select id="area" name="area">
                                    <option value="">Seleccione un área</option>
                                    @foreach($evaluacionAreas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="document-form-group">
                                <label for="estado">Estado</label>
                                <select id="estado" name="estado" disabled>
                                    <option value="Disponible" selected>Disponible</option>
                                </select>
                                <input type="hidden" name="estado" value="Disponible">
                            </div>

                            <div class="document-form-group">
                                <label for="fecha_creacion">Fecha de Creación</label>
                                <input type="date" id="fecha_creacion" name="fecha_creacion">
                            </div>
                        </div>

                        <button type="button" class="add-document-btn" onclick="agregarDocumento()">
                            <i class="fas fa-plus"></i> Añadir Documento
                        </button>

                        <p id="mensaje-error" class="text-warning" style="display: none;"></p>
                    </div>

                    <div class="document-cart">
                        <h5><i class="fas fa-shopping-cart"></i> Documentos para agregar</h5>
                        <div id="carritoDocumentos" class="cart-items">
                            <div class="cart-empty">
                                <i class="fas fa-folder-open"></i>
                                <p>No hay documentos agregados</p>
                            </div>
                        </div>
                    </div>
                </div>





                <!-- Botón de Crear Carpeta -->
                <button type="submit" class="btn-submit" onclick="enviarCarrito()">Crear Carpeta</button>
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
    let documentos = [];

function enviarCarrito() {
    // Convertir el carrito de documentos a JSON solo si tiene documentos
    if (documentos.length > 0) {
        document.getElementById('documentos-input').value = JSON.stringify(documentos);
    } else {
        document.getElementById('documentos-input').value = ''; // Dejar vacío si no hay documentos
    }
}


function agregarDocumento() {
    const numeroHojas = document.getElementById('numero_hojas').value;
    const area = document.getElementById('area');
    const estado = document.getElementById('estado').value;
    const fechaCreacion = document.getElementById('fecha_creacion').value;
    const mensajeError = document.getElementById('mensaje-error');

    if (!numeroHojas || !area.value || !fechaCreacion) {
        mensajeError.textContent = 'Por favor, completa todos los campos.';
        mensajeError.style.display = 'block';
        return;
    }

    // Verificar si ya existe un documento con la misma área (por id)
    const existeDocumento = documentos.some(doc => doc.area === area.value);

    if (existeDocumento) {
        mensajeError.textContent = 'Ya has agregado un documento para esta área.';
        mensajeError.style.display = 'block';
        return;
    }

    // Ocultar el mensaje de error si se agrega un documento nuevo
    mensajeError.style.display = 'none';

    const documento = {
        numeroHojas,
        area: area.value, // id_area
        areaTexto: area.options[area.selectedIndex].text, // Texto del área
        estado,
        fechaCreacion
    };

    documentos.push(documento);
    actualizarCarrito();
    limpiarFormulario();
}



function actualizarCarrito() {
    const carrito = document.getElementById('carritoDocumentos');
    
    if (documentos.length === 0) {
        carrito.innerHTML = `
            <div class="cart-empty">
                <i class="fas fa-folder-open"></i>
                <p>No hay documentos agregados</p>
            </div>
        `;
        return;
    }

    carrito.innerHTML = documentos.map((doc, index) => `
        <div class="cart-item">
            <div class="cart-item-info">
                <div class="cart-item-title">${doc.areaTexto}</div> <!-- Usa areaTexto aquí -->
                <div class="cart-item-details">
                    ${doc.numeroHojas} hojas | ${doc.areaTexto} | ${doc.estado} | ${doc.fechaCreacion} <!-- Usa areaTexto aquí también -->
                </div>
            </div>
            <button class="remove-item-btn" onclick="eliminarDocumento(${index})">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    `).join('');
}


function eliminarDocumento(index) {
    documentos.splice(index, 1);
    actualizarCarrito();
}

function limpiarFormulario() {
    document.getElementById('numero_hojas').value = '';
    document.getElementById('area').selectedIndex = 0;
    document.getElementById('estado').selectedIndex = 0;
    document.getElementById('fecha_creacion').value = '';
}
document.getElementById('id_evaluado').addEventListener('change', function() {
    var evaluadoId = this.value;
    var infoDiv = document.getElementById('evaluado-info');
    var cajaSelect = document.getElementById('id_caja');
    
    if (evaluadoId) {
        fetch('/evaluados/' + evaluadoId + '/datos')
            .then(response => response.json())
            .then(data => {
                // Obtener la inicial del primer apellido
                var inicialPrimerApellido = data.primer_apellido ? data.primer_apellido.charAt(0).toUpperCase() + '.' : 'No disponible';

                // Formatear la fecha de apertura
                var fechaApertura = new Date(data.fecha_apertura);
                var mesApertura = fechaApertura.toLocaleDateString('es-ES', { month: 'long' }).toLowerCase();
                var anioApertura = fechaApertura.getFullYear();

                // Mostrar información del evaluado incluyendo la fecha de apertura y la inicial
                infoDiv.innerHTML = `
                    <p><strong>Nombre:</strong> ${data.primer_nombre} ${data.segundo_nombre} ${data.primer_apellido} ${data.segundo_apellido}</p>
                    <p><strong>Fecha de Apertura:</strong> ${fechaApertura.toLocaleDateString('es-ES', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    }).toLowerCase()}</p>
                    <p><strong>Inicial del Primer Apellido:</strong> ${inicialPrimerApellido}</p>
                `;

                // Filtrar y mostrar las cajas que coincidan con el mes y año de apertura
                Array.from(cajaSelect.options).forEach(option => {
                    if (option.value) { // Ignorar el primer "Seleccione una caja"
                        var [cajaMes, cajaAnio] = option.text.match(/\w+/g).slice(-2); // Extrae mes y año del texto
                        cajaMes = cajaMes.toLowerCase(); // Convertir el mes de la caja a minúsculas

                        if (cajaMes === mesApertura && parseInt(cajaAnio) === anioApertura) {
                            option.style.display = ''; // Mostrar opción
                        } else {
                            option.style.display = 'none'; // Ocultar opción
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error al obtener los datos del evaluado:', error);
                infoDiv.innerHTML = 'Error al cargar los datos del evaluado.';
            });
    } else {
        infoDiv.innerHTML = '';
        Array.from(cajaSelect.options).forEach(option => {
            option.style.display = '';
        });
    }
});

function toggleDocumentSections() {
    const sections = document.getElementById('documentSections');
    const button = document.getElementById('toggleDocumentsBtn');
    
    if (sections.style.display === 'none') {
        sections.style.display = 'block';
        button.classList.add('active');
        button.querySelector('span').textContent = 'Ocultar Documentos';
    } else {
        sections.style.display = 'none';
        button.classList.remove('active');
        button.querySelector('span').textContent = 'Agregar Documentos';
    }
}
document.getElementById('id_caja').addEventListener('change', function() {
    const toggleDocumentsBtn = document.getElementById('toggleDocumentsBtn');
    if (this.value) {
        // Si se seleccionó una caja, muestra el botón
        toggleDocumentsBtn.style.display = 'inline-block';
    } else {
        // Si no hay ninguna caja seleccionada, oculta el botón
        toggleDocumentsBtn.style.display = 'none';
    }
});


</script>
@endsection