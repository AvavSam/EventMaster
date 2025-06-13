<x-default-layout title="Dashboard" section_title="Dashboard">
  <!-- Statistics Cards -->
  <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
    <!-- Total Events -->
    <div class="overflow-hidden rounded-lg bg-white shadow-md transition-transform hover:translate-y-[-2px]">
      <div class="flex items-start justify-between p-6">
        <div>
          <p class="text-sm font-medium text-gray-500">Events Dibeli</p>
          <p class="mt-1 text-2xl font-bold text-gray-800">{{ $totalEvents }}</p>
        </div>
        <div class="rounded-lg bg-blue-500 p-3">
          <i data-lucide="calendar" class="text-white"></i>
        </div>
      </div>
    </div>

    <!-- Total Tickets -->
    <div class="overflow-hidden rounded-lg bg-white shadow-md transition-transform hover:translate-y-[-2px]">
      <div class="flex items-start justify-between p-6">
        <div>
          <p class="text-sm font-medium text-gray-500">Total Tiket</p>
          <p class="mt-1 text-2xl font-bold text-gray-800">{{ $totalTickets }}</p>
        </div>
        <div class="rounded-lg bg-purple-500 p-3">
          <i data-lucide="ticket" class="text-white"></i>
        </div>
      </div>
    </div>

    <!-- Latest Status -->
    <div class="overflow-hidden rounded-lg bg-white shadow-md transition-transform hover:translate-y-[-2px]">
      <div class="flex items-start justify-between p-6">
        <div>
          <p class="text-sm font-medium text-gray-500">Status Terakhir</p>
          <div class="mt-2">
            @if ($purchases->count())
              @php
                $latestStatus = $purchases->first()->status;
                $statusColor = match ($latestStatus) {
                  'paid' => 'green',
                  'pending' => 'yellow',
                  'cancelled' => 'red',
                  default => 'gray',
                };
              @endphp

              <span
                class="bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800 inline-flex items-center rounded-full px-3 py-1 text-sm font-medium"
              >
                <i data-lucide="circle" class="mr-1 h-3 w-3"></i>
                {{ ucfirst($latestStatus) }}
              </span>
            @else
              <span class="text-gray-500">Belum ada pembelian</span>
            @endif
          </div>
        </div>
        <div class="rounded-lg bg-green-500 p-3">
          <i data-lucide="check-circle" class="text-white"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Purchases List -->
  <div class="overflow-hidden rounded-lg bg-white shadow-md">
    <div class="border-b border-gray-200 p-6">
      <h2 class="text-lg font-semibold text-gray-800">Riwayat Pembelian Tiket</h2>
    </div>

    @if ($purchases->isEmpty())
      <div class="p-6 text-center">
        <div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
          <i data-lucide="ticket" class="h-8 w-8 text-gray-400"></i>
        </div>
        <h3 class="mb-2 text-lg font-medium text-gray-900">Belum Ada Pembelian</h3>
        <p class="mb-4 text-gray-500">Anda belum membeli tiket event apapun.</p>
        <a
          href="{{ route('user.events.index') }}"
          class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
        >
          <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
          Lihat Event
        </a>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                No.
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                Event
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                Qty
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                Status
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                Tanggal Beli
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($purchases as $purchase)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                  {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $purchase->event->title }}</div>
                </td>
                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">{{ $purchase->qty }} tiket</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @php
                    $statusColor = match ($purchase->status) {
                      'paid' => 'green',
                      'pending' => 'yellow',
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
                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                  @if ($purchase->status === 'paid')
                    <a
                      href="{{ route('user.tickets.show', $purchase->id) }}"
                      class="inline-flex items-center text-blue-600 hover:text-blue-900"
                    >
                      <i data-lucide="ticket" class="mr-1 h-4 w-4"></i>
                      Lihat Tiket
                    </a>
                  @else
                    <span class="inline-flex items-center text-gray-400">
                      <i data-lucide="ticket" class="mr-1 h-4 w-4"></i>
                      Selesaikan Pembayaran
                    </span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</x-default-layout>
