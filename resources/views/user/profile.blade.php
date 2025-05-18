<x-default-layout title="Profile" section_title="My Profile">
  <div class="mx-auto max-w-2xl">
    @if (session('success'))
      <div class="relative mb-6 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700" role="alert">
        <div class="flex items-center">
          <i data-lucide="check-circle" class="mr-2 h-5 w-5"></i>
          <span>{{ session('success') }}</span>
        </div>
      </div>
    @endif

    <div class="overflow-hidden rounded-lg bg-white shadow">
      <div class="border-b border-gray-200 p-6">
        <div class="flex items-center">
          <div class="rounded-full bg-blue-100 p-3">
            <i data-lucide="user" class="h-6 w-6 text-blue-600"></i>
          </div>
          <h2 class="ml-3 text-xl font-semibold text-gray-900">Informasi Profil</h2>
        </div>
      </div>

      <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-6 p-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $user->name) }}"
            class="mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
          />
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email', $user->email) }}"
            class="mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
          />
          @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password Section -->
        <div class="border-t border-gray-200 pt-6">
          <h3 class="mb-4 text-lg font-medium text-gray-900">Ubah Password</h3>
          <p class="mb-4 text-sm text-gray-500">Kosongkan field password jika tidak ingin mengubah password.</p>

          <div class="space-y-4">
            <!-- Password -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
              <input
                type="password"
                name="password"
                id="password"
                class="mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              />
              @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Konfirmasi Password Baru
              </label>
              <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              />
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="border-t border-gray-200 pt-6">
          <button
            type="submit"
            class="flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none"
          >
            <i data-lucide="save" class="mr-2 h-4 w-4"></i>
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</x-default-layout>
