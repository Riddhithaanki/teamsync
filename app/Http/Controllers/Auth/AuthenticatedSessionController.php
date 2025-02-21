<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isHR()) {
                return redirect()->route('hr.dashboard');
            } elseif ($user->isTechLead()) {
                return redirect()->route('techlead.dashboard');
            } elseif ($user->isDeveloper()) {
                return redirect()->route('developer.dashboard');
            }

            return redirect()->route('dashboard'); // Default fallback
        }

        return back()->withErrors(['email' => 'Invalid login credentials']);
    }
}
