<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sidebar Menu Mejorado</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        :root {
            --primary-color: #1f2937; /* Gris oscuro */
            --accent-color: #ed3aab; /* Morado vibrante */
            --background-color: #f9fafb; /* Fondo general */
            --sidebar-bg: #ffffff; /* Fondo sidebar */
            --hover-bg: #f3e8ff; /* Fondo hover submenu */
            --active-bg: #ed3aab; /* Fondo activo */
            --active-color: #ffffff; /* Texto activo */
            --shadow-sidebar: rgb(237, 58, 171); /* Sombra morada */
        }

        /* Reset y body */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--primary-color);
            transition: background-color 0.3s ease;
        }

        /* Botón toggle */
        .btn-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: var(--accent-color);
            border: none;
            color: var(--active-color);
            padding: 0.6rem 0.9rem;
            font-size: 1.6rem;
            border-radius: 0.5rem;
            cursor: pointer;
            z-index: 1200;
            box-shadow: 0 4px 12px var(--shadow-sidebar);
            transition: background-color 0.3s ease;
        }

        .btn-toggle:hover {
            background-color: #ed3aab;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            box-shadow: 4px 0 20px var(--shadow-sidebar);
            transform: translateX(-110%);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1100;
            overflow-y: auto;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        /* Header sidebar */
        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(90deg, #ed3aab 0%, #a78bfa 100%);
            border-top-right-radius: 15px;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            letter-spacing: 2px;
            user-select: none;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.15);
        }

        .logo-text span {
            font-weight: 600;
            color: #d8b4fe;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cart-icon {
            font-size: 1.7rem;
            color: white;
            transition: color 0.3s ease;
        }

        .cart-icon:hover {
            color: #d8b4fe;
        }

        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.7rem;
            color: white;
            cursor: pointer;
            padding: 0;
            transition: color 0.3s ease;
        }

        .btn-close:hover {
            color: #d8b4fe;
        }

        /* Menú */
        .nav-section {
            padding: 1rem 0;
        }

        .menu-item {
            padding: 0.85rem 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            color: var(--primary-color);
            transition: background-color 0.25s, color 0.25s;
            user-select: none;
            border-left: 4px solid transparent;
            border-radius: 0 10px 10px 0;
        }

        .menu-item:hover,
        .menu-item:focus {
            background-color: var(--hover-bg);
            outline: none;
            color: var(--accent-color);
            border-left-color: var(--accent-color);
        }

        .menu-item[aria-expanded="true"] {
            color: var(--accent-color);
            border-left-color: var(--accent-color);
            background-color: var(--hover-bg);
        }

        .menu-icon {
            margin-right: 0.8rem;
            font-size: 1.3rem;
            color: inherit;
            transition: color 0.25s;
            flex-shrink: 0;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.3s ease;
            background-color: #f3f2f7;
            border-radius: 0 0 10px 10px;
            margin-left: 1rem;
            box-shadow: inset 0 2px 8px rgb(124 58 237 / 0.1);
        }

        .submenu.open {
            max-height: 400px;
            padding: 0.6rem 0;
        }

        .submenu a {
            display: block;
            padding: 0.6rem 2.5rem;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: background-color 0.3s ease, color 0.3s ease, border-left-color 0.3s ease;
            user-select: none;
        }

        .submenu a:hover {
            background-color: #ede9fe;
            color: var(--accent-color);
            border-left-color: var(--accent-color);
        }

        .submenu a.active {
            background-color: var(--active-bg);
            color: var(--active-color);
            font-weight: 700;
            border-left-color: var(--active-color);
        }

        /* Scrollbar personalizado para sidebar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #a934ec;
            border-radius: 10px;
        }

        /* Responsive */
        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
                box-shadow: none;
                border-radius: 0;
            }
            .btn-toggle {
                display: none;
            }
            body {
                padding-left: 300px;
                transition: padding-left 0.35s ease;
            }
        }
    </style>
</head>
<body>

