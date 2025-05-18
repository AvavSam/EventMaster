<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function register()
  {
    return view('auth.register');
  }

  public function login()
  {
    return view('auth.login');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required',
      'confirm_password' => 'required|same:password',
    ]);

    User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'password' => $validated['password'],
    ]);

    return redirect()
      ->route('auth.login')
      ->with('success', 'Register Success');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      // Check if user is admin and redirect accordingly
      if (
        auth()
          ->user()
          ->can('admin')
      ) {
        return redirect()->route('admin.dashboard');
      }

      // Add fallback for non-admin users if needed
      return redirect()->route('user.dashboard');
    }

    return back()
      ->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ])
      ->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('auth.login');
  }
}
