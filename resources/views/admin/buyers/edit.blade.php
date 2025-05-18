<x-default-layout title="Edit Buyer" section_title="Edit Buyer">
  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Edit Pembeli</h1>
        <a
          href="{{ route('admin.buyers.index') }}"
          class="flex items-center text-gray-600 transition-colors duration-200 hover:text-gray-800"
        >
          <i data-lucide="arrow-left" class="mr-1 h-5 w-5"></i>
          Kembali
        </a>
      </div>

      <div class="rounded-lg bg-white p-6 shadow-md">
        <form action="{{ route('admin.buyers.update', $buyer->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
              <input
                type="text"
                name="name"
                id="name"
                value="{{ $buyer->name }}"
                class="@error('name') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                placeholder="Masukkan nama lengkap"
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
                value="{{ $buyer->email }}"
                class="@error('email') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                placeholder="contoh@email.com"
              />
              @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Phone -->
            <div class="md:col-span-2">
              <label for="phone" class="block text-sm font-medium text-gray-700">
                Nomor Telepon
                <span class="text-xs text-gray-500">(Opsional)</span>
              </label>
              <div class="relative mt-1 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                  <span class="text-gray-500 sm:text-sm">+62</span>
                </div>
                <input
                  type="tel"
                  name="phone"
                  id="phone"
                  value="{{ $buyer->phone }}"
                  class="@error('phone') @enderror block w-full rounded-md border-gray-300 p-4 pl-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                  placeholder="8123456789"
                />
              </div>
              @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror

              <p class="mt-1 text-sm text-gray-500">Format: 8123456789 (tanpa awalan 0)</p>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3">
            <a
              href="{{ route('admin.buyers.index') }}"
              class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
            >
              Batal
            </a>
            <button
              type="submit"
              class="inline-flex justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none"
            >
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-default-layout>
