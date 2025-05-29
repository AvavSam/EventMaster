<x-default-layout title="E-Ticket" section_title="E-Ticket">
  <div class="mx-auto max-w-2xl">
    <div class="overflow-hidden rounded-lg bg-white shadow-lg">
      <!-- Ticket Header -->
      <div class="bg-blue-600 px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <i data-lucide="ticket" class="h-8 w-8 text-white"></i>
            <h1 class="ml-2 text-xl font-bold text-white">E-Ticket</h1>
          </div>
          <div>
            @php
              $statusColor = match ($purchase->status) {
                'paid' => 'bg-green-500',
                'pending' => 'bg-yellow-500',
                'cancelled' => 'bg-red-500',
                default => 'bg-gray-500',
              };
            @endphp

            <span
              class="{{ $statusColor }} inline-flex items-center rounded-full px-3 py-1 text-sm font-medium text-white"
            >
              {{ ucfirst($purchase->status) }}
            </span>
          </div>
        </div>
      </div>

      <!-- Event Details -->
      <div class="border-b border-gray-200 p-6">
        <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ $purchase->event->title }}</h2>

        <div class="grid grid-cols-2 gap-4">
          <div class="flex items-center space-x-2 text-gray-600">
            <i data-lucide="calendar" class="h-5 w-5 text-gray-400"></i>
            <span>{{ \Carbon\Carbon::parse($purchase->event->event_date)->format('d M Y H:i') }}</span>
          </div>
          <div class="flex items-center space-x-2 text-gray-600">
            <i data-lucide="map-pin" class="h-5 w-5 text-gray-400"></i>
            <span>{{ $purchase->event->location }}</span>
          </div>
        </div>
      </div>

      <!-- Ticket Details -->
      <div class="border-b border-gray-200 p-6">
        <div class="grid grid-cols-2 gap-6">
          <div>
            <p class="text-sm text-gray-500">Nama Pembeli</p>
            <p class="text-lg font-medium text-gray-900">{{ $purchase->buyer->name }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Jumlah Tiket</p>
            <p class="text-lg font-medium text-gray-900">{{ $purchase->qty }} tiket</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Tanggal Pembelian</p>
            <p class="text-lg font-medium text-gray-900">
              {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y H:i') }}
            </p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Kode Tiket</p>
            <p class="text-lg font-medium text-gray-900">{{ $purchase->id }}</p>
          </div>
        </div>
      </div>

      <!-- QR Code -->
      <div class="p-6 text-center">
        <div class="mb-4 inline-block rounded-lg bg-gray-100 p-4">
          <img
            src="{{ $purchase->qr_code_url ?? 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $purchase->id }}"
            alt="QR Code"
            class="h-32 w-32"
          />
        </div>
        <p class="text-sm text-gray-500">Tunjukkan QR Code ini saat check-in event</p>
      </div>

      <!-- Print Button -->
      <div class="bg-gray-50 p-6 print:hidden">
        <a
          href="{{ route('user.tickets.print', $purchase->id) }}"
          target="_blank"
          rel="noopener noreferrer"
          class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
        >
          <i data-lucide="printer" class="mr-2 h-4 w-4"></i>
          Cetak Tiket
        </a>
      </div>
    </div>
  </div>

  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      .bg-blue-600 {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
      .shadow-lg {
        box-shadow: none !important;
      }
      .max-w-2xl {
        max-width: none;
      }
      .rounded-lg {
        border-radius: 0;
      }
    }
  </style>
</x-default-layout>
