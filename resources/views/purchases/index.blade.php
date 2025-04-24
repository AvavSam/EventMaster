<x-default-layout title="Purchases" section_title="Purchases">
  <main class="p-6">
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Daftar Pembelian Tiket</h2>
    </div>

    <!-- Events List -->
    <div class="space-y-6">
      @forelse($events as $event)
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <!-- Event Header -->
      <div class="px-6 py-4 bg-gray-50 border-b">
        <div class="flex items-start justify-between">
        <div>
          <h3 class="text-xl font-bold text-gray-900">{{ $event->title }}</h3>
          <div class="mt-1 flex items-center space-x-4 text-sm text-gray-600">
          <div class="flex items-center">
            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
            <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
          </div>
          <div class="flex items-center">
            <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
            <span>{{ $event->location }}</span>
          </div>
          </div>
        </div>
        <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
          {{ $event->purchases->count() }} Pembelian
        </div>
        </div>
      </div>

      <!-- Purchases Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembeli</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Tiket
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
            Pembelian</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($event->purchases as $purchase)
          <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm font-medium text-gray-900">
          {{ $purchase->buyer->name }}
          </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">
          {{ $purchase->buyer->email }}
          </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">
          {{ $purchase->qty }} tiket
          </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
        {{ $purchase->status === 'paid'
        ? 'bg-green-100 text-green-800'
        : 'bg-yellow-100 text-yellow-800' }}">
          {{ ucfirst($purchase->status) }}
          </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-500">
          {{ $purchase->created_at->format('d M Y H:i') }}
          </div>
          </td>
          </tr>
      @empty
      <tr>
      <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
      Belum ada pembelian untuk event ini.
      </td>
      </tr>
    @endforelse
        </tbody>
        </table>
      </div>
      </div>
    @empty
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
      <div class="text-gray-500">Tidak ada data pembelian yang tersedia.</div>
      </div>
    @endforelse
    </div>
  </main>
</x-default-layout>
