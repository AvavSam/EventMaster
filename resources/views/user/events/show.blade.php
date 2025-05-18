<x-default-layout title="{{ $event->title }}" section_title="Event Detail">
  <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Event Details -->
    <div class="lg:col-span-2">
      <div class="overflow-hidden rounded-lg bg-white shadow-md">
        <div class="p-6">
          <h1 class="mb-4 text-2xl font-bold text-gray-900">{{ $event->title }}</h1>

          <div class="prose mb-6 max-w-none text-gray-700">
            {{ $event->description }}
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center space-x-2 text-gray-600">
              <i data-lucide="calendar" class="h-5 w-5 text-gray-400"></i>
              <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}</span>
            </div>
            <div class="flex items-center space-x-2 text-gray-600">
              <i data-lucide="map-pin" class="h-5 w-5 text-gray-400"></i>
              <span>{{ $event->location }}</span>
            </div>
            <div class="flex items-center space-x-2 text-gray-600">
              <i data-lucide="users" class="h-5 w-5 text-gray-400"></i>
              <span>Kapasitas: {{ number_format($event->capacity) }} orang</span>
            </div>
            <div class="flex items-center space-x-2 font-semibold text-gray-900">
              <i data-lucide="ticket" class="h-5 w-5 text-gray-400"></i>
              <span>Rp {{ number_format($event->price, 0, ',', '.') }}/tiket</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Purchase History -->
      @if ($event->purchases->isNotEmpty())
        <div class="mt-6 overflow-hidden rounded-lg bg-white shadow-md">
          <div class="border-b border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Pembelian</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                    Pembeli
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Jumlah</th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                    Tanggal
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($event->purchases as $purchase)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">{{ $purchase->buyer->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">{{ $purchase->qty }} tiket</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      @php
                        $statusColor = match ($purchase->status) {
                          'paid' => 'green',
                          'pending' => 'yellow',
                          'cancelled' => 'red',
                          default => 'gray',
                        };
                      @endphp

                      <span
                        class="bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                      >
                        {{ ucfirst($purchase->status) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                      {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y H:i') }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
    </div>

    <!-- Purchase Form -->
    <div class="lg:col-span-1">
      <div class="rounded-lg bg-white p-6 shadow-md">
        <h2 class="mb-4 text-lg font-semibold text-gray-900">Beli Tiket</h2>

        @php
          $remainingTickets = $event->capacity - $event->purchases->sum('qty');
        @endphp

        @if ($remainingTickets > 0)
          <form action="{{ route('user.events.purchase', $event) }}" method="POST" class="space-y-4">
            @csrf

            <div>
              <label for="qty" class="block text-sm font-medium text-gray-700">Jumlah Tiket</label>
              <div class="mt-1">
                <input
                  type="number"
                  name="qty"
                  id="qty"
                  min="1"
                  max="{{ $remainingTickets }}"
                  value="{{ old('qty', 1) }}"
                  class="block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                @error('qty')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>
              <p class="mt-2 text-sm text-gray-500">Tersisa {{ $remainingTickets }} tiket</p>
            </div>

            <div class="-mx-6 mt-6 -mb-6 bg-gray-50 p-6">
              <div class="mb-4 flex items-center justify-between">
                <span class="text-sm text-gray-600">Harga per tiket</span>
                <span class="text-sm font-medium text-gray-900">
                  Rp {{ number_format($event->price, 0, ',', '.') }}
                </span>
              </div>
              <button
                type="submit"
                class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
              >
                <i data-lucide="shopping-cart" class="mr-2 h-4 w-4"></i>
                Beli Sekarang
              </button>
            </div>
          </form>
        @else
          <div class="py-4 text-center">
            <div class="mb-3 inline-flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
              <i data-lucide="x" class="h-6 w-6 text-red-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900">Tiket Habis</h3>
            <p class="mt-2 text-sm text-gray-500">Maaf, semua tiket untuk event ini telah terjual habis.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</x-default-layout>
