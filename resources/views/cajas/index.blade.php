@extends('layouts.app')

<style>
:root {
    --header-color: #9B2847;
    --primary-color: #8B1F41;
    --primary-dark: #4A0404;
    --primary-light: #D4A5A5;
    --background-light: #FAF6F6;
    --gray-100: #F8F9FA;
    --gray-200: #E9ECEF;
    --gray-300: #DEE2E6;
    --gray-400: #CED4DA;
    --gray-500: #ADB5BD;
    --gray-600: #6C757D;
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px rgba(139, 31, 65, 0.1);
}

.main-container {
    background: linear-gradient(135deg, var(--background-light) 0%, #FFFFFF 100%);
    min-height: 100vh;
    padding: 3rem;
    position: relative;
}

.section-header {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--gray-200);
}



.search-container {
    position: relative;
    width: 400px;
}

.search-input {
    width: 100%;
    padding: 1rem 1.5rem 1rem 3rem;
    border-radius: 15px;
    border: 2px solid var(--gray-200);
    background-color: var(--gray-100);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color);
    background-color: white;
    box-shadow: 0 0 0 4px rgba(139, 31, 65, 0.1);
}

.folder-item {
    background: white;
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.25rem;
    border: 1px solid var(--gray-200);
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.folder-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: linear-gradient(to bottom, var(--primary-color), var(--primary-light));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.folder-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

.folder-item:hover::before {
    opacity: 1;
}

.folder-icon {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 1.25rem;
    border-radius: 15px;
    font-size: 1.75rem;
    box-shadow: var(--shadow-sm);
}

.folder-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 0.75rem;
}

.folder-info {
    gap: 2.5rem;
}

.info-group {
    padding: 0.5rem 0;
}

.info-group i {
    color: var(--primary-color);
    font-size: 1.1rem;
}

.btn-action {
    padding: 0.75rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.btn-action i {
    font-size: 1.2rem;
}

.btn-action:hover {
    background: var(--gray-100);
    transform: translateY(-2px);
}

.new-folder-btn {
    width: 4.5rem;
    height: 4.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    box-shadow: 0 4px 15px rgba(139, 31, 65, 0.3);
    font-size: 1.75rem;
}

.new-folder-btn:hover {
    transform: translateY(-4px) rotate(90deg);
    box-shadow: 0 6px 20px rgba(139, 31, 65, 0.4);
}

/

@media (max-width: 768px) {
    .main-container {
        padding: 1.5rem;
    }

    .section-header {
        padding: 1.5rem;
    }

    .search-container {
        width: 100%;
    }

    .folder-info {
        gap: 1.5rem;
    }
}

:root {
    --primary-color: #8B1F41;
    /* Guinda/Burdeos principal */
    --secondary-color: #4A0404;
    /* Guinda oscuro */
    --accent-color: #D4A5A5;
    /* Rosa suave complementario */
    --background-color: #FAF6F6;
    /* Fondo claro con un toque cálido */
    --border-color: #E9E2E2;
    /* Borde suave */
    --hover-color: #F8E6E6;
    /* Color hover suave */
    --text-primary: #2D2424;
    /* Texto principal */
    --text-secondary: #6B5656;
    /* Texto secundario */
}


.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1.5rem 2rem 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid var(--accent-color);
}

