<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Tables\Models\Tables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class CustomerAuthController extends Controller
{
    /**
     * Show the customer login page.
     */
    public function showLogin(): View
    {
        return view('customer.auth.login');
    }

    /**
     * Handle an incoming customer authentication request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $tableNumber = $request->input('table');
        $tableId = $request->input('table_id')
            ?? $request->session()->get('customer_table_id')
            ?? $request->cookie('customer_table_id');

        if (!$tableNumber && $tableId) {
            $tbl = Tables::find($tableId);
            $tableNumber = $tbl ? $tbl->table_number : null;
        }

        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if ($tableId) {
                $request->session()->put('customer_table_id', $tableId);
                cookie()->queue(cookie()->make('customer_table_id', (string) $tableId, 60 * 24 * 7));
            }

            if ($tableNumber) {
                return redirect()->route('customer.home', ['table' => $tableNumber]);
            }

            return redirect()->intended(route('customer.home'));
        }
        return back()->withErrors([
            'email' => 'Kredensial yang dimasukkan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Show the customer registration page.
     */
    public function showRegister(): View
    {
        return view('customer.auth.register');
    }

    /**
     * Handle an incoming customer registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('pengguna', 'email')->whereNull('deleted_at')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Pengguna::withTrashed()->where('email', $request->email)->forceDelete();

        $pengguna = Pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user',
        ]);

        $tableNumber = $request->input('table');
        $tableId = $request->input('table_id')
            ?? $request->session()->get('customer_table_id')
            ?? $request->cookie('customer_table_id');

        if (!$tableNumber && $tableId) {
            $tbl = Tables::find($tableId);
            $tableNumber = $tbl ? $tbl->table_number : null;
        }

        Auth::guard('customer')->login($pengguna);

        $request->session()->regenerate();

        if ($tableId) {
            $request->session()->put('customer_table_id', $tableId);
            cookie()->queue(cookie()->make('customer_table_id', (string) $tableId, 60 * 24 * 7));
        }

        if ($tableNumber) {
            return redirect()->route('customer.home', ['table' => $tableNumber]);
        }

        return redirect()->route('customer.home');
    }

    /**
     * Destroy an authenticated customer session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request): RedirectResponse
    {
        if ($request->filled('table')) {
            session(['customer_table_number' => $request->get('table')]);
            cookie()->queue(cookie()->make('customer_table_number', (string) $request->get('table'), 60 * 60));
        }
        if ($request->filled('table_id')) {
            session(['customer_table_id' => $request->get('table_id')]);
            cookie()->queue(cookie()->make('customer_table_id', (string) $request->get('table_id'), 60 * 24 * 7));
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('customer.login')->withErrors([
                'email' => 'Gagal masuk dengan Google. Silakan coba lagi.',
            ]);
        }

        $pengguna = Pengguna::withTrashed()
            ->where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($pengguna) {
            if ($pengguna->trashed()) {
                $pengguna->restore();
            }

            $pengguna->update([
                'name'      => $googleUser->getName() ?: $pengguna->name,
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);
        } else {
            $pengguna = Pengguna::create([
                'name'      => $googleUser->getName() ?: 'Customer',
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'role'      => 'user',
            ]);
        }

        $savedTableNumber = request()->session()->get('customer_table_number')
            ?? request()->cookie('customer_table_number');
        $savedTableId = request()->session()->get('customer_table_id')
            ?? request()->cookie('customer_table_id');

        if (!$savedTableNumber && $savedTableId) {
            $tbl = Tables::find($savedTableId);
            $savedTableNumber = $tbl ? $tbl->table_number : null;
        }

        Auth::guard('customer')->login($pengguna, true);
        request()->session()->regenerate();

        if ($savedTableId) {
            request()->session()->put('customer_table_id', $savedTableId);
            cookie()->queue(cookie()->make('customer_table_id', (string) $savedTableId, 60 * 24 * 7));
        }

        if ($savedTableNumber) {
            return redirect()->route('customer.home', ['table' => $savedTableNumber]);
        }

        return redirect()->intended(route('customer.home'));
    }
}
