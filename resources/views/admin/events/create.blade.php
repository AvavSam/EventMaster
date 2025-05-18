<x-default-layout title="Create Event" section_title="Create Event">
  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Buat Event Baru</h1>
        <a
          href="{{ route('admin.events.index') }}"
          class="flex items-center text-gray-600 transition-colors duration-200 hover:text-gray-800"
        >
          <i data-lucide="arrow-left" class="mr-1 h-5 w-5"></i>
          Kembali
        </a>
      </div>

      <div class="rounded-lg bg-white p-6 shadow-md">
        <form action="{{ route('admin.events.store') }}" method="POST" class="space-y-6">
          @csrf

          <div class="space-y-4">
            <!-- Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Judul Event</label>
              <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                class="@error('title') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                placeholder="Masukkan judul event"
              />
              @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Description -->
            <div>
              <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
              <textarea
                name="description"
                id="description"
                rows="4"
                class="@error('description') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                placeholder="Jelaskan detail event"
              >
{{ old('description') }}</textarea
              >
              @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Event Date -->
            <div>
              <label for="event_date" class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
              <input
                type="datetime-local"
                name="event_date"
                id="event_date"
                value="{{ old('event_date') }}"
                class="@error('event_date') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              />
              @error('event_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Location -->
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
              <input
                type="text"
                name="location"
                id="location"
                value="{{ old('location') }}"
                class="@error('location') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                placeholder="Masukkan lokasi event"
              />
              @error('location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Capacity and Price Grid -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
              <!-- Capacity -->
              <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                  <input
                    type="number"
                    name="capacity"
                    id="capacity"
                    min="1"
                    value="{{ old('capacity') }}"
                    class="@error('capacity') @enderror block w-full rounded-md border-gray-300 p-4 pr-12 pl-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    placeholder="0"
                  />
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
                <div class="relative mt-1 rounded-md shadow-sm">
                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                  </div>
                  <input
                    type="number"
                    name="price"
                    id="price"
                    min="0"
                    value="{{ old('price') }}"
                    class="@error('price') @enderror block w-full rounded-md border-gray-300 p-4 pr-12 pl-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    placeholder="0"
                  />
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
            <a
              href="{{ route('admin.events.index') }}"
              class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
            >
              Batal
            </a>
            <button
              type="submit"
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
            >
              Buat Event
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-default-layout>
