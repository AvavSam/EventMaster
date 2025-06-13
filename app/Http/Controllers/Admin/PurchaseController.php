<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Event;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $purchases = Purchase::all();
    $buyers = Buyer::all();
    $events = Event::all();
    return view('admin.purchases.index', compact('purchases', 'buyers', 'events'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Event $event)
  {
    $data = $request->validate([
      'buyer_id' => 'required|exists:buyers,id',
      'qty' => 'required|integer|min:1',
      'status' => 'required|in:pending,paid',
    ]);

    // Cek apakah buyer sudah memiliki tiket untuk event ini
    $existingPurchase = Purchase::where('event_id', $event->id)
      ->where('buyer_id', $data['buyer_id'])
      ->first();

    if ($existingPurchase) {
      // Jika sudah ada, tambahkan jumlah tiket ke pembelian yang sudah ada
      $existingPurchase->qty += $data['qty'];
      $existingPurchase->save();

      return back()->with('success', 'Jumlah tiket berhasil ditambahkan ke pembelian yang sudah ada.');
    } else {
      // Jika belum ada, buat pembelian baru
      $data['event_id'] = $event->id;
      $data['purchased_at'] = now();
      Purchase::create($data);

      return back()->with('success', 'Pembeli berhasil ditambahkan ke event.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Purchase $purchase)
  {
    $data = $request->validate([
      'qty' => 'sometimes|integer|min:1',
      'status' => 'required|in:pending,paid',
    ]);

    $purchase->update($data);
    return back()->with('success', 'Purchase updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Purchase $purchase)
  {
    $purchase->delete();
    return back()->with('success', 'Purchase removed successfully.');
  }
}
