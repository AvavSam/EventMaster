<x-default-layout title="Make Purchase" section_title="Create Purchase">
  <form method="POST" action="{{ route('purchases.store') }}" class="space-y-4">
    @csrf
    <div>
      <label for="buyer_id">Pembeli</label>
      <select name="buyer_id" class="w-full border rounded">
        @foreach($buyers as $buyer)
      <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
    @endforeach
      </select>
    </div>

    <div>
      <label for="event_id">Event</label>
      <select name="event_id" class="w-full border rounded">
        @foreach($events as $event)
      <option value="{{ $event->id }}">{{ $event->title }}</option>
    @endforeach
      </select>
    </div>

    <div>
      <label for="qty">Jumlah Tiket</label>
      <input type="number" name="qty" min="1" class="w-full border rounded" />
    </div>

    <div>
      <label for="status">Status</label>
      <select name="status" class="w-full border rounded">
        <option value="pending">Pending</option>
        <option value="paid">Paid</option>
        <option value="cancelled">Cancelled</option>
      </select>
    </div>

    <div>
      <label for="purchased_at">Tanggal Pembelian</label>
      <input type="datetime-local" name="purchased_at" class="w-full border rounded"
        value="{{ now()->format('Y-m-d\TH:i') }}" />
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Pembelian</button>
  </form>
</x-default-layout>
