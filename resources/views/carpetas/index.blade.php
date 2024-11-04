@extends('layouts.app')

<style>
:root {
  /* Colores de carpetas manilla clásicas */
  --color-folder1: #FFDE9E;
  --color-folder2: #FFD175;
  --color-folder3: #F5C45C;
  --color-folder4: #EBB346;
  
  /* Colores para los detalles y sombras */
  --folder-shadow: rgba(0, 0, 0, 0.08);
  --folder-dark: #B7935F;
  --text-primary: #5D4215;
  --text-secondary: #7D6134;
  --highlight: rgba(255, 255, 255, 0.7);
  --border-light: rgba(183, 147, 95, 0.3);
}

.folders-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
  gap: 2.5rem;
  padding: 2rem;
}

.folder-card {
  position: relative;
  min-height: 260px;
  transition: all 0.4s ease;
  transform-origin: center bottom;
}

/* Estilos base para todas las carpetas */
.folder-variant-1,
.folder-variant-2,
.folder-variant-3,
.folder-variant-4 {
  position: relative;
  border-radius: 2px 12px 12px 2px;
  box-shadow: 
    0 4px 12px var(--folder-shadow),
    0 1px 3px var(--folder-shadow);
  overflow: hidden;
}

/* Efecto de doblez superior */
.folder-variant-1::before,
.folder-variant-2::before,
.folder-variant-3::before,
.folder-variant-4::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 40px;
  background: linear-gradient(180deg, 
    rgba(255, 255, 255, 0.15) 0%,
    transparent 100%);
}

/* Efecto de doblez lateral */
.folder-variant-1::after,
.folder-variant-2::after,
.folder-variant-3::after,
.folder-variant-4::after {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 30px;
  height: 40px;
  background: linear-gradient(135deg, 
    transparent 50%,
    rgba(0, 0, 0, 0.03) 50%);
}

/* Variantes de carpetas con texturas y gradientes */
.folder-variant-1 {
  background: linear-gradient(145deg,
    var(--color-folder1) 0%,
    #FFE6B5 100%);
}

.folder-variant-2 {
  background: linear-gradient(145deg,
    var(--color-folder2) 0%,
    #FFDFA3 100%);
}

.folder-variant-3 {
  background: linear-gradient(145deg,
    var(--color-folder3) 0%,
    #FFD88E 100%);
}

.folder-variant-4 {
  background: linear-gradient(145deg,
    var(--color-folder4) 0%,
    #FFD17F 100%);
}

/* Diseño de las pestañas */
.folder-tab {
  position: absolute;
  height: 32px;
  width: 120px;
  top: -16px;
  left: 25px;
  background: var(--folder-dark);
  border-radius: 6px 6px 0 0;
  box-shadow: 
    0 -2px 5px rgba(0, 0, 0, 0.05),
    inset 0 1px 2px rgba(255, 255, 255, 0.15);
}

.folder-tab::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: rgba(0, 0, 0, 0.05);
}

.folder-content {
  position: relative;
  padding: 1.75rem;
  height: 100%;
  z-index: 1;
}

.folder-header {
  padding-bottom: 1.25rem;
  margin-bottom: 1.25rem;
  border-bottom: 2px solid var(--border-light);
}

.folder-number {
  font-size: 1.35rem;
  font-weight: 600;
  color: var(--text-primary);
  letter-spacing: 0.5px;
}

.folder-info {
  display: grid;
  gap: 1.15rem;
}

.info-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 0.85rem 1rem;
  background: var(--highlight);
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.8);
  transition: all 0.3s ease;
}

.info-item:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: translateX(5px);
}

