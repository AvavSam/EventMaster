<x-default-layout title="Events" section_title="Events">
  <!-- Main Content -->
  <main class="p-6">
    <!-- Header with Add Button -->
    <div class="mb-6 flex items-center justify-between">
      <h2 class="text-2xl font-bold text-gray-800">Daftar Event</h2>
      <a
        href="{{ route('admin.events.create') }}"
        class="flex items-center space-x-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition-colors hover:bg-blue-700"
      >
        <i data-lucide="plus" class="h-5 w-5"></i>
        <span>Tambah Event</span>
      </a>
    </div>

    <!-- Events Table -->
    <div class="overflow-hidden rounded-lg bg-white shadow-md">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Nama Event</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Tanggal</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Lokasi</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Deskripsi</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Kapasitas</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                Jumlah Pembelian
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($events as $event)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">{{ $event->location }}</div>
                </td>
                <td class="px-6 py-4">
                  <div class="max-w-xs truncate text-sm text-gray-500">
                    {{ $event->description }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">{{ $event->capacity }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">{{ $event->purchases->sum('qty') }}</div>
                </td>
                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                  <div class="flex space-x-2">
                    <a href="{{ route('admin.events.show', $event) }}" class="text-blue-600 hover:text-blue-900">
                      <i data-lucide="eye" class="h-5 w-5"></i>
                    </a>
                    <a href="{{ route('admin.events.edit', $event) }}" class="text-yellow-600 hover:text-yellow-900">
                      <i data-lucide="edit" class="h-5 w-5"></i>
                    </a>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button
                        type="submit"
                        class="text-red-600 hover:text-red-900"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')"
                      >
                        <i data-lucide="trash" class="h-5 w-5"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm whitespace-nowrap text-gray-500">
                  Tidak ada event yang tersedia.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</x-default-layout>
