@extends('layouts.app')

<style>
    .periodos h5 {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #periodo-select {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    #periodo-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
    }

    .card-body {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .section-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        border-radius: 8px 8px 0 0;
    }

    .section-header h3 {
        margin: 0;
    }

    .grupo {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        background: linear-gradient(135deg, #f0f8ff, #e6e6fa);
        display: flex;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        flex: 1 0 calc(33.333% - 20px);
        margin: 10px;
    }

    .grupo:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .grupo-icon {
        font-size: 3rem;
        margin-right: 20px;
        color: #007bff;
        transition: color 0.3s;
    }

    .grupo h5 {
        margin: 0 0 10px 0;
        font-size: 1.3rem;
        color: #333;
        position: relative;
    }

    .grupo h5::after {
        content: " • ";
        font-weight: normal;
        color: #888;
    }

    .grupo p {
        margin: 5px 0;
        color: #666;
    }

    .grupo-details {
        flex-grow: 1;
    }

    .grupo-materia {
        font-size: 1rem;
        color: #555;
    }

    .grupo-footer {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .grupo-footer span {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .grupo-footer .inscripciones {
        background-color: #e6f7ff;
        color: #007bff;
    }

    .grupo-footer .horario {
        background-color: #f0f0f0;
        color: #555;
    }

    .grupo-footer .estado {
        font-size: 0.9rem;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        background-color: #28a745;
    }

    .grupo-footer .estado.inactivo {
        background-color: #dc3545;
    }

    .grupo-footer .btn {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-inscribir {
        background-color: #28a745;
        color: white;
    }

    .btn-inscribir:hover {
        background-color: #218838;
    }

    .btn-ver-alumnos {
        background-color: #007bff;
        color: white;
    }

    .btn-ver-alumnos:hover {
        background-color: #0056b3;
    }

    .grupo {
        margin-bottom: 20px;
        opacity: 0;
        transform: translateY(20px);
        animation: slideIn 0.5s ease-out forwards;
    }

    @keyframes slideIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .grupo:hover {
        background: linear-gradient(135deg, #e6f7ff, #e0e6fa);
    }

    .grupo:hover .grupo-icon {
        color: #0056b3;
    }

    .grupo-row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin: -10px;
    }

    .grupo-row .grupo {
        flex: 1 0 calc(33.333% - 20px);
        margin: 10px;
    }
</style>

@section('content')
<script>
    // Definir la variable en el contexto de JavaScript
    const tienePermisoCrearInscripcion = @json(auth()->user()->can('crear-inscripcion'));
    const tienePermisoVerEstudiantesInscritos = @json(auth()->user()->can('ver-estudiantes-inscritos'));
</script>

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Inscripciones</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Opcionalmente, puedes agregar botones u otros elementos aquí -->
                        </div>
                        <div class="periodos">
                            <h5>Seleccionar Periodo:</h5>
                            <select id="periodo-select" onchange="fetchGroups()">
                                <option value="">Seleccione un periodo</option>
                                @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grupos mt-3" id="grupos-container">
                            <!-- Los grupos se cargarán aquí dinámicamente -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function fetchGroups() {
        const periodoId = document.getElementById('periodo-select').value;
        if (periodoId) {
            fetch(`/periodos/${periodoId}/grupos`)
                .then(response => response.json())
                .then(data => {
                    const gruposContainer = document.getElementById('grupos-container');
                    gruposContainer.innerHTML = ''; // Limpiar contenido previo

                    let grupoRow = document.createElement('div');
                    grupoRow.className = 'grupo-row';
                    gruposContainer.appendChild(grupoRow);

                    data.grupos.forEach((grupo, index) => {
                        if (index > 0 && index % 3 === 0) {
                            grupoRow = document.createElement('div');
                            grupoRow.className = 'grupo-row';
                            gruposContainer.appendChild(grupoRow);
                        }

                        const estadoClass = grupo.activo ? 'activo' : 'inactivo';
                        const estadoText = grupo.activo ? 'Activo' : 'Inactivo';
                        const inscribirButton = grupo.activo && tienePermisoCrearInscripcion ? `<a href="/inscripciones/create?grupo_id=${grupo.id}" class="btn btn-inscribir">Inscribir</a>` : '';
                        const verAlumnosButton = tienePermisoVerEstudiantesInscritos ? `<a href="/grupos/${grupo.id}/alumnos" class="btn btn-ver-alumnos">Ver Alumnos</a>` : '';
                        const grupoElement = document.createElement('div');
                        grupoElement.className = 'grupo';
                        grupoElement.innerHTML = `
                            <i class="fas fa-book-open grupo-icon"></i>
                            <div class="grupo-details">
                                <h5>${grupo.nombre} (${grupo.clave})</h5>
                                <p class="grupo-materia"><strong>Materia:</strong> ${grupo.materia.nombre}</p>
                                <p><strong>Horario:</strong> ${grupo.horario.hora_in} - ${grupo.horario.hora_fn}</p>
                                <p><strong>Rango de Alumnos:</strong> ${grupo.rango_alumno.min_alumnos} - ${grupo.rango_alumno.max_alumnos}</p>
                                <div class="grupo-footer">
                                    <span class="inscripciones"><strong>Inscripciones Totales:</strong> ${grupo.inscripciones_totales}</span>
                                    <span class="horario">${grupo.horario.hora_in} - ${grupo.horario.hora_fn}</span>
                                    <span class="estado ${estadoClass}">${estadoText}</span>
                                    ${inscribirButton}
                                    ${verAlumnosButton}
                                </div>
                            </div>
                        `;
                        grupoRow.appendChild(grupoElement);
                    });
                });
        }
    }
</script>
@endsection
