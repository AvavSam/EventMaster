<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Event;
use App\Models\Buyer;
use Faker\Factory as Faker;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $events = Event::all();
        $buyers = Buyer::all();

        foreach ($buyers as $buyer) {
            // each buyer may purchase 1-3 tickets from random event
            $event = $events->random();
            Purchase::create([
                'event_id'     => $event->id,
                'buyer_id'     => $buyer->id,
                'qty'          => $faker->numberBetween(1, 3),
                'status'       => $faker->randomElement(['pending', 'paid']),
                'purchased_at' => $faker->dateTimeBetween('-3 month', 'now'),
            ]);
        }
    }
}
