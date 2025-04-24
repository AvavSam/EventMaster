<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $buyers = Buyer::all();
    return view('buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('buyers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data = $request->validate([
      'name' => 'required|string|max:150',
      'email' => 'required|email|unique:buyers,email',
      'phone' => 'nullable|string|max:50',
    ]);

    Buyer::create($data);
    return redirect()->route('buyers.index')->with('success', 'Buyer added successfully.');
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
  public function edit(Buyer $buyer)
  {
    return view('buyers.edit', compact('buyer'));
  }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Buyer $buyer)
  {
    $data = $request->validate([
      'name' => 'required|string|max:150',
      'email' => 'required|email|unique:buyers,email,'.$buyer->id,
      'phone' => 'nullable|string|max:50',
    ]);

    $buyer->update($data);
    return redirect()->route('buyers.index')->with('success', 'Buyer updated successfully.');
  }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Buyer $buyer)
  {
    $buyer->delete();
    return redirect()->route('buyers.index')->with('success', 'Buyer deleted successfully.');
  }
}
