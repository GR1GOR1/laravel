<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Sessions\Store as LoginRequest;

class Sessions extends Controller
{
    public function create()
    {
        return view('auth.sessions.create');
    }

    public function store(LoginRequest $request)
    {
        $request->tryAuthUser();
        $request->session()->regenerate();
        return redirect()->intended('/'); // Надо бы нормально сделать страничку, но пока так
    }
}
