<x-default-layout title="Dashboard" section_title="Dashboard">
  <!-- Main Content -->
  <main class="p-6 space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Total Events -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:translate-y-[-2px]">
        <div class="p-6 flex items-start justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Events</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $events->count() }}</p>
          </div>
          <div class="bg-blue-500 p-3 rounded-lg">
            <i data-lucide="calendar" class="text-white"></i>
          </div>
        </div>
      </div>

      <!-- Total Buyers -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:translate-y-[-2px]">
        <div class="p-6 flex items-start justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Buyers</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $buyers->count() }}</p>
          </div>
          <div class="bg-purple-500 p-3 rounded-lg">
            <i data-lucide="users" class="text-white"></i>
          </div>
        </div>
      </div>

      <!-- Total Revenue -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:translate-y-[-2px]">
        <div class="p-6 flex items-start justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">
              Rp {{ number_format($purchases->sum(fn ($p) => $p->qty * $p->event->price), 0, ',', '.') }}
            </p>
          </div>
          <div class="bg-green-500 p-3 rounded-lg">
            <i data-lucide="dollar-sign" class="text-white"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Events Table -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Events</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tickets Sold</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($events as $index => $event)
          <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $event->location }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $event->purchases->sum('qty') }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            Rp
            {{ number_format($event->purchases->sum(fn ($p) => $p->status == 'paid' ? $p->qty * $event->price : 0), 0, ',', '.') }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex space-x-2">
            <button class="text-blue-600 hover:text-blue-900">
              <i data-lucide="eye"></i>
            </button>
            <button class="text-yellow-600 hover:text-yellow-900">
              <i data-lucide="edit"></i>
            </button>
            <button class="text-red-600 hover:text-red-900">
              <i data-lucide="trash"></i>
            </button>
            </div>
          </td>
          </tr>
        @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Two Column Layout for Buyers and Purchases -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Recent Buyers -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Buyers</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($buyers as $buyer)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ $buyer->name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $buyer->email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $buyer->phone }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $buyer->created_at->diffForHumans() }}
            </td>
          </tr>
        @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Recent Purchases -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Purchases</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchased At
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($purchases as $purchase)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ $purchase->buyer->name }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $purchase->event->title }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $purchase->qty }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                  {{ $purchase->status === 'paid'
    ? 'bg-green-100 text-green-800'
    : 'bg-yellow-100 text-yellow-800' }}">
              {{ ucfirst($purchase->status) }}
              </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y H:i') }}
              </td>
            </tr>
        @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</x-default-layout>
