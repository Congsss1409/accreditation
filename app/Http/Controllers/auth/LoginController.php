<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // We still need the User model to log the user in locally

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application by calling the auth microservice.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Call the authentication microservice
        $response = Http::post('http://auth-service/api/login', [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        // Check if the login was unsuccessful
        if ($response->failed()) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // If login is successful, get the token from the response
        $tokenData = $response->json();
        
        // Find the user in the local database to create a session
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Log the user into the Laravel application's session management
            Auth::login($user);
            
            // Store the access token in the session
            $request->session()->put('api_token', $tokenData['access_token']);
            $request->session()->regenerate();

            return redirect()->intended(route('accreditation.dashboard'));
        }

        // Fails if the user exists in the auth service but not the main app DB
        return back()->withErrors([
            'email' => 'User not found in the application database.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
