<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{


    
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // Get the authenticated user
    $user = Auth::user();

    // Check the user's role and redirect accordingly
    if ($user->role_id == 2) {
        return redirect()->route('employee'); // Redirect to employee dashboard
    } elseif ($user->role_id == 1) {
        return redirect()->route('admin.index'); // Redirect to admin dashboard
    } elseif ($user->role_id == 3) {
        return redirect()->route('home_hr'); // Redirect to HR dashboard
    }  elseif ($user->role_id == 4 ) {
        return redirect()->route('career'); // Redirect to HR dashboard
    }

    // Default redirection if no specific role match
    return redirect()->route('career');
}




    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Correct way to redirect to the homepage
    }
}
