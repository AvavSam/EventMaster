<x-auth-layout title="Register">
  <div class="mb-8 text-center">
    <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
    <p class="mt-2 text-gray-600">Daftar untuk mulai mengelola event Anda</p>
  </div>

  <form method="POST" action="{{ route('auth.store') }}" class="space-y-6">
    @csrf

    <!-- Name -->
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
      <div class="mt-1">
        <input
          id="name"
          name="name"
          type="text"
          required
          value="{{ old('name') }}"
          class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none sm:text-sm"
          placeholder="Masukkan nama lengkap"
        />
        @error('name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
    </div>

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
          autocomplete="new-password"
          required
          class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none sm:text-sm"
          placeholder="Minimal 8 karakter"
        />
        @error('password')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
    </div>

    <!-- Confirm Password -->
    <div>
      <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
      <div class="mt-1">
        <input
          id="confirm_password"
          name="confirm_password"
          type="password"
          required
          class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none sm:text-sm"
          placeholder="Masukkan password kembali"
        />
      </div>
    </div>

    <div>
      <button
        type="submit"
        class="flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none"
      >
        Daftar
      </button>
    </div>
  </form>

  <div class="mt-6">
    <p class="text-center text-sm text-gray-600">
      Sudah punya akun?
      <a href="{{ route('auth.login') }}" class="font-medium text-blue-600 hover:text-blue-500">Masuk di sini</a>
    </p>
  </div>
</x-auth-layout>
