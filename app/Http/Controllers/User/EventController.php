<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $events = Event::whereDate('event_date', '>=', now())
      ->orderBy('event_date')
      ->paginate(10);

    return view('user.events.index', compact('events'));
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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Event $event)
  {
    return view('user.events.show', compact('event'));
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
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function purchase(Request $request, Event $event)
  {
    $data = $request->validate([
      'qty' => 'required|integer|min:1',
    ]);

    $user = $request->user();

    $buyer = Buyer::firstOrCreate(['email' => $user->email], ['name' => $user->name, 'phone' => $user->phone]);

    \App\Models\Purchase::create([
      'event_id' => $event->id,
      'buyer_id' => $buyer->id,
      'user_id' => $user->id,
      'qty' => $data['qty'],
      'status' => 'pending',
      'purchased_at' => now(),
    ]);

    return redirect()
      ->route('user.dashboard')
      ->with('success', 'Tiket berhasil dipesan.');
  }
}
