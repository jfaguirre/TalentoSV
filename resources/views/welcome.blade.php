@extends('layouts.guest')
@section('title', 'TalentoSV')

@push('styles')
    @vite(['resources/css/landing.css'])
@endpush

@section('contenido')

    <!-- Ambient Glow Backgrounds -->
    <div class="relative overflow-hidden min-h-screen bg-grid">
        <div class="blur-circle blur-circle-primary w-96 h-96 -top-20 -left-20"></div>
        <div class="blur-circle blur-circle-secondary w-96 h-96 top-1/3 -right-20"></div>

        <!-- 1. Header / Navbar -->
        <header id="main-navbar" class="fixed top-0 left-0 right-0 z-50 py-5 transition-all duration-300 glass-nav" x-data="{ mobileMenuOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0F52BA] to-[#1E6FE0] flex items-center justify-center shadow-md shadow-[#0F52BA]/20">
                            <span class="text-white font-extrabold text-xl tracking-tight">T</span>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight text-[#0F172A]">Talento<span class="text-[#0F52BA]">SV</span></span>
                    </div>

                    <!-- Desktop Nav Links -->
                    <nav class="hidden md:flex items-center gap-8">
                        <a href="#inicio" class="btn-tertiary text-sm font-semibold">Inicio</a>
                        <a href="#roles" class="btn-tertiary text-sm font-semibold">Perfiles</a>
                        <a href="#empleos" class="btn-tertiary text-sm font-semibold">Plazas Recientes</a>
                        <a href="#estadisticas" class="btn-tertiary text-sm font-semibold">Impacto</a>
                    </nav>

                    <!-- Authentication / Actions (Desktop) -->
                    <div class="hidden md:flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-secondary text-sm py-2 px-4">
                                    Panel de Control
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-tertiary text-sm font-semibold">
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary text-sm py-2 px-5 shadow-sm">
                                        Crear Cuenta
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Burger Button (Mobile) -->
                    <div class="md:hidden flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-[#0F172A] p-2 hover:bg-[#F1F5F9] rounded-lg transition-colors" aria-label="Abrir menú">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="!mobileMenuOpen">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="mobileMenuOpen" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="md:hidden glass-nav border-t border-[#E2E8F0] px-4 pt-4 pb-6 space-y-3 absolute top-full left-0 right-0 shadow-lg"
                 style="display: none;">
                <a href="#inicio" @click="mobileMenuOpen = false" class="block py-2 text-base font-medium text-[#334155] hover:text-[#0F52BA]">Inicio</a>
                <a href="#roles" @click="mobileMenuOpen = false" class="block py-2 text-base font-medium text-[#334155] hover:text-[#0F52BA]">Perfiles</a>
                <a href="#empleos" @click="mobileMenuOpen = false" class="block py-2 text-base font-medium text-[#334155] hover:text-[#0F52BA]">Plazas Recientes</a>
                <a href="#estadisticas" @click="mobileMenuOpen = false" class="block py-2 text-base font-medium text-[#334155] hover:text-[#0F52BA]">Impacto</a>

                <div class="h-px bg-[#E2E8F0] my-4"></div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" @click="mobileMenuOpen = false" class="block w-full text-center btn-primary">
                            Panel de Control
                        </a>
                    @else
                        <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block w-full text-center py-2.5 text-[#334155] font-semibold hover:text-[#0F52BA]">
                            Iniciar Sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block w-full text-center btn-primary mt-2">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>

        <!-- 2. Hero Section -->
        <section id="inicio" class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
            <!-- Centered Layout Container -->
            <div class="max-w-4xl mx-auto text-center space-y-8 animate-fade-in-up">
                <!-- Salvadoran badge -->
                <div class="inline-flex items-center gap-1.5 bg-[#EEF4FF] border border-[#ADC8FF] px-3 py-1 rounded-full text-xs font-semibold text-[#0F52BA] mx-auto">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 2L2 22h20L12 2z" stroke-linejoin="round" />
                    </svg>
                    <span>Portal Oficial de Empleabilidad - El Salvador</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-[#0F172A] leading-tight">
                    Conectando el <span class="text-gradient-primary">Talento Local</span> con el Crecimiento
                </h1>

                <p class="text-lg text-[#64748B] max-w-2xl mx-auto font-medium">
                    TalentoSV es la plataforma diseñada para acelerar tu desarrollo. Encuentra ofertas laborales personalizadas o recluta al talento ideal para tu negocio en El Salvador.
                </p>

                <!-- Search Engine Container -->
                <div class="search-container mt-8 max-w-3xl mx-auto">
                    <form action="#" method="GET" class="flex flex-col md:flex-row gap-2">
                        <!-- Cargo/Keyword input -->
                        <div class="flex-1 flex items-center px-3 py-2 border-b md:border-b-0 md:border-r border-[#E2E8F0]">
                            <svg class="w-5 h-5 text-[#64748B] mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" placeholder="Puesto, habilidad o empresa..." class="w-full bg-transparent border-0 focus:ring-0 text-[#0F172A] placeholder-[#64748B] text-sm focus:outline-none" />
                        </div>

                        <!-- Department Selector (El Salvador) -->
                        <div class="flex-1 flex items-center px-3 py-2 border-b md:border-b-0 md:border-r border-[#E2E8F0]">
                            <svg class="w-5 h-5 text-[#64748B] mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <select class="w-full bg-transparent border-0 focus:ring-0 text-[#0F172A] text-sm focus:outline-none appearance-none">
                                <option value="">Todo El Salvador</option>
                                <option value="san-salvador">San Salvador</option>
                                <option value="la-libertad">La Libertad</option>
                                <option value="santa-ana">Santa Ana</option>
                                <option value="san-miguel">San Miguel</option>
                                <option value="sonsonate">Sonsonate</option>
                                <option value="usulutan">Usulután</option>
                                <option value="ahuachapan">Ahuachapán</option>
                                <option value="la-paz">La Paz</option>
                            </select>
                        </div>

                        <!-- Search Button -->
                        <button type="submit" class="btn-primary md:w-auto w-full py-3 px-6 shrink-0">
                            <span>Buscar</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Dual CTAs -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                    <a href="#roles" class="btn-primary shadow-[#0F52BA]/15">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Busco Empleo</span>
                    </a>
                    <a href="#roles" class="btn-secondary">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>Busco Talento</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- 3. Roles Section (Admin, Candidate, Employer) -->
        <section id="roles" class="py-24 bg-white relative z-10 border-t border-[#E2E8F0]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">
                        Un Rol Adaptado a Cada <span class="text-[#0F52BA]">Necesidad</span>
                    </h2>
                    <p class="text-base text-[#64748B] font-medium">
                        Nuestra plataforma ofrece herramientas especializadas para cada actor clave dentro del ecosistema laboral de El Salvador.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- 3.1 Usuario Cliente (Candidato) -->
                    <div class="talento-card role-card-candidato p-8 flex flex-col justify-between">
                        <div>
                            <!-- Header Icon -->
                            <div class="w-12 h-12 rounded-2xl bg-[#EEF4FF] flex items-center justify-center text-[#0F52BA] mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#0F172A] mb-3">Usuario Cliente</h3>
                            <p class="text-sm text-[#64748B] leading-relaxed mb-6 font-medium">
                                Potencia tu perfil profesional en El Salvador. Sube tu currículum, realiza postulaciones ágiles y recibe alertas automatizadas que encajen perfectamente con tu experiencia.
                            </p>

                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Creación de CV Dinámico</span>
                                </li>
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Postulación rápida en 1-Click</span>
                                </li>
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Recomendaciones por Inteligencia Artificial</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register') }}" class="btn-primary w-full text-center py-3">
                            Comenzar como Candidato
                        </a>
                    </div>

                    <!-- 3.2 Empresario (Empleador) -->
                    <div class="talento-card role-card-empresario p-8 flex flex-col justify-between">
                        <div>
                            <!-- Header Icon -->
                            <div class="w-12 h-12 rounded-2xl bg-[#EEF4FF] flex items-center justify-center text-[#1E6FE0] mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#0F172A] mb-3">Empresario</h3>
                            <p class="text-sm text-[#64748B] leading-relaxed mb-6 font-medium">
                                Simplifica los procesos de reclutamiento de tu empresa. Publica ofertas masivas, accede a una base de datos calificada y gestiona candidatos de principio a fin con nuestro panel (ATS).
                            </p>

                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Publicación de Ofertas Ilimitadas</span>
                                </li>
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Panel ATS para filtrar CVs</span>
                                </li>
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Acceso inmediato a Talentos Locales</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register') }}?type=employer" class="btn-secondary w-full text-center py-3">
                            Registrar mi Empresa
                        </a>
                    </div>

                    <!-- 3.3 Administrador (Superusuario) -->
                    <div class="talento-card role-card-admin p-8 flex flex-col justify-between">
                        <div>
                            <!-- Header Icon -->
                            <div class="w-12 h-12 rounded-2xl bg-[#F1F5F9] flex items-center justify-center text-[#0F172A] mb-6 shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#0F172A] mb-3">Admin Portal</h3>
                            <p class="text-sm text-[#64748B] leading-relaxed mb-6 font-medium">
                                El corazón de control de TalentoSV. Los administradores validan empresas registradas, supervisan actividades y moderan contenido para asegurar una plataforma transparente y segura.
                            </p>

                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Verificación y validación de empresas</span>
                                </li>
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Auditoría de ofertas y seguridad</span>
                                </li>
                                <li class="flex items-center gap-2.5 text-sm text-[#334155]">
                                    <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Estadísticas globales de la plataforma</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('login') }}" class="text-center py-3 font-semibold text-[#0F172A] border border-[#CBD5E1] rounded-md hover:bg-[#F8FAFC] transition-colors w-full inline-block">
                            Acceso Administrativo
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Stats Section -->
        <section id="estadisticas" class="py-20 relative z-10 bg-[#EEF4FF]/50 border-t border-b border-[#E2E8F0]">
            <div id="stats-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 text-center">
                    <!-- Stat 1 -->
                    <div class="stat-item px-8 py-4">
                        <div class="text-4xl sm:text-5xl font-extrabold text-[#0F52BA] mb-2 stat-number" data-target="15200">0</div>
                        <div class="text-sm text-[#64748B] font-semibold uppercase tracking-wider">Candidatos Registrados</div>
                    </div>
                    <!-- Stat 2 -->
                    <div class="stat-item px-8 py-4">
                        <div class="text-4xl sm:text-5xl font-extrabold text-[#0F52BA] mb-2 stat-number" data-target="850">0</div>
                        <div class="text-sm text-[#64748B] font-semibold uppercase tracking-wider">Empresas Activas</div>
                    </div>
                    <!-- Stat 3 -->
                    <div class="stat-item px-8 py-4">
                        <div class="text-4xl sm:text-5xl font-extrabold text-[#0F52BA] mb-2 stat-number" data-target="2450">0</div>
                        <div class="text-sm text-[#64748B] font-semibold uppercase tracking-wider">Ofertas Publicadas</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Latest Jobs Section -->
        <section id="empleos" class="py-24 bg-white relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div class="space-y-4">
                        <h2 class="text-3xl font-extrabold text-[#0F172A] tracking-tight">
                            Plazas <span class="text-[#0F52BA]">Destacadas</span> Recientes
                        </h2>
                        <p class="text-base text-[#64748B] max-w-2xl font-medium">
                            Echa un vistazo a las vacantes más recientes publicadas por empresas salvadoreñas verificadas.
                        </p>
                    </div>
                    <a href="{{ route('register') }}" class="btn-secondary py-2.5 shrink-0">
                        Ver todas las ofertas
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Job Card 1 -->
                    <div class="talento-card p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-l-4 border-l-[#0F52BA]">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="badge badge-primary">Tecnología</span>
                                <span class="badge badge-success">Remoto</span>
                            </div>
                            <h3 class="text-lg font-bold text-[#0F172A] hover:text-[#0F52BA] transition-colors cursor-pointer">
                                Desarrollador Fullstack Senior (Laravel & Vue.js)
                            </h3>
                            <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-[#64748B]">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    TechSV S.A. de C.V.
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    San Salvador, El Salvador
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V7" />
                                    </svg>
                                    $1,600 - $2,200 / mes
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-full md:w-auto justify-between border-t md:border-t-0 pt-4 md:pt-0 border-[#F1F5F9]">
                            <span class="text-xs text-[#94A3B8] font-medium">Publicado hace 2 días</span>
                            <a href="{{ route('register') }}" class="btn-primary py-2 px-4 text-xs font-bold rounded-lg shadow-none">
                                Postularse
                            </a>
                        </div>
                    </div>

                    <!-- Job Card 2 -->
                    <div class="talento-card p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-l-4 border-l-[#1E6FE0]">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="badge badge-neutral">Ventas</span>
                                <span class="badge badge-primary">Híbrido</span>
                            </div>
                            <h3 class="text-lg font-bold text-[#0F172A] hover:text-[#0F52BA] transition-colors cursor-pointer">
                                Ejecutivo de Cuentas Corporativas
                            </h3>
                            <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-[#64748B]">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    El Salvador Financial Group
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    La Libertad, Antiguo Cuscatlán
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V7" />
                                    </svg>
                                    $900 - $1,300 / mes
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-full md:w-auto justify-between border-t md:border-t-0 pt-4 md:pt-0 border-[#F1F5F9]">
                            <span class="text-xs text-[#94A3B8] font-medium">Publicado hace 4 días</span>
                            <a href="{{ route('register') }}" class="btn-primary py-2 px-4 text-xs font-bold rounded-lg shadow-none">
                                Postularse
                            </a>
                        </div>
                    </div>

                    <!-- Job Card 3 -->
                    <div class="talento-card p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-l-4 border-l-[#334155]">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="badge badge-neutral">Diseño</span>
                                <span class="badge badge-neutral">Presencial</span>
                            </div>
                            <h3 class="text-lg font-bold text-[#0F172A] hover:text-[#0F52BA] transition-colors cursor-pointer">
                                Diseñador UX/UI UI Senior
                            </h3>
                            <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-[#64748B]">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Creativos SV
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    Santa Ana, El Salvador
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#94A3B8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V7" />
                                    </svg>
                                    $800 - $1,100 / mes
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-full md:w-auto justify-between border-t md:border-t-0 pt-4 md:pt-0 border-[#F1F5F9]">
                            <span class="text-xs text-[#94A3B8] font-medium">Publicado hace 1 semana</span>
                            <a href="{{ route('register') }}" class="btn-primary py-2 px-4 text-xs font-bold rounded-lg shadow-none">
                                Postularse
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Footer Section -->
        <footer class="bg-[#0F172A] text-white pt-16 pb-8 border-t border-[#1E293B]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
                    <!-- Column 1: Brand -->
                    <div class="md:col-span-5 space-y-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-[#0F52BA] flex items-center justify-center">
                                <span class="text-white font-extrabold text-lg">T</span>
                            </div>
                            <span class="text-xl font-bold tracking-tight">Talento<span class="text-[#0F52BA]">SV</span></span>
                        </div>
                        <p class="text-xs text-[#CBD5E1] max-w-sm leading-relaxed">
                            Plataforma integral orientada a la empleabilidad y reclutamiento local en El Salvador. Conectamos candidatos calificados con empresas líderes.
                        </p>
                    </div>

                    <!-- Column 2: Candidates -->
                    <div class="md:col-span-2 space-y-3">
                        <h4 class="text-sm font-bold tracking-wide uppercase text-[#CBD5E1]">Candidatos</h4>
                        <ul class="space-y-2 text-xs text-[#94A3B8]">
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Crear Perfil</a></li>
                            <li><a href="#empleos" class="hover:text-white transition-colors">Buscar Empleos</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Iniciar Sesión</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Businesses -->
                    <div class="md:col-span-2 space-y-3">
                        <h4 class="text-sm font-bold tracking-wide uppercase text-[#CBD5E1]">Empresarios</h4>
                        <ul class="space-y-2 text-xs text-[#94A3B8]">
                            <li><a href="{{ route('register') }}?type=employer" class="hover:text-white transition-colors">Publicar Ofertas</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Acceso Empresas</a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Administrator Portal -->
                    <div class="md:col-span-3 space-y-3">
                        <h4 class="text-sm font-bold tracking-wide uppercase text-[#CBD5E1]">Administración</h4>
                        <p class="text-xs text-[#94A3B8]">Acceso exclusivo para administradores y auditores de TalentoSV.</p>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0F52BA] hover:text-[#1E6FE0] transition-colors">
                            <span>Ingresar al Portal Admin</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Footer Divider -->
                <div class="h-px bg-[#1E293B] my-8"></div>

                <!-- Footer Bottom -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#94A3B8]">
                    <span>&copy; {{ date('Y') }} TalentoSV. Todos los derechos reservados.</span>
                    <div class="flex items-center gap-6">
                        <a href="#" class="hover:text-white transition-colors">Términos de Servicio</a>
                        <a href="#" class="hover:text-white transition-colors">Política de Privacidad</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @push('scripts')
        @vite(['resources/js/landing.js'])
    @endpush
@endsection

