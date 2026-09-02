<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TalentoSV') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] min-h-screen text-[#1E293B]">
        @php
            $user = Auth::user();
            $name = $user->name ?? 'Usuario';
            $lastName = $user->lastName ?? '';
            $firstInitial = strtoupper(substr(trim($name), 0, 1));
            $secondInitial = $lastName ? strtoupper(substr(trim($lastName), 0, 1)) : (strlen(trim($name)) > 1 ? strtoupper(substr(trim($name), 1, 1)) : '');
            $initials = $firstInitial . $secondInitial;
            $fullName = trim($name . ' ' . $lastName);
        @endphp

        <div x-data="{ sidebarOpen: false }" class="min-h-screen flex flex-col">
            <!-- Top Header Navbar -->
            <header class="bg-[#0F172A] border-b border-[#1E293B] text-white h-16 flex items-center justify-between px-4 md:px-6 sticky top-0 z-30 shadow-sm">
                <div class="flex items-center gap-3">
                    <!-- Mobile Hamburger Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-[#CBD5E1] hover:text-white p-1 focus:outline-none">
                        <i class="bi bi-list text-2xl"></i>
                    </button>

                    <!-- Brand Logo -->
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight text-white flex items-center">
                        Talento<span class="text-[#1E6FE0]">ES</span>
                    </a>
                </div>

                <!-- Top Right Profile Initials Circle -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#0F52BA] text-white font-bold text-sm flex items-center justify-center shadow-md">
                        {{ $initials }}
                    </div>
                </div>
            </header>

            <div class="flex flex-1">
                <!-- Mobile Backdrop Overlay -->
                <div x-show="sidebarOpen" 
                     @click="sidebarOpen = false" 
                     x-transition:enter="transition-opacity ease-linear duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-black/50 z-40 md:hidden"
                     style="display: none;">
                </div>

                <!-- Left Sidebar Navigation -->
                <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                       class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-[#0F172A] text-[#CBD5E1] flex flex-col justify-between p-4 transition-transform duration-200 ease-in-out md:translate-x-0 min-h-[calc(100vh-4rem)] border-r border-[#1E293B] shrink-0">
                    
                    <div>
                        <!-- User Profile Info Section inside Sidebar -->
                        <div class="flex items-center gap-3 px-2 py-3 border-b border-[#1E293B] mb-2">
                            <div class="w-10 h-10 rounded-full bg-[#0F52BA] text-white font-bold text-lg flex items-center justify-center shadow-md shrink-0">
                                {{ $firstInitial }}
                            </div>
                            <div class="overflow-hidden">
                                <h3 class="font-bold text-white text-sm truncate leading-tight">{{ $fullName }}</h3>
                                <p class="text-xs text-[#64748B] font-normal">usuario</p>
                            </div>
                        </div>

                        <!-- Sidebar Nav Component -->
                        <x-sidebar-usuario />
                    </div>

                    <!-- Bottom Logout Link -->
                    <div class="pt-4 mt-6 border-t border-[#1E293B]">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left text-[#DC2626] hover:text-red-400 hover:bg-red-500/10 rounded-xl px-3.5 py-2.5 flex items-center gap-3 text-sm font-medium transition duration-150">
                                <i class="bi bi-box-arrow-left text-[#DC2626] text-base shrink-0"></i>
                                <span>Cerrar sesión</span>
                            </button>
                        </form>
                    </div>
                </aside>

                <!-- Main Page Content -->
                <main class="flex-1 p-6 md:p-10 overflow-y-auto bg-[#F8FAFC]">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
