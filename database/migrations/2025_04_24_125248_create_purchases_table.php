<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->foreignId('event_id')->constrained()->cascadeOnDelete();
      $table->foreignId('buyer_id')->constrained()->cascadeOnDelete();
      $table->integer('qty')->default(1);
      $table->enum('status', ['pending', 'paid'])->default('pending');
      $table->timestamp('purchased_at')->useCurrent();
      $table->timestamps();

      $table->unique(['event_id', 'buyer_id'], 'purchase_unique_event_buyer');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('purchases');
  }
};
