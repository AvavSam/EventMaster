@props(['title', 'section_title' => 'Menu'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title }} - EventMaster</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <div x-data="{ isSidebarOpen: false }" class="min-h-screen">
        <!-- Backdrop -->
        <div
            x-show="isSidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-transparent bg-opacity-75 z-20 md:hidden"
            @click="isSidebarOpen = false"
        ></div>

        <!-- Sidebar -->
        <aside
            x-cloak
            :class="{'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen}"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 overflow-y-auto md:translate-x-0"
        >
            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-4 bg-gray-900">
                <div class="flex items-center space-x-2">
                    <i data-lucide="calendar" class="text-blue-400 w-6 h-6"></i>
                    <span class="text-xl font-bold text-white">EventMaster</span>
                </div>
                <button
                    @click="isSidebarOpen = false"
                    class="md:hidden text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="mt-4 px-2 space-y-1">
                {{-- Dashboard untuk Admin & User --}}
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                   class="{{ auth()->user()->role === 'admin'
                             ? (request()->routeIs('admin.dashboard')
                                ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                : 'text-gray-300 hover:bg-gray-700 hover:text-white')
                             : (request()->routeIs('user.dashboard')
                                ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                : 'text-gray-300 hover:bg-gray-700 hover:text-white') }}
                        flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                @can('admin')
                    {{-- Menu Admin --}}
                    <a href="{{ route('admin.events.index') }}"
                       class="{{ request()->is('admin/events*')
                                 ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                            flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        <span>Events</span>
                    </a>
                    <a href="{{ route('admin.buyers.index') }}"
                       class="{{ request()->is('admin/buyers*')
                                 ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                            flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Buyers</span>
                    </a>
                    <a href="{{ route('admin.purchases.index') }}"
                       class="{{ request()->is('admin/purchases*')
                                 ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                            flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        <span>Purchases</span>
                    </a>
                @else
                    {{-- Menu User --}}
                    <a href="{{ route('user.events.index') }}"
                       class="{{ request()->is('user/events*')
                                 ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                            flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        <span>Events</span>
                    </a>
                    <a href="{{ route('user.dashboard') }}"
                       class="{{ request()->routeIs('user.dashboard')
                                 ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                            flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                        <i data-lucide="ticket" class="w-5 h-5"></i>
                        <span>My Tickets</span>
                    </a>
                    <a href="{{ route('user.profile.edit') }}"
                       class="{{ request()->is('user/profile*')
                                 ? 'bg-gray-700 text-blue-400 border-l-4 border-blue-400'
                                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}
                            flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out">
                        <i data-lucide="user" class="w-5 h-5"></i>
                        <span>Profile</span>
                    </a>
                @endcan
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="md:ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button
                            @click="isSidebarOpen = !isSidebarOpen"
                            class="md:hidden text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                        <h1 class="text-lg font-semibold text-gray-800 truncate">{{ $section_title }}</h1>
                    </div>

                    <div class="flex items-center gap-4">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors duration-150 ease-in-out">
                                <span class="text-sm font-medium">Logout</span>
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 focus:outline-none">
                <div class="py-6">
                    <div class="px-4 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
