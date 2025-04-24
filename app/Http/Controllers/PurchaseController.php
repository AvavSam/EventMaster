<?php

namespace App\Http\Controllers;

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
        //
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

    $data['event_id'] = $event->id;
    $data['purchased_at'] = now();
    Purchase::create($data);

    return back()->with('success', 'Buyer assigned to event successfully.');
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
      'qty' => 'required|integer|min:1',
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
