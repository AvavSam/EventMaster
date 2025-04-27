<x-default-layout title="Create Event" section_title="Create Event">
  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Pembeli Baru</h1>
        <a href="{{ route('buyers.index') }}"
          class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-200">
          <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i>
          Kembali
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('buyers.store') }}" method="POST" class="space-y-6">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                              @error('name') @enderror" placeholder="Masukkan nama lengkap">
              @error('name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                              @error('email') @enderror" placeholder="contoh@email.com">
              @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>

            <!-- Phone -->
            <div class="md:col-span-2">
              <label for="phone" class="block text-sm font-medium text-gray-700">
                Nomor Telepon
                <span class="text-gray-500 text-xs">(Opsional)</span>
              </label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm">+62</span>
                </div>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="block w-full p-4 rounded-md border-gray-300 pl-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                                  @error('phone') @enderror" placeholder="8123456789">
              </div>
              @error('phone')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
              <p class="mt-1 text-sm text-gray-500">Format: 8123456789 (tanpa awalan 0)</p>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3">
            <a href="{{ route('buyers.index') }}"
              class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Batal
            </a>
            <button type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-default-layout>"
