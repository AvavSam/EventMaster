<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'purchases';

  protected $fillable = [
    'event_id', 'buyer_id', 'qty', 'status', 'purchased_at'
  ];

  /**
   * The event for this purchase.
   */
  public function event()
  {
    return $this->belongsTo(Event::class);
  }

  /**
   * The buyer who made this purchase.
   */
  public function buyer()
  {
    return $this->belongsTo(Buyer::class);
  }
}
