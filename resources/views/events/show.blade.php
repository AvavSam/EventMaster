<x-default-layout title="Event Details" section_title="Event Details">
  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header with Back Button -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Detail Event</h1>
        <a href="{{ route('events.index') }}"
          class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-200">
          <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i>
          Kembali
        </a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Event Details -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="space-y-6">
              <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h2>
                <p class="mt-4 text-gray-600 leading-relaxed">{{ $event->description }}</p>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center space-x-2 text-gray-600">
                  <i data-lucide="calendar" class="w-5 h-5 text-gray-400"></i>
                  <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-600">
                  <i data-lucide="map-pin" class="w-5 h-5 text-gray-400"></i>
                  <span>{{ $event->location }}</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-600">
                  <i data-lucide="users" class="w-5 h-5 text-gray-400"></i>
                  <span>Kapasitas: {{ number_format($event->capacity) }} orang</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-600">
                  <i data-lucide="ticket" class="w-5 h-5 text-gray-400"></i>
                  <span>Rp {{ number_format($event->price, 0, ',', '.') }}/tiket</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Purchases List -->
          <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
              <h3 class="text-xl font-semibold text-gray-900">Daftar Pembeli Tiket</h3>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                      Beli</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @forelse($event->purchases as $purchase)
                    <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $purchase->buyer->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $purchase->buyer->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $purchase->qty }} tiket</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" class="inline-block">
                      @csrf
                      @method('PUT')
                      <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-full px-2 py-1 leading-5
                      {{ match ($purchase->status) {
            'paid' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
            } }} border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <option value="pending" {{ $purchase->status === 'pending' ? 'selected' : '' }}>Pending</option>
                      <option value="paid" {{ $purchase->status === 'paid' ? 'selected' : '' }}>Paid</option>
                      </select>
                    </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y H:i') }}
                    </div>
                    </td>
                    </tr>
          @empty
        <tr>
        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
          Belum ada pembelian tiket untuk event ini.
        </td>
        </tr>
      @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Purchase Form -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Pembelian Tiket</h3>
            <form action="{{ route('purchases.store', $event->id) }}" method="POST" class="space-y-4">
              @csrf
              <input type="hidden" name="event_id" value="{{ $event->id }}" />

              <!-- Buyer Selection -->
              <div>
                <label for="buyer_id" class="block text-sm font-medium text-gray-700">Pilih Pembeli</label>
                <select name="buyer_id" id="buyer_id" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                                @error('buyer_id') @enderror">
                  <option value="">-- Pilih Pembeli --</option>
                  @foreach($buyers as $buyer)
            <option value="{{ $buyer->id }}" {{ old('buyer_id') == $buyer->id ? 'selected' : '' }}>
            {{ $buyer->name }} - {{ $buyer->email }}
            </option>
          @endforeach
                </select>
                @error('buyer_id')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
              </div>

              <!-- Quantity -->
              <div>
                <label for="qty" class="block text-sm font-medium text-gray-700">Jumlah Tiket</label>
                <input type="number" name="qty" id="qty" min="1" value="{{ old('qty', 1) }}" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                                @error('qty') @enderror">
                @error('qty')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
              </div>

              <!-- Status -->
              <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <select name="status" id="status" class="mt-1 block w-full p-4 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                                @error('status') @enderror">
                  <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                  <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                  <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
              </div>

              <input type="hidden" name="purchased_at" value="{{ now() }}">

              <!-- Submit Button -->
              <div class="pt-4">
                <button type="submit"
                  class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  Tambah Pembelian
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-default-layout>
