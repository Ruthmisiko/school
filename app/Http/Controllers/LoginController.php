<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

              // Add the SweetAlert success message here
              $this->showSweetAlert('success', 'Welcome! Login successful');

              return redirect()->intended(route('pages.dashboard'));

        }

        $this->showSweetAlert('error', 'The provided credentials do not match our records.');

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::success('Goodbye!', 'You have been successfully logged out.');

        return redirect('/login');
    }
    // Function to show SweetAlert
    private function showSweetAlert($type, $message)
    {
        session()->flash('sweet_alert', [
            'type' => 'success', // or any other SweetAlert type
            'message' => 'Welcome! Login successful',
        ]);
    }
}
