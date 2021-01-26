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
        
        // Get 'Registered Users' count
        $users = User::all();
        $userCount = count($users);
        
        // Get 'Verified Users' count
        $usersVerified = $users->where('email_verified_at', '<>', null);
        $usersVerifiedCount = count($usersVerified);
    
        // Get 'Invisible Users' count
        $usersInvisible = $users->where('visible', '=', false);
        $usersInvisibleCount = count($usersInvisible);
        
        return view('dashboard', compact('user', 'userCount', 'usersVerifiedCount', 'usersInvisibleCount'));
    }
}