.info-label {
  font-size: 0.925rem;
  color: var(--text-secondary);
  font-weight: 500;
  min-width: 100px;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.info-label i {
  color: var(--folder-dark);
  font-size: 1rem;
  width: 20px;
  text-align: center;
}

.info-value {
  font-weight: 500;
  color: var(--text-primary);
  flex-grow: 1;
}

.folder-actions {
  display: flex;
  gap: 0.75rem;
  margin-top: 1.5rem;
  justify-content: flex-end;
  padding-top: 1.25rem;
  border-top: 2px solid var(--border-light);
}

.btn-action {
  width: 38px;
  height: 38px;
  border-radius: 8px;
  background:rgb(95, 23, 23);
  border: 1px solid rgba(255, 255, 255, 0.8);
  color: var(--folder-dark);
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-action:hover {
  background: white;
  transform: translateY(-2px);
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

/* Efectos hover en las carpetas */
.folder-card:hover {
  transform: translateY(-6px);
  box-shadow: 
    0 8px 20px rgba(0, 0, 0, 0.1),
    0 2px 5px rgba(0, 0, 0, 0.05);
}

/* Botón de nueva carpeta */
.new-folder-btn {
  position: fixed;
  bottom: 2.5rem;
  right: 2.5rem;
  width: 60px;
  height: 60px;
  border-radius: 15px;
  background: var(--folder-dark);
  color: white;
  border: none;
  box-shadow: 0 4px 15px rgba(183, 147, 95, 0.3);
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
}

.new-folder-btn:hover {
  transform: translateY(-4px) rotate(90deg);
  box-shadow: 0 8px 20px rgba(183, 147, 95, 0.4);
  background: #A17F4A;
}

/* Mejora del contenedor principal */
.main-container {
  padding: 2rem;
  background: linear-gradient(135deg, #F8F9FA 0%, #F3F4F6 100%);
  min-height: 100vh;
}

/* Animaciones suaves para las carpetas */
@keyframes folderAppear {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.folder-card {
  animation: folderAppear 0.5s ease-out forwards;
}
/* Improved Search Bar Styling */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem 2rem 2rem;
    margin-bottom: 1rem;
}

.page__heading {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-primary);
    font-size: 1.75rem;
    font-weight: 600;
}

.page__heading i {
    color: var(--folder-dark);
}

.search-container {
    position: relative;
    width: 400px;
    margin-left: auto;
}

.search-input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border-radius: 12px;
    border: 2px solid var(--border-light);
    background-color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
    color: var(--text-primary);
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.search-input:focus {
    outline: none;
    border-color: var(--folder-dark);
    background-color: white;
    box-shadow: 
        0 4px 12px rgba(183, 147, 95, 0.15),
        0 0 0 3px rgba(183, 147, 95, 0.1);
}

.search-input::placeholder {
    color: var(--text-secondary);
    opacity: 0.7;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--folder-dark);
    font-size: 1.1rem;
    pointer-events: none;
    transition: all 0.3s ease;
}

.search-input:focus + .search-icon {
    color: var(--text-primary);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
        padding: 1rem;
    }

    .search-container {
        width: 100%;
    }

    .page__heading {
        text-align: center;
        justify-content: center;
    }
}

/* Search animation */
@keyframes searchAppear {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-container {
    animation: searchAppear 0.5s ease-out forwards;
}

</style>

@section('content')
<div class="main-container">
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">
                <i class="fas fa-folders"></i>
                Gestión de Carpetas
            </h3>
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Buscar carpetas...">
            </div>
        </div>

        <div class="folders-grid">
            @foreach($carpetas as $index => $carpeta)
            <div class="folder-card folder-variant-{{ ($index % 4) + 1 }}" data-search-content>
                <div class="folder-tab"></div>
                <div class="folder-content">
                    <div class="folder-header">
                        <div class="folder-number">Carpeta #{{ $carpeta->id }}</div>
                    </div>

                    <div class="folder-info">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-user"></i>
                                Evaluado:
                            </span>
                            <p class="info-value">
                                {{ $carpeta->evaluado ? 
                                    $carpeta->evaluado->primer_nombre . ' ' .
                                    ($carpeta->evaluado->segundo_nombre ?? '') . ' ' .
                                    $carpeta->evaluado->primer_apellido . ' ' .
                                    ($carpeta->evaluado->segundo_apellido ?? '') : 'No asignado' 
                                }}
                            </p>
                        </div>
                        

                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-archive"></i>
                                Caja:
                            </span>
                            <span class="info-value">
                                {{ $carpeta->caja ? 'Caja #' . $carpeta->caja->numero_caja : 'No asignada' }}
                            </span>
                        </div>

                        <div class="folder-actions">
                            <a href="{{ route('carpetas.show', $carpeta->id) }}" class="btn-action" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('carpetas.edit', $carpeta->id) }}" class="btn-action" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="new-folder-btn" onclick="window.location.href='{{ route('carpetas.create') }}'">
            <i class="fas fa-plus"></i>
        </button>
    </section>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('.folder-card').forEach(folder => {
        const content = folder.textContent.toLowerCase();
        folder.style.display = content.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endsection