<div class="wrapper">
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
        <style>
            .main-content {
                margin-left: 250px; /* Ajusta según el ancho de tu sidebar */
                padding: 20px;
                background-color: #f3f4f6;
                min-height: 100vh;
            }
            .titulo {
                color: #065f46;
                font-weight: bold;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
            }
            .expediente-card {
                background-color: #ffffff;
                border-radius: 1rem;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.06);
                border-left: 5px solid #22c55e;
                transition: transform 0.2s;
            }
            .expediente-card:hover {
                transform: translateY(-4px);
            }
            .btn-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-weight: 500;
            }
            .status-badge {
                font-size: 0.8rem;
                padding: 0.3rem 0.7rem;
                border-radius: 1rem;
                font-weight: 600;
            }
            .volver-btn {
                color: #374151;
                border-color: #9ca3af;
            }
            .volver-btn:hover {
                background-color: #e5e7eb;
            }
            .search-box {
                position: relative;
            }
            .search-box .search-icon {
                position: absolute;
                top: 50%;
                left: 15px;
                transform: translateY(-50%);
                color: #6b7280;
            }
            .search-box input {
                padding-left: 40px;
            }
            .filter-section {
                background-color: #f9fafb;
                border-radius: 0.5rem;
                padding: 1rem;
                margin-bottom: 1.5rem;
            }
            .filter-title {
                font-weight: 600;
                color: #374151;
                margin-bottom: 0.75rem;
            }
            .no-results {
                text-align: center;
                padding: 3rem;
                color: #6b7280;
            }
            .pagination-info {
                font-size: 0.9rem;
                color: #6b7280;
            }
            .text-green-600 { color: #16a34a; }
            .text-yellow-600 { color: #ca8a04; }
            .text-green-800 { color: #166534; }
            .text-gray-700 { color: #374151; }
            .bg-green-100 { background-color: #dcfce7; }
            .text-green-800 { color: #166534; }
            .bg-yellow-200 { background-color: #fef08a; }
            .text-yellow-800 { color: #854d0e; }
            .text-danger { color: #dc2626; }
            .border-warning { border-color: #f59e0b !important; }
        </style>
    @endpush

    <div class="main-content">
        <div class="container">
            <!-- Encabezado -->
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h1 class="titulo fs-3">
                    <i class="bi bi-archive-fill me-2"></i> REPOSITORIO DE EXPEDIENTES
                </h1>
                <a href="#" class="btn volver-btn">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>

            <!-- Barra de búsqueda y filtros -->
            <div class="filter-section mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="search-box">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" class="form-control" id="searchInput" placeholder="Buscar por número de expediente, título o contenido...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterStatus">
                            <option value="">Todos los estados</option>
                            <option value="completo">Completo</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="faltante">Documento faltante</option>
                            <option value="revision">En revisión</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterType">
                            <option value="">Todos los tipos</option>
                            <option value="academico">Académico</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="queja">Queja</option>
                            <option value="solicitud">Solicitud</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="filterDateFrom" class="form-label filter-title">Desde:</label>
                        <input type="date" class="form-control" id="filterDateFrom">
                    </div>
                    <div class="col-md-3">
                        <label for="filterDateTo" class="form-label filter-title">Hasta:</label>
                        <input type="date" class="form-control" id="filterDateTo">
                    </div>
                    <div class="col-md-3">
                        <label for="filterDepartment" class="form-label filter-title">Departamento:</label>
                        <select class="form-select" id="filterDepartment">
                            <option value="">Todos</option>
                            <option value="sistemas">Ingeniería de Sistemas</option>
                            <option value="derecho">Derecho</option>
                            <option value="medicina">Medicina</option>
                            <option value="administracion">Administración</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-outline-secondary w-100" id="resetFilters">
                            <i class="bi bi-arrow-counterclockwise"></i> Limpiar filtros
                        </button>
                    </div>
                </div>
            </div>

            <!-- Información de resultados -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="pagination-info">
                    Mostrando <span id="showingCount">2</span> de <span id="totalCount">2</span> expedientes
                </div>
                <div>
                    <select class="form-select form-select-sm" id="itemsPerPage" style="width: auto; display: inline-block;">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="50">50 por página</option>
                        <option value="100">100 por página</option>
                    </select>
                </div>
            </div>

            <!-- Contenedor de expedientes -->
            <div id="expedientesContainer">
                <!-- Expediente 1 -->
                <div class="expediente-card p-4 mb-4" data-expediente="EXP-2025-034" data-tipo="academico" data-estado="completo" data-departamento="sistemas" data-fecha="2025-06-28">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="fw-bold text-green-800">Expediente: <strong>EXP-2025-034</strong></h5>
                            <div class="d-flex flex-wrap gap-3 mb-2 text-gray-700">
                                <span><i class="bi bi-tag-fill text-green-600"></i> Solicitud Académica</span>
                                <span><i class="bi bi-building text-green-600"></i> Ingeniería de Sistemas</span>
                                <span><i class="bi bi-calendar text-green-600"></i> 28/06/2025</span>
                            </div>
                            <span class="status-badge bg-green-100 text-green-800">
                                <i class="bi bi-check-circle"></i> Listo para descarga
                            </span>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success btn-icon">
                                    <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                                </button>
                                <button class="btn btn-success btn-icon">
                                    <i class="bi bi-file-earmark-zip"></i> Descargar ZIP
                                </button>
                                <button class="btn btn-outline-secondary btn-icon">
                                    <i class="bi bi-eye"></i> Previsualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expediente 2 -->
                <div class="expediente-card p-4 mb-4 border-start border-warning" data-expediente="EXP-2025-035" data-tipo="queja" data-estado="faltante" data-departamento="derecho" data-fecha="2025-07-02">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="fw-bold text-green-800">Expediente: <strong>EXP-2025-035</strong></h5>
                            <div class="d-flex flex-wrap gap-3 mb-2 text-gray-700">
                                <span><i class="bi bi-tag-fill text-yellow-600"></i> Queja administrativa</span>
                                <span><i class="bi bi-building text-yellow-600"></i> Derecho</span>
                                <span><i class="bi bi-calendar text-yellow-600"></i> 02/07/2025</span>
                            </div>
                            <span class="status-badge bg-yellow-200 text-yellow-800">
                                <i class="bi bi-exclamation-triangle"></i> Documento faltante
                            </span>
                            <div class="mt-2 text-danger small">
                                <i class="bi bi-info-circle"></i> Falta el documento de respaldo
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success btn-icon" disabled>
                                    <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                                </button>
                                <button class="btn btn-success btn-icon" disabled>
                                    <i class="bi bi-file-earmark-zip"></i> Descargar ZIP
                                </button>
                                <button class="btn btn-outline-secondary btn-icon">
                                    <i class="bi bi-eye"></i> Previsualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mensaje cuando no hay resultados -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="bi bi-search fs-1"></i>
                <h5 class="mt-3">No se encontraron expedientes</h5>
                <p class="text-muted">Intenta ajustar tus filtros de búsqueda</p>
            </div>

            <!-- Paginación -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>

            <!-- Auditoría -->
            <div class="alert alert-info mt-4">
                <div class="d-flex align-items-center">
                    <i class="bi bi-clock-history fs-4 me-3"></i>
                    <div>
                        <strong>Última descarga registrada:</strong><br/>
                        <span class="text-gray-700">2025-07-18 14:20 — Expediente: <strong>EXP-2025-034</strong> — Operador: <strong>F. Cárdenas</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Elementos del DOM
                const searchInput = document.getElementById('searchInput');
                const filterStatus = document.getElementById('filterStatus');
                const filterType = document.getElementById('filterType');
                const filterDepartment = document.getElementById('filterDepartment');
                const filterDateFrom = document.getElementById('filterDateFrom');
                const filterDateTo = document.getElementById('filterDateTo');
                const resetFilters = document.getElementById('resetFilters');
                const expedientesContainer = document.getElementById('expedientesContainer');
                const noResults = document.getElementById('noResults');
                const showingCount = document.getElementById('showingCount');
                const totalCount = document.getElementById('totalCount');
                
                // Todos los expedientes (en una aplicación real esto vendría de una API)
                const expedientes = Array.from(document.querySelectorAll('.expediente-card'));
                
                // Actualizar contador total
                totalCount.textContent = expedientes.length;
                
                // Función para filtrar expedientes
                function filtrarExpedientes() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const statusFilter = filterStatus.value;
                    const typeFilter = filterType.value;
                    const departmentFilter = filterDepartment.value;
                    const dateFrom = filterDateFrom.value;
                    const dateTo = filterDateTo.value;
                    
                    let visibleCount = 0;
                    
                    expedientes.forEach(expediente => {
                        const expedienteNum = expediente.dataset.expediente.toLowerCase();
                        const tipo = expediente.dataset.tipo;
                        const estado = expediente.dataset.estado;
                        const departamento = expediente.dataset.departamento;
                        const fecha = expediente.dataset.fecha;
                        
                        // Aplicar filtros
                        const matchesSearch = expedienteNum.includes(searchTerm) || 
                                            expediente.textContent.toLowerCase().includes(searchTerm);
                        const matchesStatus = !statusFilter || estado === statusFilter;
                        const matchesType = !typeFilter || tipo === typeFilter;
                        const matchesDepartment = !departmentFilter || departamento === departmentFilter;
                        const matchesDate = (!dateFrom || fecha >= dateFrom) && 
                                            (!dateTo || fecha <= dateTo);
                        
                        if (matchesSearch && matchesStatus && matchesType && matchesDepartment && matchesDate) {
                            expediente.style.display = '';
                            visibleCount++;
                        } else {
                            expediente.style.display = 'none';
                        }
                    });
                    
                    // Mostrar u ocultar mensaje de no resultados
                    if (visibleCount === 0) {
                        noResults.style.display = '';
                        expedientesContainer.style.display = 'none';
                    } else {
                        noResults.style.display = 'none';
                        expedientesContainer.style.display = '';
                    }
                    
                    // Actualizar contador
                    showingCount.textContent = visibleCount;
                }
                
                // Event listeners para los filtros
                searchInput.addEventListener('input', filtrarExpedientes);
                filterStatus.addEventListener('change', filtrarExpedientes);
                filterType.addEventListener('change', filtrarExpedientes);
                filterDepartment.addEventListener('change', filtrarExpedientes);
                filterDateFrom.addEventListener('change', filtrarExpedientes);
                filterDateTo.addEventListener('change', filtrarExpedientes);
                
                // Botón para resetear filtros
                resetFilters.addEventListener('click', function() {
                    searchInput.value = '';
                    filterStatus.value = '';
                    filterType.value = '';
                    filterDepartment.value = '';
                    filterDateFrom.value = '';
                    filterDateTo.value = '';
                    filtrarExpedientes();
                });
            });
        </script>
    @endpush
</div>