<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
  protected $fillable = [
    'title', 'description', 'event_date', 'location', 'capacity', 'price'
  ];

  /**
   * Buyers registered for this event (many-to-many).
   */
  public function buyers(): BelongsToMany
  {
    return $this->belongsToMany(Buyer::class, 'purchases')
      ->withPivot('qty', 'status', 'purchased_at')
      ->withTimestamps();
  }

  /**
   * Raw purchases entries.
   */
  public function purchases()
  {
    return $this->hasMany(Purchase::class);
  }
}
