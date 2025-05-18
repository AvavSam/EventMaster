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

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center">
        <i data-lucide="calendar" class="text-blue-600 w-8 h-8"></i>
        <span class="ml-2 text-2xl font-bold text-gray-900">EventMaster</span>
      </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-lg p-8">
      {{ $slot }}
    </div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>
</body>

</html>
