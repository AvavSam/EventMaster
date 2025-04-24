<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
  public function run(): void
  {
    $events = [
      [
        'title' => 'Laravel Conference 2025',
        'description' => 'Konferensi tahunan komunitas Laravel.',
        'event_date' => Carbon::parse('2025-05-15 09:00:00'),
        'location' => 'Jakarta Convention Center',
        'capacity' => 500,
        'price' => 150000.00,
      ],
      [
        'title' => 'Workshop Vue.js Basics',
        'description' => 'Pelatihan dasar Vue.js untuk pemula.',
        'event_date' => Carbon::parse('2025-06-10 13:00:00'),
        'location' => 'Coworking Space Makassar',
        'capacity' => 50,
        'price' => 75000.00,
      ],
    ];

    foreach ($events as $data) {
      Event::create($data);
    }
  }
}
