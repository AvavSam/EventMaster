<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buyer extends Model
{
  protected $fillable = [
    'name', 'email', 'phone'
  ];

  /**
   * Events this buyer has purchased tickets for.
   */
  public function events(): BelongsToMany
  {
    return $this->belongsToMany(Event::class, 'purchases')
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
