<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth()->user();
        $users = User::all();
        $usersVerified = $users->where('email_verified_at', '<>', null);
        $usersVerifiedCount = count($usersVerified);
        $userCount = count($users);
        return view('dashboard', compact('user', 'userCount', 'usersVerifiedCount'));
    }
}
