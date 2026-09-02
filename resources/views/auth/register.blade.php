@extends('layouts.guest')

@section('title', 'Registro')

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

        <div class="auth-card-wrapper">
            <!-- Hero -->
            <div class="hero">
                <h2>Crea tu cuenta</h2>
                <p>Únete a la mayor red de oportunidades profesionales en El Salvador.</p>
            </div>

            <!-- Form card -->
            <div class="card" id="form-card">
                <!-- FORM -->
                <form method="POST" action="{{ route('register') }}" id="register-form">
                @csrf

                    <div class="form-body">
                        <div class="form-panel active" id="panel-candidato" role="tabpanel" aria-labelledby="tab-candidato">

                            <!-- Nombre -->
                            <div class="field">
                                <label for="name">Nombre <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        placeholder="Tu nombre"
                                        autocomplete="name"
                                        maxlength="100"
                                        class="{{ $errors->has('name') ? 'error-field' : '' }}"
                                        value="{{ old('name') }}"
                                    >
                                </div>
                                @error('name')
                                    <span class="field-error visible" id="err-name">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Apellido -->
                            <div class="field">
                                <label for="lastName">Apellido <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="lastName"
                                        name="lastName"
                                        placeholder="Tu apellido"
                                        autocomplete="lastName"
                                        maxlength="100"
                                        class="{{ $errors->has('lastName') ? 'error-field' : '' }}"
                                        value="{{ old('lastName') }}"
                                    >
                                </div>
                                @error('lastName')
                                    <span class="field-error visible" id="err-lastName">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="field">
                                <label for="email">Correo Electrónico <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <i class="bi bi-envelope-fill"></i>
                                    </span>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        placeholder="Tu correo electrónico"
                                        autocomplete="email"
                                        maxlength="100"
                                        class="{{ $errors->has('email') ? 'error-field' : '' }}"
                                        value="{{ old('email') }}"
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
                                <label for="password">Crea tu contraseña <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <i class="bi bi-person-fill-lock"></i>
                                    </span>
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="Tu contraseña"
                                        autocomplete="password"
                                        maxlength="100"
                                        class="{{ $errors->has('password') ? 'error-field' : '' }}"
                                        value="{{ old('password') }}"
                                    >
                                </div>
                                @error('password')
                                    <span class="field-error visible" id="err-password">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Password confirmar-->
                            <div class="field">
                                <label for="password_confirmation">Confirma tu contraseña <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <i class="bi bi-person-fill-lock"></i>
                                    </span>
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Confirma tu contraseña"
                                        autocomplete="password"
                                        maxlength="100"
                                        class="{{ $errors->has('password_confirmation') ? 'error-field' : '' }}"
                                        value="{{ old('password_confirmation') }}"
                                    >
                                </div>
                                @error('password_confirmation')
                                    <span class="field-error visible" id="err-password_confirmation">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-primary" id="btn-submit">
                            Registrarse
                        </button>

                    </div>
                </form>
            </div>

            <!-- Login Link -->
            <div class="login-row">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</div>


@endsection



