<x-default-layout title="Event Details" section_title="Event Details">
  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <!-- Header with Back Button -->
      <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Detail Event</h1>
        <a
          href="{{ route('admin.events.index') }}"
          class="flex items-center text-gray-600 transition-colors duration-200 hover:text-gray-800"
        >
          <i data-lucide="arrow-left" class="mr-1 h-5 w-5"></i>
          Kembali
        </a>
      </div>

      <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Event Details -->
        <div class="lg:col-span-2">
          <div class="rounded-lg bg-white p-6 shadow-md">
            <div class="space-y-6">
              <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h2>
                <p class="mt-4 leading-relaxed text-gray-600">{{ $event->description }}</p>
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
                <div class="flex items-center space-x-2 text-gray-600">
                  <i data-lucide="ticket" class="h-5 w-5 text-gray-400"></i>
                  <span>Rp {{ number_format($event->price, 0, ',', '.') }}/tiket</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Purchases List -->
          <div class="mt-6 overflow-hidden rounded-lg bg-white shadow-md">
            <div class="p-6">
              <h3 class="text-xl font-semibold text-gray-900">Daftar Pembeli Tiket</h3>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                      Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                      Jumlah
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                      Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                      Tanggal Beli
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  @forelse ($event->purchases as $purchase)
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                          {{ $purchase->buyer->name }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $purchase->buyer->email }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $purchase->qty }} tiket</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <form
                          action="{{ route('admin.purchases.update', $purchase->id) }}"
                          method="POST"
                          class="inline-block"
                        >
                          @csrf
                          @method('PUT')
                          <select
                            name="status"
                            onchange="this.form.submit()"
                            class="{{
                              match ($purchase->status) {
                                'paid' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                default => 'bg-gray-100 text-gray-800',
                              }
                            }} rounded-full border-transparent px-2 py-1 text-xs leading-5 font-semibold focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                          >
                            <option value="pending" {{ $purchase->status === 'pending' ? 'selected' : '' }}>
                              Pending
                            </option>
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
                      <td colspan="5" class="px-6 py-4 text-center text-sm whitespace-nowrap text-gray-500">
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
          <div class="rounded-lg bg-white p-6 shadow-md">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Tambah Pembelian Tiket</h3>
            <form action="{{ route('admin.purchases.store', $event->id) }}" method="POST" class="space-y-4">
              @csrf
              <input type="hidden" name="event_id" value="{{ $event->id }}" />

              <!-- Buyer Selection -->
              <div>
                <label for="buyer_id" class="block text-sm font-medium text-gray-700">Pilih Pembeli</label>
                <select
                  name="buyer_id"
                  id="buyer_id"
                  class="@error('buyer_id') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                >
                  <option value="">-- Pilih Pembeli --</option>
                  @foreach ($buyers as $buyer)
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
                <input
                  type="number"
                  name="qty"
                  id="qty"
                  min="1"
                  value="{{ old('qty', 1) }}"
                  class="@error('qty') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                @error('qty')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <!-- Status -->
              <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <select
                  name="status"
                  id="status"
                  class="@error('status') @enderror mt-1 block w-full rounded-md border-gray-300 p-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                >
                  <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                  <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
                @error('status')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <input type="hidden" name="purchased_at" value="{{ now() }}" />

              <!-- Submit Button -->
              <div class="pt-4">
                <button
                  type="submit"
                  class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                >
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
