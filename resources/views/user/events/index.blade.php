<x-default-layout title="Events" section_title="Events">
  <!-- Events Grid -->
  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($events as $event)
      <div class="overflow-hidden rounded-lg bg-white shadow-md transition-transform hover:translate-y-[-2px]">
        <!-- Event Header -->
        <div class="p-6">
          <h3 class="mb-2 text-xl font-semibold text-gray-900">{{ $event->title }}</h3>
          <p class="mb-4 text-sm text-gray-600">{{ Str::limit($event->description, 100) }}</p>

          <!-- Event Details -->
          <div class="space-y-2">
            <div class="flex items-center text-gray-600">
              <i data-lucide="calendar" class="mr-2 h-4 w-4"></i>
              <span class="text-sm">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}</span>
            </div>
            <div class="flex items-center text-gray-600">
              <i data-lucide="map-pin" class="mr-2 h-4 w-4"></i>
              <span class="text-sm">{{ $event->location }}</span>
            </div>
            <div class="flex items-center font-semibold text-gray-900">
              <i data-lucide="ticket" class="mr-2 h-4 w-4"></i>
              <span>Rp {{ number_format($event->price, 0, ',', '.') }}</span>
            </div>
          </div>
        </div>

        <!-- Event Footer -->
        <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4">
          <span class="text-sm text-gray-600">Sisa {{ $event->capacity - $event->purchases->sum('qty') }} tiket</span>
          <a
            href="{{ route('user.events.show', $event) }}"
            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
          >
            <i data-lucide="arrow-right" class="mr-1 h-4 w-4"></i>
            Detail
          </a>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div class="rounded-lg bg-white py-12 text-center shadow-md">
          <div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
            <i data-lucide="calendar-x" class="h-8 w-8 text-gray-400"></i>
          </div>
          <h3 class="mb-2 text-lg font-medium text-gray-900">Tidak Ada Event</h3>
          <p class="text-gray-500">Belum ada event yang tersedia saat ini.</p>
        </div>
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  <div class="mt-6">
    {{ $events->links() }}
  </div>
</x-default-layout>
