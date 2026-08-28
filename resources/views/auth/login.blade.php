@extends('layouts.guest')

@section('title', 'Ingresar')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('contenido')

<div class="contenedor-auth">
    <!-- Left Side: Promo Panel (Desktop only) -->
    <div class="auth-promo-panel">
        <div class="promo-content">
            <a href="index.php" class="promo-logo" style="color: white; text-decoration: none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                </svg>
                <span>Talento<span>ES</span></span>
            </a>
            <h1>Conecta con el futuro profesional</h1>
            <p>La plataforma líder en El Salvador para encontrar el talento idóneo o el empleo de tus sueños.</p>
            <div class="promo-features">
                <div class="promo-feature">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Conexión directa entre talento y empresas</span>
                </div>
                <div class="promo-feature">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Búsqueda avanzada y perfiles optimizados</span>
                </div>
                <div class="promo-feature">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Plataforma 100% segura y verificada</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Form Panel -->
    <div class="auth-form-panel">
        <!-- Top bar (Mobile only) -->
        <div class="topbar">
            <button class="topbar-back" aria-label="Volver" onclick="location.href='index.php'">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span class="topbar-brand">Talento<span>ES</span></span>
            </button>
        </div>

        <div class="auth-card-wrapper">
            <!-- Hero -->
            <div class="hero">
                <div class="hero-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                </div>
                <h2>Bienvenido de nuevo</h2>
                <p>Ingresa tus credenciales para acceder a tu cuenta.</p>
            </div>

            <!-- Form card -->
            <div class="card" id="form-card">
                <!-- Formulario -->
                <form method="POST" action="{{ route('login') }}">
                @csrf

                    <div class="form-body">
                         <!-- Correo -->
                        <div class="field">
                            <label for="email">Correo electrónico <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="icon" aria-hidden="true">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    placeholder="ejemplo@correo.com"
                                    class="{{ $errors->has('email') ? 'error-field' : '' }}"
                                >
                            </div>
                            @error('email')
                                <span class="field-error visible" id="err-email">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                         <!-- Password -->
                        <div class="field">
                            <label for="password">Tu contraseña<span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="icon" aria-hidden="true">
                                    <i class="bi bi-person-fill-lock"></i>
                                </span>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Ingresa tu contraseña"
                                    class="{{ $errors->has('password') ? 'error-field' : '' }}"
                                >
                            </div>
                            @error('password')
                                <span class="field-error visible" id="err-password">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="btn-primary">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>

            <!-- Registro Link -->
            <p class="registro-link">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}">Regístrate</a>
            </p>
        </div>
    </div>
</div>



@endsection
