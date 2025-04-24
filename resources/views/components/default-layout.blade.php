@props(['title', 'section_title' => 'Menu'])
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }} - EventMaster</title>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white h-full flex-shrink-0 hidden md:block">
      <!-- Logo -->
      <div class="px-6 py-4 border-b border-gray-700">
        <div class="flex items-center space-x-2">
          <i data-lucide="calendar" class="text-blue-400" size="24"></i>
          <span class="text-xl font-bold">EventMaster</span>
        </div>
      </div>

      <!-- Menu -->
      <nav class="py-4">
        <ul class="space-y-1">
          <li>
            <a href="#"
              class="flex items-center space-x-3 px-6 py-3 bg-gray-700 text-blue-400 border-l-4 border-blue-400">
              <i data-lucide="layout-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
              <i data-lucide="calendar"></i>
              <span>Events</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
              <i data-lucide="users"></i>
              <span>Buyers</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
              <i data-lucide="shopping-cart"></i>
              <span>Purchases</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
              <i data-lucide="bar-chart-3"></i>
              <span>Reports</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Mobile Sidebar -->
    <div x-data="{ isOpen: false }" class="md:hidden">
      <!-- Mobile menu button -->
      <button @click="isOpen = true"
        class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
        <i data-lucide="menu"></i>
      </button>

      <!-- Mobile sidebar -->
      <div x-show="isOpen" class="fixed inset-0 z-50 md:hidden" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="isOpen = false"></div>

        <!-- Sidebar panel -->
        <div class="fixed inset-y-0 left-0 flex flex-col w-64 bg-gray-800">
          <div class="px-4 py-4 flex items-center justify-between border-b border-gray-700">
            <div class="flex items-center space-x-2">
              <i data-lucide="calendar" class="text-blue-400"></i>
              <span class="text-xl font-bold text-white">EventMaster</span>
            </div>
            <button class="text-gray-400 hover:text-white" @click="isOpen = false">
              <i data-lucide="x"></i>
            </button>
          </div>

          <nav class="py-4">
            <ul class="space-y-1">
              <li>
                <a href="#"
                  class="flex items-center space-x-3 px-6 py-3 bg-gray-700 text-blue-400 border-l-4 border-blue-400">
                  <i data-lucide="layout-dashboard"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li>
                <a href="#"
                  class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                  <i data-lucide="calendar"></i>
                  <span>Events</span>
                </a>
              </li>
              <li>
                <a href="#"
                  class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                  <i data-lucide="users"></i>
                  <span>Buyers</span>
                </a>
              </li>
              <li>
                <a href="#"
                  class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                  <i data-lucide="shopping-cart"></i>
                  <span>Purchases</span>
                </a>
              </li>
              <li>
                <a href="#"
                  class="flex items-center space-x-3 px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                  <i data-lucide="bar-chart-3"></i>
                  <span>Reports</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
      <!-- Navbar -->
      <nav class="bg-white px-6 py-3 flex items-center justify-between">
        <h1 class="text-lg font-semibold text-gray-800">{{ $section_title }}</h1>
        <!-- <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
              <span>Logout</span>
              <i data-lucide="log-out"></i>
            </button> -->
      </nav>
      <!-- Main Content -->
      {{ $slot }}
    </div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>
</body>

</html>
