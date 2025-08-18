
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard | Salon Chic</title>
    <link href="10https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
        :root {
            --primary-color: #0f172a;
            --accent-color: #ec4899;
            --accent-light: #f8b4d9;
            --background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --border-gradient: linear-gradient(45deg, #ec4899, #8b5cf6, #06b6d4);
            --text-gradient: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #fafafa;
            font-family: 'Inter', sans-serif;
            color: var(--primary-color);
            margin: 0;
            padding: 2rem 1rem;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }



        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            background: var(--text-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            font-size: clamp(2rem, 5vw, 3.5rem);
            margin-bottom: 3rem;
            letter-spacing: -0.02em;
            position: relative;
        }





        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 columnas fijas */
            gap: 2rem;
            padding: 1rem 0;
        }

        .card-dashboard {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .card-dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--border-gradient);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
        }

        .card-dashboard::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .card-dashboard:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: rgba(236, 72, 153, 0.3);
        }

        .card-dashboard:hover::before {
            transform: scaleX(1);
        }

        .card-dashboard:hover::after {
            opacity: 1;
        }

        .icon-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .icon-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.2), rgba(139, 92, 246, 0.2));
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .card-dashboard:hover .icon-container::before {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.3), rgba(139, 92, 246, 0.3));
        }

        .card-dashboard i {
            font-size: 2.5rem;
            background: var(--text-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .card-dashboard:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            opacity: 0.8;
        }

        .count {
            font-size: 2.8rem;
            font-weight: 700;
            background: var(--text-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.02em;
            margin: 0;
            position: relative;
        }

        .count-label {
            font-size: 0.85rem;
            color: var(--primary-color);
            opacity: 0.6;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* Efectos de entrada */
        .card-dashboard {
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .card-dashboard:nth-child(1) { animation-delay: 0.1s; }
        .card-dashboard:nth-child(2) { animation-delay: 0.2s; }
        .card-dashboard:nth-child(3) { animation-delay: 0.3s; }
        .card-dashboard:nth-child(4) { animation-delay: 0.4s; }
        .card-dashboard:nth-child(5) { animation-delay: 0.5s; }
        .card-dashboard:nth-child(6) { animation-delay: 0.6s; }
        .card-dashboard:nth-child(7) { animation-delay: 0.7s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Partículas flotantes */
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(236, 72, 153, 0.4);
            border-radius: 50%;
            animation: particle-float 15s infinite linear;
            z-index: 0;
        }

        .particle:nth-child(2n) {
            background: rgba(139, 92, 246, 0.4);
            animation-duration: 20s;
        }

        .particle:nth-child(3n) {
            background: rgba(6, 182, 212, 0.4);
            animation-duration: 18s;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) translateX(0px) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .card-dashboard {
                padding: 2rem 1.5rem;
            }

            body {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .count {
                font-size: 2.2rem;
            }

            .card-dashboard i {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<!-- Partículas flotantes eliminadas -->
@include('layouts.slider')
<div class="main-content">
    <div class="dashboard-grid">
        @php
            $cards = [
            ['title' => 'Citas', 'count' => $data['citas'], 'icon' => 'bi-calendar-check', 'label' => 'Programadas'],
            ['title' => 'Empleados', 'count' => $data['empleados'], 'icon' => 'bi-people-fill', 'label' => 'Activos'],
            ['title' => 'Servicios', 'count' => $data['servicios'], 'icon' => 'bi-scissors', 'label' => 'Disponibles'],
            ['title' => 'Clientes', 'count' => $data['clientes'], 'icon' => 'bi-person-heart', 'label' => 'Registrados'],
            ['title' => 'Proveedores', 'count' => $data['proveedores'], 'icon' => 'bi-truck', 'label' => 'Activos'],
            ['title' => 'Productos', 'count' => $data['productos'], 'icon' => 'bi-bag-heart', 'label' => 'En inventario'],
            ['title' => 'Facturas', 'count' => $data['facturas'], 'icon' => 'bi-receipt-cutoff', 'label' => 'Este mes'],
            ['title' => 'Facturas', 'count' => $data['facturas'], 'icon' => 'bi-receipt-cutoff', 'label' => 'Este mes'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="card-dashboard">
                <div class="icon-container">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>
                <h5 class="card-title">{{ $card['title'] }}</h5>
                <h2 class="count" data-target="{{ $card['count'] }}">ㅤㅤ</h2>
                <div class="count-label">{{ $card['label'] }}</div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Animación contador mejorada
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.count');

        const animateCounter = (counter, target) => {
            let current = 99;
            const duration = 1200;
            const increment = target > current ? 1 : -1;
            const stepTime = Math.abs(Math.floor(duration / (target - current)));

            const timer = setInterval(() => {
                current += increment;
                counter.textContent = current.toLocaleString();

                if ((increment > 0 && current >= target) || (increment < 0 && current <= target)) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);

// Efecto de brillo al completar
                    counter.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        counter.style.transform = 'scale(1)';
                    }, 200);
                }
            }, stepTime);
        };

// Observer para activar animaciones cuando las tarjetas sean visibles
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const counter = entry.target.querySelector('.count');
                    const target = parseInt(counter.getAttribute('data-target'));

// Esperar un poco para que la animación de entrada termine
                    setTimeout(() => {
                        animateCounter(counter, target);
                    }, 800);

                    observer.unobserve(entry.target);
                }
            });
        });

        document.querySelectorAll('.card-dashboard').forEach((card) => {
            observer.observe(card);
        });
    });

    // Efecto de click en las tarjetas
    document.querySelectorAll('.card-dashboard').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
</script>
</body>
</html>
