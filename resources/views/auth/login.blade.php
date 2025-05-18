<x-auth-layout title="Login">
  <div class="mb-8 text-center">
    <h1 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h1>
    <p class="mt-2 text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
  </div>

  <form method="POST" action="{{ route('auth.login') }}" class="space-y-6">
    @csrf

    <!-- Email -->
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
      <div class="mt-1">
        <input
          id="email"
          name="email"
          type="email"
          autocomplete="email"
          required
          value="{{ old('email') }}"
          class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none sm:text-sm"
          placeholder="nama@example.com"
        />
        @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
    </div>

    <!-- Password -->
    <div>
      <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
      <div class="mt-1">
        <input
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required
          class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none sm:text-sm"
        />
        @error('password')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
    </div>

    <!-- Remember Me -->
    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <input
          id="remember"
          name="remember"
          type="checkbox"
          class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
        />
        <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
      </div>
    </div>

    <div>
      <button
        type="submit"
        class="flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
      >
        Masuk
      </button>
    </div>
  </form>

  <div class="mt-6">
    <p class="text-center text-sm text-gray-600">
      Belum punya akun?
      <a href="{{ route('auth.register') }}" class="font-medium text-blue-600 hover:text-blue-500">Daftar sekarang</a>
    </p>
  </div>
</x-auth-layout>