<!-- Toggle button -->
<button id="toggleBtn" class="btn-toggle d-lg-none" aria-label="Abrir menú" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<nav id="sidebar" class="sidebar" aria-label="Menú principal">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="logo-text" tabindex="0">Salon <span>Chic</span></a>
        <div class="header-icons">

            <button class="btn-close d-lg-none" onclick="toggleSidebar()" aria-label="Cerrar menú">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="nav-section">

        {{-- Empleados --}}
        <div class="menu-item" onclick="toggleSubmenu('empleadosMenu')" aria-expanded="{{ request()->routeIs('empleados.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('empleadosMenu')">
            <span><i class="bi bi-people menu-icon"></i>Empleados</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="empleadosMenu" class="submenu {{ request()->routeIs('empleados.*') ? 'open' : '' }}">
            <a href="{{ route('empleados.index') }}" class="{{ request()->routeIs('empleados.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('empleados.create') }}" class="{{ request()->routeIs('empleados.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Servicios --}}
        <div class="menu-item" onclick="toggleSubmenu('serviciosMenu')" aria-expanded="{{ request()->routeIs('servicios.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('serviciosMenu')">
            <span><i class="bi bi-scissors menu-icon"></i>Servicios</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="serviciosMenu" class="submenu {{ request()->routeIs('servicios.*') ? 'open' : '' }}">
            <a href="{{ route('servicios.index') }}" class="{{ request()->routeIs('servicios.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('servicios.create') }}" class="{{ request()->routeIs('servicios.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Clientes --}}
        <div class="menu-item" onclick="toggleSubmenu('clientesMenu')" aria-expanded="{{ request()->routeIs('clientes.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('clientesMenu')">
            <span><i class="bi bi-person menu-icon"></i>Clientes</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="clientesMenu" class="submenu {{ request()->routeIs('clientes.*') ? 'open' : '' }}">
            <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('clientes.create') }}" class="{{ request()->routeIs('clientes.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Clientes --}}
        <div class="menu-item" onclick="toggleSubmenu('citasMenu')" aria-expanded="{{ request()->routeIs('citas.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('citas')">
            <span><i class="bi bi-person menu-icon"></i>Citas</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="citasMenu" class="submenu {{ request()->routeIs('citas.*') ? 'open' : '' }}">
            <a href="{{ route('citas.index') }}" class="{{ request()->routeIs('citas.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('citas.create') }}" class="{{ request()->routeIs('citas.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Proveedores --}}
        <div class="menu-item" onclick="toggleSubmenu('proveedoresMenu')" aria-expanded="{{ request()->routeIs('proveedores.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('proveedoresMenu')">
            <span><i class="bi bi-box-seam menu-icon"></i>Proveedores</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="proveedoresMenu" class="submenu {{ request()->routeIs('proveedores.*') ? 'open' : '' }}">
            <a href="{{ route('proveedores.index') }}" class="{{ request()->routeIs('proveedores.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('proveedores.create') }}" class="{{ request()->routeIs('proveedores.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Productos --}}
        <div class="menu-item" onclick="toggleSubmenu('productosMenu')" aria-expanded="{{ request()->routeIs('productos.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('productosMenu')">
            <span><i class="bi bi-bag menu-icon"></i>Productos</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="productosMenu" class="submenu {{ request()->routeIs('productos.*') ? 'open' : '' }}">
            <a href="{{ route('productos.index') }}" class="{{ request()->routeIs('productos.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('productos.create') }}" class="{{ request()->routeIs('productos.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Facturas --}}
        <div class="menu-item" onclick="toggleSubmenu('facturasMenu')" aria-expanded="{{ request()->routeIs('facturas.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('facturasMenu')">
            <span><i class="bi bi-receipt menu-icon"></i>Factura de compra</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="facturasMenu" class="submenu {{ request()->routeIs('facturas.*') ? 'open' : '' }}">
            <a href="{{ route('facturas.index') }}" class="{{ request()->routeIs('facturas.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('facturas.create') }}" class="{{ request()->routeIs('facturas.create') ? 'active' : '' }}">Registrar</a>
        </div>

        {{-- Facturas de--}}
        <div class="menu-item" onclick="toggleSubmenu('facturaventaMenu')" aria-expanded="{{ request()->routeIs('facturaventa.*') ? 'true' : 'false' }}" role="button" tabindex="0" onkeypress="if(event.key==='Enter') toggleSubmenu('facturaventaMenu')">
            <span><i class="bi bi-receipt menu-icon"></i>Factura de venta</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div id="facturaventaMenu" class="submenu {{ request()->routeIs('facturaventa.*') ? 'open' : '' }}">
            <a href="{{ route('facturaventa.index') }}" class="{{ request()->routeIs('facturaventa.index') ? 'active' : '' }}">Listado</a>
            <a href="{{ route('facturaventa.create') }}" class="{{ request()->routeIs('facturaventa.create') ? 'active' : '' }}">Registrar</a>
        </div>

    </div>
</nav>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
    }

    // Cerrar sidebar si haces click fuera (en móvil)
    document.addEventListener('click', function (e) {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        if (window.innerWidth < 992 && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.remove('open');
        }
    });

    // Abrir/Cerrar submenú
    function toggleSubmenu(id) {
        const submenu = document.getElementById(id);
        submenu.classList.toggle('open');

        // Actualizar aria-expanded del menu-item correspondiente
        const menuItem = submenu.previousElementSibling;
        if (submenu.classList.contains('open')) {
            menuItem.setAttribute('aria-expanded', 'true');
        } else {
            menuItem.setAttribute('aria-expanded', 'false');
        }
    }
</script>

</body>
</html>