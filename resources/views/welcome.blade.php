<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mesa de trámites</title>

        <!-- Favicon -->
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                DEFAULT: '#22572D', // Verde oscuro
                                50: '#f0fdf4',
                                100: '#dcfce7',
                                200: '#bbf7d0',
                                300: '#86efac',
                                400: '#4ade80',
                                500: '#22c55e',
                                600: '#16a34a',
                                700: '#15803d',
                                800: '#166534',
                                900: '#14532d', // Tono más cercano al solicitado
                            },
                            secondary: {
                                DEFAULT: '#E5C300', // Amarillo dorado
                                50: '#fefce8',
                                100: '#fef9c3',
                                200: '#fef08a',
                                300: '#fde047',
                                400: '#facc15',
                                500: '#eab308',
                                600: '#ca8a04',
                                700: '#a16207',
                                800: '#854d0e',
                                900: '#713f12',
                            },
                            accent: {
                                DEFAULT: '#000000', // Negro
                                50: '#fafafa',
                                100: '#f4f4f5',
                                200: '#e4e4e7',
                                300: '#d4d4d8',
                                400: '#a1a1aa',
                                500: '#71717a',
                                600: '#52525b',
                                700: '#3f3f46',
                                800: '#27272a',
                                900: '#18181b',
                            },
                            gray: {
                                DEFAULT: '#E0E0E0', // Gris claro
                                50: '#f9fafb',
                                100: '#f3f4f6',
                                200: '#e5e7eb',
                                300: '#d1d5db',
                                400: '#9ca3af',
                                500: '#6b7280',
                                600: '#4b5563',
                                700: '#374151',
                                800: '#1f2937',
                                900: '#111827',
                            },
                        },
                        fontFamily: {
                            sans: ['Instrument Sans', 'sans-serif'],
                        },
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-in-out',
                            'slide-up': 'slideUp 0.5s ease-out',
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': { opacity: '0' },
                                '100%': { opacity: '1' },
                            },
                            slideUp: {
                                '0%': { transform: 'translateY(20px)', opacity: '0' },
                                '100%': { transform: 'translateY(0)', opacity: '1' },
                            },
                        },
                    },
                },
            }
        </script>
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #22572D 0%, #1a4725 100%);
            }
            .service-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
            }
            .btn-primary {
                background: linear-gradient(135deg, #E5C300 0%, #d4b200 100%);
                color: #000000;
            }
            .btn-primary:hover {
                background: linear-gradient(135deg, #d4b200 0%, #c2a100 100%);
            }
            .btn-secondary {
                background-color: rgba(229, 195, 0, 0.1);
                color: #E5C300;
                border: 1px solid #E5C300;
            }
            .btn-secondary:hover {
                background-color: rgba(229, 195, 0, 0.2);
            }
            .border-custom {
                border-color: #000000;
            }
            .bg-custom-gray {
                background-color: #E0E0E0;
            }
        </style>
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
        <!-- Header/Navigation -->
        <header class="w-full py-4 px-6 lg:px-8 bg-primary-900">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between max-w-7xl mx-auto">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-secondary-500">Mesa de trámites</span>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md font-medium text-secondary-500 hover:bg-primary-800 transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-md font-medium text-secondary-500 hover:bg-primary-800 transition-colors">
                                Iniciar Sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-secondary-500 text-black rounded-md font-medium hover:bg-secondary-600 transition-colors">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <section class="gradient-bg text-white py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center">
                    <div class="lg:w-1/2 mb-10 lg:mb-0 animate-fade-in">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Simplificamos tus trámites administrativos</h1>
                        <p class="text-xl mb-8 opacity-90">Accede a todos los servicios de trámites en un solo lugar. Rápido, seguro y fácil de usar.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary px-6 py-3 rounded-lg font-semibold text-center transition-all hover:shadow-lg">
                                    Ir al Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-lg font-semibold text-center transition-all hover:shadow-lg">
                                    Iniciar Sesión
                                </a>
                                <a href="{{ route('register') }}" class="btn-secondary px-6 py-3 rounded-lg font-semibold text-center transition-all hover:shadow-lg">
                                    Registrarse
                                </a>
                            @endauth
                        </div>
                    </div>
                    <div class="lg:w-1/2 animate-slide-up">
                        <div class="bg-custom-gray rounded-xl shadow-xl border-4 border-black border-opacity-20 p-2">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="Tramites simplificados" class="rounded-lg w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Services -->
        <section class="py-16 md:py-24 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Servicios destacados</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Nuestra plataforma ofrece todo lo que necesitas para gestionar tus trámites de manera eficiente</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Service Card 1 -->
                    <div class="service-card bg-white dark:bg-gray-700 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-custom">
                        <div class="w-12 h-12 bg-secondary-100 dark:bg-secondary-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-secondary-500 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Trámites en línea</h3>
                        <p class="text-gray-600 dark:text-gray-300">Realiza tus trámites sin salir de casa, de manera rápida y segura desde cualquier dispositivo.</p>
                    </div>
                    
                    <!-- Service Card 2 -->
                    <div class="service-card bg-white dark:bg-gray-700 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-custom">
                        <div class="w-12 h-12 bg-secondary-100 dark:bg-secondary-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-secondary-500 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Gestión de citas</h3>
                        <p class="text-gray-600 dark:text-gray-300">Agenda y gestiona tus citas previas con las administraciones públicas de forma sencilla.</p>
                    </div>
                    
                    <!-- Service Card 3 -->
                    <div class="service-card bg-white dark:bg-gray-700 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-custom">
                        <div class="w-12 h-12 bg-secondary-100 dark:bg-secondary-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-secondary-500 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Notificaciones</h3>
                        <p class="text-gray-600 dark:text-gray-300">Recibe alertas sobre el estado de tus trámites y documentos importantes en tiempo real.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 md:py-24 bg-gray-100 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center">
                    <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                        <div class="bg-custom-gray rounded-xl shadow-xl border-4 border-black border-opacity-20 p-2">
                            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80" alt="Características" class="rounded-lg w-full h-auto">
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">Por qué elegirnos</h2>
                        
                        <div class="space-y-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-secondary-500 text-black">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Ahorra tiempo</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-300">Evita filas y esperas innecesarias realizando tus trámites en minutos desde cualquier lugar.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-secondary-500 text-black">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Seguridad garantizada</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-300">Tus datos están protegidos con los más altos estándares de seguridad y encriptación.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-md bg-secondary-500 text-black">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Soporte 24/7</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-300">Nuestro equipo está disponible para ayudarte en cualquier momento que lo necesites.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="gradient-bg text-white py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">¿Listo para facilitar tus trámites?</h2>
                <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90">Regístrate ahora y descubre cómo podemos hacer tu vida más fácil.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary px-8 py-3 rounded-lg font-semibold text-lg transition-all hover:shadow-lg">
                            Ir al Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-lg font-semibold text-lg transition-all hover:shadow-lg">
                            Registrarse Gratis
                        </a>
                        <a href="{{ route('login') }}" class="btn-secondary px-8 py-3 rounded-lg font-semibold text-lg transition-all hover:shadow-lg">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-primary-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <svg class="w-8 h-8 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span class="ml-2 text-xl font-bold text-secondary-500">Mesa de trámites</span>
                        </div>
                        <p class="text-gray-300">Simplificamos tus trámites administrativos para que puedas enfocarte en lo que realmente importa.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-secondary-500">Servicios</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Trámites en línea</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Gestión de citas</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Notificaciones</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Documentación</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-secondary-500">Compañía</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Sobre nosotros</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Contacto</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Términos</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacidad</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-secondary-500">Contacto</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +123 456 7890
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                info@mesadotramites.com
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Av. Principal 123, Ciudad
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-primary-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-300">© 2023 Mesa de trámites. Todos los derechos reservados.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-300 hover:text-secondary-500 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-secondary-500 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-secondary-500 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>