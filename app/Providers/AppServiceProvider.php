<?php

namespace App\Providers;

use App\Models\User;
use Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    // Gate: hanya untuk Admin
    Gate::define('admin', function (User $user) {
      return $user->role === 'admin';
    });

    // Gate: hanya untuk User biasa
    Gate::define('user', function (User $user) {
      return $user->role === 'user';
    });
  }
}
