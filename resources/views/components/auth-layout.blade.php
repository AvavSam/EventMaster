<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $title }} - EventMaster</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="flex min-h-screen items-center justify-center bg-gray-50 p-4">
    <div class="w-full max-w-md">
      <!-- Logo -->
      <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center">
          <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
          <span class="ml-2 text-2xl font-bold text-gray-900">EventMaster</span>
        </div>
      </div>

      <!-- Main Content -->
      <div class="rounded-lg bg-white p-8 shadow-lg">
        {{ $slot }}
      </div>
    </div>

    <script>
      // Initialize Lucide icons
      lucide.createIcons();
    </script>
  </body>
</html>
