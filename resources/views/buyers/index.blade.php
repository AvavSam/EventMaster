<x-default-layout title="Buyers" section_title="Buyers">
  <main class="p-6">
    <!-- Header with Add Button -->
    <div class="mb-6 flex justify-between items-center">
      <h2 class="text-2xl font-bold text-gray-800">Daftar Pembeli</h2>
      <a href="{{ route('buyers.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
        <i data-lucide="plus" class="w-5 h-5"></i>
        <span>Tambah Pembeli</span>
      </a>
    </div>

    <!-- Buyers Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                Pembelian
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($buyers as $buyer)
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm font-medium text-gray-900">{{ $buyer->name }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">{{ $buyer->email }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">{{ $buyer->phone }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">{{ $buyer->purchases->sum('qty') }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">{{ $buyer->created_at->diffForHumans() }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
          <div class="flex space-x-2">
            <a href="{{ route('buyers.edit', $buyer) }}" class="text-yellow-600 hover:text-yellow-900">
            <i data-lucide="edit" class="w-5 h-5"></i>
            </a>
            <form action="{{ route('buyers.destroy', $buyer) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900"
              onclick="return confirm('Apakah Anda yakin ingin menghapus pembeli ini?')">
              <i data-lucide="trash" class="w-5 h-5"></i>
            </button>
            </form>
          </div>
          </td>
        </tr>
      @empty
    <tr>
      <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
      Tidak ada pembeli yang tersedia.
      </td>
    </tr>
  @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</x-default-layout>
