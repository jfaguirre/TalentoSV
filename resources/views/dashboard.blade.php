<x-app-layout>
    @php
        $user = Auth::user();
        $name = $user->name ?? 'Usuario';
        $lastName = $user->lastName ?? '';
        $fullName = trim($name . ' ' . $lastName);
    @endphp

    <!-- Greeting Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-[#0F172A] tracking-tight flex items-center gap-2">
            Hola, <span class="text-[#0F52BA]">{{ $fullName }}</span> 👏
        </h1>
        <p class="text-[#64748B] text-sm md:text-base mt-1">
            Bienvenido a tu panel de control. Aquí tienes las ofertas disponibles.
        </p>
    </div>

    <!-- Cards Section Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Location Card: La Paz (Main.css Border #E2E8F0, Primary Accent #0F52BA) -->
        <div class="bg-white rounded-2xl shadow-sm border border-[#E2E8F0] p-5 relative overflow-hidden transition-all duration-200 hover:shadow-md hover:border-[#ADC8FF] max-w-sm">
            <!-- Top Primary Gradient Accent Line (Main.css #0F52BA to #1E6FE0) -->
            <div class="h-1 bg-gradient-to-r from-[#0F52BA] to-[#1E6FE0] absolute top-0 left-0 right-0"></div>

            <div class="flex items-start gap-3 mt-1">
                <!-- Location Pin Icon (Main.css Primary #0F52BA) -->
                <div class="text-[#0F52BA] shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.487-.445 2.184a.5.5 0 0 1-.722.116l-2.5-1.875-2.586 2.586a.5.5 0 0 1-.707-.707l2.586-2.586-1.875-2.5a.5.5 0 0 1 .116-.722c.697-.413 1.482-.491 2.184-.445.344.023.688.082 1.013.16l3.134-3.134a2.91 2.91 0 0 1-.039-.46c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z"/>
                    </svg>
                </div>

                <div>
                    <h3 class="font-bold text-[#0F172A] text-base leading-snug">La Paz</h3>
                    <p class="text-xs text-[#64748B] mt-1 font-medium">1 ofertas de trabajo</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
