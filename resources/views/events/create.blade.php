<x-default-layout title="Create Event" section_title="Create Event">
  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Buat Event Baru</h1>
        <a href="{{ route('events.index') }}"
          class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-200">
          <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i>
          Kembali
        </a>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
          @csrf

          <div class="space-y-4">
            <!-- Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Judul Event</label>
              <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                              @error('title') @enderror" placeholder="Masukkan judul event">
              @error('title')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>

            <!-- Description -->
            <div>
              <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
              <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                              @error('description') @enderror"
                placeholder="Jelaskan detail event">{{ old('description') }}</textarea>
              @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>

            <!-- Event Date -->
            <div>
              <label for="event_date" class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
              <input type="datetime-local" name="event_date" id="event_date" value="{{ old('event_date') }}" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                              @error('event_date') @enderror">
              @error('event_date')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>

            <!-- Location -->
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
              <input type="text" name="location" id="location" value="{{ old('location') }}" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                              @error('location')  @enderror" placeholder="Masukkan lokasi event">
              @error('location')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>

            <!-- Capacity and Price Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <!-- Capacity -->
              <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <input type="number" name="capacity" id="capacity" min="1" value="{{ old('capacity') }}" class="block w-full p-4 rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                                      @error('capacity') @enderror" placeholder="0">
                  <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <span class="text-gray-500 sm:text-sm">orang</span>
                  </div>
                </div>
                @error('capacity')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
              </div>

              <!-- Price -->
              <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga Tiket</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                  </div>
                  <input type="number" name="price" id="price" min="0" value="{{ old('price') }}" class="block w-full p-4 rounded-md border-gray-300 pl-12 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                                      @error('price') @enderror" placeholder="0">
                  <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <span class="text-gray-500 sm:text-sm">.00</span>
                  </div>
                </div>
                @error('price')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('events.index') }}"
              class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Batal
            </a>
            <button type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Buat Event
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-default-layout>
