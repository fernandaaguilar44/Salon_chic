<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;900&display=swap" rel="stylesheet">

<button id="toggleBtn" class="btn-toggle d-lg-none" aria-label="Abrir menú" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>

<nav id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <a href="" class="logo-text">Salon <span>Chic</span></a>
        <button class="btn-close d-lg-none" aria-label="Cerrar menú" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="accordion" id="sidebarAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEmpleados">
                <button
                    class="accordion-button {{ request()->routeIs('empleados.*') ? '' : 'collapsed' }}"
                    type="button" data-bs-toggle="collapse" data-bs-target="#empleadosMenu"
                    aria-expanded="{{ request()->routeIs('empleados.*') ? 'true' : 'false' }}"
                    aria-controls="empleadosMenu">
                    <i class="bi bi-people me-2"></i> Empleados
                </button>
            </h2>
            <div id="empleadosMenu" class="accordion-collapse collapse {{ request()->routeIs('empleados.*') ? 'show' : '' }}" aria-labelledby="headingEmpleados" data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column ps-3 mb-0">
                    <li class="nav-item">
                        <a href="{{ route('empleados.index') }}" class="nav-link {{ request()->routeIs('empleados.index') ? 'active' : '' }}">
                            Listado
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('empleados.create') }}" class="nav-link {{ request()->routeIs('empleados.create') ? 'active' : '' }}">
                            Registrar
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingProveedores">
                <button
                    class="accordion-button {{ request()->routeIs('proveedores.*') ? '' : 'collapsed' }}"
                    type="button" data-bs-toggle="collapse" data-bs-target="#proveedoresMenu"
                    aria-expanded="{{ request()->routeIs('proveedores.*') ? 'true' : 'false' }}"
                    aria-controls="proveedoresMenu">
                    <i class="bi bi-box-seam me-2"></i> Proveedores
                </button>
            </h2>
            <div id="proveedoresMenu" class="accordion-collapse collapse {{ request()->routeIs('proveedores.*') ? 'show' : '' }}" aria-labelledby="headingProveedores" data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column ps-3 mb-0">
                    <li class="nav-item">
                        <a href="{{ route('proveedores.index') }}" class="nav-link {{ request()->routeIs('proveedores.index') ? 'active' : '' }}">
                            Listado
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('proveedores.create') }}" class="nav-link {{ request()->routeIs('proveedores.create') ? 'active' : '' }}">
                            Registrar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    :root {
        --primary-color: #4b5563;
        --accent-color: #3a006b;
        --accent-color-hover: #3a006b;
        --background-color: #f9fafb;
        --sidebar-bg: #ffffff;
        --text-color: #374151;
        --text-active: #3a006b;
    }

    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .logo-text {
        font-size: 1.75rem;
        font-weight: 900;
        background: linear-gradient(90deg, #3a006b, #3a006b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-decoration: none;
        font-family: 'Playfair Display', serif;
        letter-spacing: 1px;
        transition: transform 0.2s ease-in-out;
        display: inline-block;
        padding: 10px;
    }

    .logo-text:hover {
        transform: scale(1.05);
    }

    .logo-text span {
        color: var(--primary-color);
        font-weight: 600;
    }



    .btn-toggle {
        position: fixed;
        top: 1rem;
        left: 1rem;
        background: var(--accent-color);
        border: none;
        color: white;
        padding: 0.5rem 0.7rem;
        font-size: 1.5rem;
        border-radius: 0.35rem;
        cursor: pointer;
        z-index: 1100;
        transition: background-color 0.2s;
    }
    .btn-toggle:hover,
    .btn-toggle:focus {
        background: var(--accent-color-hover);
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-color);
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        background: var(--sidebar-bg);
        box-shadow: 2px 0 8px rgb(0 0 0 / 0.1);
        padding: 1rem 0;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        z-index: 1099;
        display: flex;
        flex-direction: column;
    }
    .sidebar.open {
        transform: translateX(0);
        z-index: 1200;
    }

    .sidebar-header {
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .sidebar-header h3 {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--primary-color);
        margin: 0;
    }
    .btn-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--primary-color);
        cursor: pointer;
        transition: color 0.2s;
    }
    .btn-close:hover,
    .btn-close:focus {
        color: var(--accent-color);
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-color);
    }

    .accordion-button {
        background: none !important;
        border: none !important;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 0.25rem;
        transition: background-color 0.15s, color 0.15s;
    }
    .accordion-button.collapsed {
        color: var(--primary-color);
    }
    .accordion-button:not(.collapsed) {
        background-color: var(--background-color);
        color: var(--accent-color);
        font-weight: 700;
    }
    .accordion-button:hover {
        background-color: #ede9fe;
        color: var(--accent-color-hover);
    }
    .accordion-button::after {
        filter: none !important;
        transition: transform 0.3s ease;
    }
    .accordion-button:not(.collapsed)::after {
        transform: rotate(90deg);
    }
    .accordion-button:focus {
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-color);
    }

    .nav-link {
        display: block;
        padding: 0.5rem 2.5rem;
        font-weight: 500;
        color: var(--primary-color);
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.15s, color 0.15s;
    }
    .nav-link:hover {
        background-color: #ede9fe;
        color: var(--accent-color-hover);
    }
    .nav-link.active {
        background-color: var(--accent-color);
        color: white;
        font-weight: 700;
        box-shadow: 0 0 5px var(--accent-color);
    }
    .nav-link:focus {
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-color);
    }

    .accordion-button i {
        font-size: 1.25rem;
        color: var(--primary-color);
        transition: color 0.15s;
    }
    .accordion-button:hover i,
    .accordion-button:not(.collapsed) i {
        color: var(--accent-color);
    }

    @media (min-width: 992px) {
        .sidebar {
            transform: translateX(0);
            box-shadow: none;
        }
        #toggleBtn {
            display: none;
        }
        body {
            padding-left: 260px;
        }
    }

    .accordion-button:focus,
    .nav-link:focus,
    .btn-toggle:focus,
    .btn-close:focus {
        outline: none;
        box-shadow: 0 0 0 3px #3a006b;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
    }

    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        if (window.innerWidth < 992) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        }
    });
</script>
