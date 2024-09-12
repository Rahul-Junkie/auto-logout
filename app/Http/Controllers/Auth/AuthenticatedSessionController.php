<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session ID to prevent session fixation attacks
        $request->session()->regenerate();

        // Get the current authenticated user
        $user = Auth::user();

        // Get the current session ID
        $currentSessionId = Session::getId();

        // If the current session ID is different from the one stored in the database, force logout from other devices
        if ($user->current_session_id && $user->current_session_id !== $currentSessionId) {
            $this->emitLogoutEvent($user->id); // Notify other devices using Socket.IO
        }

        // Update the user's current_session_id
        $user->current_session_id = $currentSessionId;
        $user->save();

        // Redirect to the intended location after login
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    private function emitLogoutEvent($userId)
    {
        // Make an HTTP request to the Socket.IO server to emit a logout event
        Http::post('http://localhost:3001/emitLogout', [
            'userId' => $userId
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login'); // Redirect to the login page after logout
    }
}
