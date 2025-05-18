<x-default-layout title="Purchases" section_title="Purchases">
  <main class="p-6">
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Daftar Pembelian Tiket</h2>
    </div>

    <!-- Events List -->
    <div class="space-y-6">
      @forelse ($events as $event)
        <div class="overflow-hidden rounded-lg bg-white shadow-md">
          <!-- Event Header -->
          <div class="bg-gray-50 px-6 py-4">
            <div class="flex items-start justify-between">
              <div>
                <h3 class="text-xl font-bold text-gray-900">{{ $event->title }}</h3>
                <div class="mt-1 flex items-center space-x-4 text-sm text-gray-600">
                  <div class="flex items-center">
                    <i data-lucide="calendar" class="mr-1 h-4 w-4"></i>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                  </div>
                  <div class="flex items-center">
                    <i data-lucide="map-pin" class="mr-1 h-4 w-4"></i>
                    <span>{{ $event->location }}</span>
                  </div>
                </div>
              </div>
              <div class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">
                {{ $event->purchases->count() }} Pembelian
              </div>
            </div>
          </div>

          <!-- Purchases Table -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                    Pembeli
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Email</th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                    Jumlah Tiket
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                    Tanggal Pembelian
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
                      <div class="text-sm text-gray-500">
                        {{ $purchase->buyer->email }}
                      </div>
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
                        {{ $purchase->created_at->format('d M Y H:i') }}
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm whitespace-nowrap text-gray-500">
                      Belum ada pembelian untuk event ini.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      @empty
        <div class="rounded-lg bg-white p-6 text-center shadow-md">
          <div class="text-gray-500">Tidak ada data pembelian yang tersedia.</div>
        </div>
      @endforelse
    </div>
  </main>
</x-default-layout>
