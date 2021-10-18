<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->check())
        {
            return redirect()->route('main');
        }

        if ($userId = $request->get('user'))
        {
            $user = User::findOrFail($userId);
            app('session')->put('user', $userId);
            return redirect()->route('main');
        }

        $users = User::all();
        return view('login', [
            'users' => $users,
        ]);
    }

    public function logout()
    {
        app('session')->forget('user');
        return redirect()->route('main');
    }

    public function tickets()
    {
        $tickets = Ticket::query()
            ->where('user_id', '=', auth()->user()->id)
            ->get();

        return view('user.tickets', [
            'tickets' => $tickets,
        ]);
    }
}
