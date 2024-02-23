<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        return view('login.index');
    }

    public function store(Request $request)
    {
        $credentials = request(['email', 'password']);

        if ( ! Auth::attempt($credentials)) {
            return redirect('login')
                ->withErrors(['email' => 'Неверный email или пароль.']);
        }

        return redirect()->route('order');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('order');
    }
}