.page__heading {
    color: var(--primary-color);
    font-size: 1.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.search-container {
    position: relative;
    width: 320px;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.75rem;
    border-radius: 12px;
    border: 2px solid var(--border-color);
    background-color: white;
    font-size: 0.925rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(139, 31, 65, 0.1);
    outline: none;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
}

.folder-item {
    background: linear-gradient(135deg, #fffdfd, #fae6e6);
    border-radius: 20px;
    padding: 1.5rem;
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    border: 1px solid transparent;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 4px 12px rgba(139, 31, 65, 0.1);
    position: relative;
    overflow: hidden;
}

.folder-item:hover {
    transform: translateY(-5px);
    background: linear-gradient(135deg, #ffffff, #fcdede);
    box-shadow: 0 8px 20px rgba(139, 31, 65, 0.2);
    border: 2px solid #d4a5a5;
}

.folder-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 8px;
    height: 100%;
    background: linear-gradient(to bottom, #800020, #d4a5a5);
    border-radius: 10px;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.folder-item:hover::before {
    opacity: 1;
}

/* Asegúrate de que el selector sea más específico si es necesario */
div.folder-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px !important;  /* Asegúrate de forzar el tamaño con !important */
    height: 40px !important;  /* Asegúrate de forzar el tamaño con !important */
    border-radius: 50%;
    background: linear-gradient(135deg, #f0eced, #044a44);
    color: white;
    font-size: 1.5rem !important;  /* Asegúrate de forzar el tamaño de la fuente con !important */
    box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s ease;
}

.folder-icon:hover {
    transform: scale(1.2);
    background: linear-gradient(135deg, #4a0404, #800020);
}

.folder-details {
    display: grid;
    gap: 0.75rem;
}

.folder-title {
    font-weight: 700;
    color: #800020;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: color 0.4s ease;
}

.folder-title:hover {
    color: #4a0404;
}

.folder-info {
    display: flex;
    gap: 1.5rem;
    color: #6b5656;
    font-size: 0.95rem;
}

.info-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0;
}

.info-group i {
    color: #800020;
    font-size: 1rem;
}

.folder-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-action {
    padding: 0.75rem;
    border-radius: 50%;
    background: #f8e6e6;
    border: 2px solid transparent;
    color: #6b5656;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.btn-action:hover {
    background: #ffe6e6;
    border-color: #800020;
    color: #800020;
    transform: scale(1.2);
}
.folder-item {
    background: linear-gradient(135deg, #fffdfd, #fae6e6);
    border-radius: 20px;
    padding: 1.5rem;
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    border: 1px solid transparent;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 4px 12px rgba(139, 31, 65, 0.1);
    position: relative;
    overflow: hidden;
}

.folder-item:hover {
    transform: translateY(-5px);
    background: linear-gradient(135deg, #ffffff, #fcdede);
    box-shadow: 0 8px 20px rgba(139, 31, 65, 0.2);
    border: 2px solid #d4a5a5;
}

.folder-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 8px;
    height: 100%;
    background: linear-gradient(to bottom, #800020, #d4a5a5);
    border-radius: 10px;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.folder-item:hover::before {
    opacity: 1;
}



.folder-icon:hover {
    transform: scale(1.2);
    background: linear-gradient(135deg, #4a0404, #800020);
}

.folder-details {
    display: grid;
    gap: 0.75rem;
}

.folder-title {
    font-weight: 700;
    color: #800020;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: color 0.4s ease;
}

.folder-title:hover {
    color: #4a0404;
}

.folder-info {
    display: flex;
    gap: 1.5rem;
    color: #6b5656;
    font-size: 0.95rem;
}

.info-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0;
}

.info-group i {
    color: #800020;
    font-size: 1rem;
}

.folder-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-action {
    padding: 0.75rem;
    border-radius: 50%;
    background: #f8e6e6;
    border: 2px solid transparent;
    color: #6b5656;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.btn-action:hover {
    background: #ffe6e6;
    border-color: #800020;
    color: #800020;
    transform: scale(1.2);
}


/* Estilo para el botón de "Ver" */
.btn-action i.fa-eye {
    color: #D4A5A5;
    /* Rosa suave complementario */
}

.btn-action i.fa-eye:hover {
    background: #F8E6E6;
    /* Hover suave */
    color: #8B1F41;
    /* Guinda */
}

/* Estilo para el botón de "Editar" */
.btn-action i.fa-edit {
    color: #8B1F41;
    /* Guinda */
}

.btn-action i.fa-edit:hover {
    background: #F8E6E6;
    /* Hover suave */
    color: #4A0404;
    /* Guinda oscuro */
}

/* Estilo para el botón de "Eliminar" */
.btn-action i.fa-trash {
    color: #4A0404;
    /* Guinda oscuro */
}

.btn-action i.fa-trash:hover {
    background: #D4A5A5;
    /* Rosa suave */
    color: #FAF6F6;
    /* Blanco claro */
}

.page__heading {
        color: var(--header-color);
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 2.5rem;
        position: relative;
        padding-bottom: 1rem;
        letter-spacing: -0.5px;
        text-shadow: 2px 2px 4px rgba(155, 40, 71, 0.1);
    }

    .page__heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 6px;
        background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
        border-radius: 3px;
        box-shadow: 0 2px 4px rgba(155, 40, 71, 0.2);
    }


.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    padding: 1rem 1.5rem;
    background: rgb(2, 2, 2);
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(25, 58, 116, 0.06);
    border: 1px solid var(--folder-border);
}

/* Opcional: añadir más figuras decorativas */
.figure-1 {
    position: absolute;
    width: 150px;
    height: 150px;
    top: 20%;
    left: 10%;
    background: rgba(139, 31, 65, 0.05);
    border-radius: 50%;
    z-index: 0;
}

.figure-2 {
    position: absolute;
    width: 100px;
    height: 100px;
    bottom: 20%;
    right: 15%;
    background: rgba(139, 31, 65, 0.05);
    border-radius: 50%;
    z-index: 0;
}


.controls-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(74, 85, 104, 0.06);
    border: 1px solid var(--folder-border);
}

/* Enhanced search container */
.search-container {
    flex-grow: 1;
    max-width: 500px;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 0.875rem 1.25rem 0.875rem 3rem;
    border: 2px solid #E2E8F0;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background-color: #F8FAFC;
    color: #1A202C;
}

.search-input:focus {
    background-color: white;
    border-color: #800020;
    outline: none;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

.search-input::placeholder {
    color: #A0AEC0;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #800020;
    font-size: 1.1rem;
}

/* Tamaño de Fuente para Inputs y Selects */
input[type="text"],
select,
textarea {
    font-size: 20px !important;
}
:root {
    /* Enhanced color palette */
    --primary-color: #8B1F41;
    --secondary-color: #D4A5A5;
    --background-color: #FAF6F6;
    --text-primary: #2D2424;
    --text-secondary: #6B5656;
    --gradient-primary: linear-gradient(135deg, #8B1F41, #4A0404);
    --gradient-hover: linear-gradient(135deg, #4A0404, #8B1F41);
}

.folders-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
    padding: 1rem 0;
}

.folder-item {
    background: white;
    border-radius: 25px;
    padding: 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: 2px solid transparent;
    box-shadow: 0 10px 25px rgba(139, 31, 65, 0.08);
    position: relative;
    overflow: hidden;
}

.folder-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.folder-item:hover {
    transform: translateY(-10px);
    border-color: var(--secondary-color);
    box-shadow: 0 15px 35px rgba(139, 31, 65, 0.15);
}

.folder-item:hover::before {
    opacity: 1;
}


.folder-item:hover .folder-icon {
    transform: scale(1.1) rotate(10deg);
}

.folder-details {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.folder-title {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 1.4rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: color 0.3s ease;
}

.folder-info {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.info-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.folder-item:hover .info-group {
    opacity: 1;
}

.info-group i {
    color: var(--primary-color);
    font-size: 1.1rem;
}

.folder-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.btn-action {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: var(--background-color);
    color: var(--primary-color);
    border: 2px solid transparent;
    transition: all 0.3s ease;
    font-size: 1.2rem;
}

.btn-action:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
    border-color: var(--secondary-color);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .folders-list {
        grid-template-columns: 1fr;
    }

    .folder-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .folder-actions {
        flex-direction: row;
        margin-top: 1rem;
    }
}
.main-container {
    background: linear-gradient(135deg, #ffffff, #faf0f0);
    border-radius: 16px;
    box-shadow: 0 15px 30px rgba(139, 31, 65, 0.08);
}

.folders-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    padding: 1rem 0;
}

.folder-item {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: 2px solid transparent;
    box-shadow: 
        0 10px 25px rgba(139, 31, 65, 0.06),
        0 4px 6px rgba(139, 31, 65, 0.04);
    position: relative;
    overflow: hidden;
    will-change: transform, box-shadow;
}

.folder-item:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: #D4A5A5;
    box-shadow: 
        0 20px 40px rgba(139, 31, 65, 0.12),
        0 6px 10px rgba(139, 31, 65, 0.08);
}

.folder-icon {
    background: linear-gradient(145deg, #8B1F41, #4A0404);
    color: white;
    padding: 1.5rem;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(139, 31, 65, 0.2);
    transition: all 0.3s ease;
}

.folder-item:hover .folder-icon {
    transform: rotate(10deg) scale(1.1);
    box-shadow: 0 12px 25px rgba(139, 31, 65, 0.3);
}

.folder-title {
    font-weight: 700;
    color: #8B1F41;
    font-size: 1.4rem;
    letter-spacing: -0.5px;
    transition: color 0.3s ease;
}

.folder-info {
    color: #6B5656;
    font-size: 0.95rem;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.folder-actions .btn-action {
    background: rgba(139, 31, 65, 0.05);
    color: #8B1F41;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.folder-actions .btn-action:hover {
    background: #8B1F41;
    color: white;
    transform: scale(1.1) rotate(5deg);
}

@media (max-width: 768px) {
    .folders-list {
        grid-template-columns: 1fr;
    }
    
    .folder-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }
}

  /* Pagination Container */
  .pagination {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.75rem;
        margin: 2rem 1.5rem;
        font-family: 'Arial', sans-serif;
    }

    /* Pagination Navigation Container */
    .pagination nav {
        border-radius: 0.5rem;
    }

    /* Pagination Flex Container */
    .pagination nav div {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Results Text */
    .pagination nav div div p {
        margin: 0 1rem;
        color: #4A5568;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Common Styles for Links and Spans */
    .pagination nav div div span,
    .pagination nav div div a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        height: 2.25rem;
        padding: 0.25rem 0.75rem;
        margin: 0 0.125rem;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    /* Current/Active Page */
    .pagination nav div div span.bg-red-800 {
        background-color: #800020 !important;
        color: white;
        box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
    }

    /* Regular Links */
    .pagination nav div div a {
        color: #4A5568;
    }

    /* Hover State */
    .pagination nav div div a:hover {
        background-color: #800020;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
    }

    /* Disabled State */
    .pagination nav div div span.cursor-default {
        color: #A0AEC0;
        cursor: not-allowed;
    }

    /* Hide Previous/Next Buttons */
    .pagination nav div div a[rel="prev"],
    .pagination nav div div a[rel="next"] {
        display: none;
    }

</style>

@section('content')
<div class="main-container">
    <section class="section">
        <div class="d-flex align-items-center">
            <h3 class="page__heading">Cajas</h3>
        </div>

        <div class="controls-container">
            <div class="d-flex align-items-center">
                @can('crear-caja')
                <a class="btn btn-new" href="{{ route('cajas.create') }}"
                style="background: #800020; color: white; font-weight: bold; text-decoration: none;">
                    <i class="fas fa-plus"></i>
                    <span>Nueva Caja</span>
                </a>
                @endcan
            </div>
            
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Buscar cajas...">
            </div>

            <form method="GET" action="{{ route('cajas.index') }}" class="d-flex align-items-center gap-2">
                <label for="perPage">Mostrar:</label>
                <select name="per_page" id="perPage" onchange="this.form.submit()" 
                        style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid var(--gray-300);">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
        </div>

        <div class="folders-list">
            @foreach ($cajas as $caja)
            <div class="folder-item" data-search-content>
                <i class="fas fa-box folder-icon" ></i>

                <div class="folder-details">
                    <div class="folder-title">
                        Caja #{{ $caja->numero_caja }}
                    </div>
                    <div class="folder-info">
                        <div class="info-group">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $caja->mes }} {{ $caja->anio }}</span>
                        </div>
                        <div class="info-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $caja->ubicacion }}</span>
                        </div>
                        <div class="info-group">
                            <i class="fas fa-sort-alpha-down"></i>
                            <span>{{ $caja->rango_alfabetico }}</span>
                        </div>
                    </div>
                </div>

                <div class="folder-actions">
                    @can('ver-cajas')
                    <a href="{{ route('cajas.show', $caja->id) }}" class="btn-action" title="Ver detalles">
                        <i class="fas fa-eye"></i>
                    </a>
                    @endcan

                    @can('editar-caja')
                    <a href="{{ route('cajas.edit', $caja->id) }}" class="btn-action" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endcan

                    @can('eliminar-caja')
                    <form id="eliminar-form-{{ $caja->id }}" action="{{ route('cajas.destroy', $caja->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-action" title="Eliminar" onclick="confirmarEliminacion({{ $caja->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {!! $cajas->links() !!}
        </div>
    </section>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('.folder-item').forEach(folder => {
        const content = folder.textContent.toLowerCase();
        folder.style.display = content.includes(searchTerm) ? '' : 'none';
    });
});

function confirmarEliminacion(cajaId) {
    Swal.fire({
        title: '<strong>¡ADVERTENCIA!</strong>',
        html: '<p style="font-size: 1.2rem; color: #d9534f; font-weight: bold;">Estás a punto de BORRAR permanentemente esta caja. Esta acción no se puede deshacer.</p>',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<span style="font-size: 1.1rem;">Sí, BORRAR</span>',
        cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>',
        customClass: {
            popup: 'animated shake',
            title: 'swal-title-large'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: '<strong>¿Estás completamente seguro?</strong>',
                html: '<p style="font-size: 1.1rem;">Esta es tu última oportunidad para cancelar.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<span style="font-size: 1.1rem;">Sí, estoy seguro</span>',
                cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>',
                customClass: {
                    popup: 'animated shake'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('eliminar-form-' + cajaId).submit();
                }
            });
        }
    });
}
</script>
@endsection