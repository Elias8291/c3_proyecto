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

                <!-- Selección de Evaluado -->
                <div class="form-group mb-4">
                    <label class="form-label" for="id_evaluado">Seleccionar Evaluado</label>
                    <select name="id_evaluado" id="id_evaluado" class="form-control" required>
                        <option value="">Seleccione un evaluado</option>
                        @foreach($evaluados as $evaluado)
                            <option value="{{ $evaluado->id }}">
                                {{ $evaluado->primer_nombre }} {{ $evaluado->segundo_nombre }} {{ $evaluado->primer_apellido }} {{ $evaluado->segundo_apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Información del Evaluado -->
                <div id="evaluado-info" class="mb-4">
                    <!-- Los datos se cargarán aquí mediante JavaScript -->
                </div>

                <!-- Selección de Caja -->
                <div class="form-group mb-4">
                    <label class="form-label" for="id_caja">Caja</label>
                    <select name="id_caja" id="id_caja" class="form-control" required>
                        <option value="">Seleccione un evaluado primero</option>
                    </select>
                    <div class="caja-info" id="caja-info"></div>
                </div>

                <!-- Agregar Documentos -->
                <div class="form-group mb-4">
                    <h4>Agregar Documento</h4>
                    <div class="form-row">
                        <!-- Número de Hojas -->
                        <div class="form-group mb-2">
                            <input type="text" name="numero_hojas" placeholder="Número de Hojas"
                                class="form-control" id="numero_hojas">
                        </div>

                        <!-- Motivo de Evaluación -->
                        <div class="form-group mb-2">
                            <input type="text" name="motivo_evaluacion" placeholder="Motivo de Evaluación"
                                class="form-control" id="motivo_evaluacion">
                        </div>

                        <!-- Selección de Área -->
                        <div class="form-group mb-2">
                            <select name="area" id="area" class="form-control">
                                <option value="">Selecciona un área</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->nombre }}">{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado (Prestado / No Prestado) -->
                        <div class="form-group mb-2">
                            <select name="estado" id="estado" class="form-control">
                                <option value="Prestado">Prestado</option>
                                <option value="No Prestado">No Prestado</option>
                            </select>
                        </div>

                        <!-- Fecha de Creación -->
                        <div class="form-group mb-2">
                            <input type="date" name="fecha_creacion" class="form-control" id="fecha_creacion">
                        </div>

                        <!-- Botón Añadir Documento -->
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" onclick="agregarDocumento()">Añadir Documento</button>
                        </div>
                    </div>
                </div>

                <!-- Lista de Documentos en el Carrito -->
                <div class="form-group mb-4">
                    <h5>Documentos para agregar</h5>
                    <ul id="carritoDocumentos" class="list-group"></ul>
                </div>

                <!-- Botón de Crear Carpeta -->
                <button type="submit" class="btn-submit">Crear Carpeta</button>
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
    // Variables globales
    let documentosCarrito = [];

    // Función para agregar documentos al carrito
    function agregarDocumento() {
        const numeroHojas = document.getElementById('numero_hojas').value;
        const motivoEvaluacion = document.getElementById('motivo_evaluacion').value;
        const area = document.getElementById('area').value;
        const estado = document.getElementById('estado').value;
        const fechaCreacion = document.getElementById('fecha_creacion').value;

        // Validar campos
        if (!numeroHojas || !motivoEvaluacion || !area || !estado || !fechaCreacion) {
            alert("Por favor completa todos los campos del documento.");
            return;
        }

        // Agregar documento al carrito
        const documento = { numeroHojas, motivoEvaluacion, area, estado, fechaCreacion };
        documentosCarrito.push(documento);

        // Limpiar campos
        document.getElementById('numero_hojas').value = '';
        document.getElementById('motivo_evaluacion').value = '';
        document.getElementById('area').value = '';
        document.getElementById('estado').value = '';
        document.getElementById('fecha_creacion').value = '';

        mostrarCarrito();
    }

    // Función para mostrar el carrito de documentos
    function mostrarCarrito() {
        const carritoDocumentos = document.getElementById('carritoDocumentos');
        carritoDocumentos.innerHTML = '';

        documentosCarrito.forEach((doc, index) => {
            const listItem = document.createElement('li');
            listItem.classList.add('list-group-item');
            listItem.innerHTML = `
                <div>
                    <strong>${doc.numeroHojas} Hojas</strong> - ${doc.motivoEvaluacion} (${doc.estado})
                </div>
                <button onclick="eliminarDocumento(${index})" class="btn btn-danger btn-sm">Eliminar</button>
            `;
            carritoDocumentos.appendChild(listItem);
        });
    }

    // Función para eliminar un documento del carrito
    function eliminarDocumento(index) {
        documentosCarrito.splice(index, 1);
        mostrarCarrito();
    }

    // Agregar documentos al formulario antes de enviar
    document.querySelector('form').addEventListener('submit', function(e) {
        // Agregar documentos al formulario
        documentosCarrito.forEach((doc, index) => {
            for (const [key, value] of Object.entries(doc)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `documentos[${index}][${key}]`;
                input.value = value;
                this.appendChild(input);
            }
        });
    });

    // Manejar el cambio de seleccion de evaluado
    document.getElementById('id_evaluado').addEventListener('change', function() {
        var evaluadoId = this.value;
        if (evaluadoId) {
            // Mostrar un indicador de carga si lo deseas
            var infoDiv = document.getElementById('evaluado-info');
            infoDiv.innerHTML = 'Cargando datos del evaluado...';

            // Hacer la solicitud AJAX para obtener los datos del evaluado
            fetch('/evaluados/' + evaluadoId + '/datos')
                .then(response => response.json())
                .then(data => {
                    // Formatear la fecha
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var fechaApertura = new Date(data.fecha_apertura).toLocaleDateString('es-ES', options);

                    // Actualizar el div con los datos
                    infoDiv.innerHTML = `
                        <p><strong>Nombre:</strong> ${data.primer_nombre} ${data.segundo_nombre} ${data.primer_apellido} ${data.segundo_apellido}</p>
                        <p><strong>Fecha de Inicio Evaluaciones:</strong> ${fechaApertura}</p>
                    `;

                    // Obtener las cajas disponibles para este evaluado
                    fetch('/cajas/disponibles/' + evaluadoId)
                        .then(response => response.json())
                        .then(cajas => {
                            var selectCaja = document.getElementById('id_caja');
                            selectCaja.innerHTML = '<option value="">Selecciona una caja</option>';

                            if (cajas.length > 0) {
                                cajas.forEach(caja => {
                                    var option = document.createElement('option');
                                    option.value = caja.id;
                                    option.text = `Caja #${caja.numero_caja} - ${caja.mes} ${caja.anio}`;
                                    selectCaja.add(option);
                                });
                                document.getElementById('caja-info').innerText = `Mostrando cajas para: ${data.mes_apertura} ${data.anio_apertura}`;
                            } else {
                                selectCaja.innerHTML = '<option value="">No hay cajas disponibles</option>';
                                document.getElementById('caja-info').innerText = `No hay cajas disponibles para: ${data.mes_apertura} ${data.anio_apertura}`;
                            }
                        });
                })
                .catch(error => {
                    console.error('Error al obtener los datos del evaluado:', error);
                    infoDiv.innerHTML = 'Error al cargar los datos del evaluado.';
                });
        } else {
            // Limpiar los campos si no hay evaluado seleccionado
            document.getElementById('evaluado-info').innerHTML = '';
            document.getElementById('id_caja').innerHTML = '<option value="">Seleccione un evaluado primero</option>';
            document.getElementById('caja-info').innerHTML = '';
        }
    });
</script>
@endsection
