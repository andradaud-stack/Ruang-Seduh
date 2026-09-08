<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use App\Modules\Categories\Models\Categories;
use App\Modules\Menus\Models\Menus;
use App\Modules\Order_items\Models\Order_items;
use App\Modules\Orders\Models\Orders;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Tables\Models\Tables;
use App\Models\ServiceCall;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.auth.index');
    }
    public function showLogin()
{
    return view('customer.auth.login');
}
public function showRegister()
{
    return view('customer.auth.register');
}

    public function home(Request $request)
    {
        $categories  = Categories::orderBy('name')->get();
        $menus       = Menus::active()->with('kategori')->get();
        $tables      = Tables::orderBy('table_number')->get();

        // Check if query parameter specifies table (e.g. ?table=01, ?table=1, or ?table_id=3)
        if ($request->filled('table')) {
            $tableParam = (string) $request->get('table');
            $found = Tables::where('table_number', $tableParam)
                ->orWhere('table_number', str_pad($tableParam, 2, '0', STR_PAD_LEFT))
                ->orWhere('qr_token', $tableParam)
                ->first();
            if ($found) {
                session(['customer_table_id' => $found->id]);
                cookie()->queue(cookie()->make('customer_table_id', (string) $found->id, 60 * 24 * 7));
            }
        } elseif ($request->filled('table_id')) {
            $found = Tables::find($request->get('table_id'));
            if ($found) {
                session(['customer_table_id' => $found->id]);
                cookie()->queue(cookie()->make('customer_table_id', (string) $found->id, 60 * 24 * 7));
            }
        }

        $tableId = session('customer_table_id') ?? $request->cookie('customer_table_id');
        $activeTable = $tableId ? Tables::find($tableId) : null;

        // Auto-detect table from customer's active uncompleted orders if not in session/cookie
        if (!$activeTable && Auth::guard('customer')->check()) {
            $latestOrder = Orders::where('pengguna_id', Auth::guard('customer')->id())
                ->whereIn('status', ['menunggu_konfirmasi', 'diproses', 'siap_disajikan'])
                ->latest()
                ->first();
            if ($latestOrder && $latestOrder->table_id) {
                $activeTable = Tables::find($latestOrder->table_id);
                if ($activeTable) {
                    session(['customer_table_id' => $activeTable->id]);
                    cookie()->queue(cookie()->make('customer_table_id', (string) $activeTable->id, 60 * 24 * 7));
                }
            }
        }

        return view('customer.home', compact('categories', 'menus', 'tables', 'activeTable'));
    }

    public function show(Menus $menu)
    {
        if (! $menu->is_active) {
            abort(404);
        }

        return view('customer.menu.detail', compact('menu'));
    }

    public function profile()
    {
        $user = Auth::guard('customer')->user();

        return view('customer.profile.index', compact('user'));
    }

    public function showChangePassword()
    {
        return view('customer.profile.change-password');
    }

    public function orderHistory()
    {
        $user = Auth::guard('customer')->user();

        $orders = Orders::with(['orderItems', 'tabel'])
            ->where('pengguna_id', $user->id)
            ->latest()
            ->get();

        return view('customer.order.history', compact('orders'));
    }

    public function showOrder(Orders $order)
    {
        $user = Auth::guard('customer')->user();

        if ($order->pengguna_id !== $user->id) {
            abort(404);
        }

        return view('customer.order.detail', compact('order'));
    }

    public function getOrderStatus(Orders $order)
    {
        $user = Auth::guard('customer')->user();

        if ($order->pengguna_id !== $user->id) {
            abort(404);
        }

        $statusStage = [
            'menunggu_konfirmasi' => 0,
            'diproses'            => 1,
            'siap_disajikan'      => 2,
            'selesai'             => 3,
            'dibatalkan'          => -1,
        ];

        return response()->json([
            'status' => $order->status,
            'stage' => $statusStage[$order->status] ?? -1,
            'updated_at' => $order->updated_at,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::guard('customer')->user();

        return view('customer.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var Pengguna $user */
        $user = Auth::guard('customer')->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:pengguna,email,' . $user->id],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('customer.profile.index')->with('message_success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        /** @var Pengguna $user */
        $user = Auth::guard('customer')->user();

        if (! $user || ! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi lama tidak sesuai.'])->withInput();
        }

        $user->password = $request->password;
        $user->save();

        return redirect()->route('customer.profile.index')->with('message_success', 'Kata sandi berhasil diubah.');
    }

    public function scanTableQr(string $token)
    {
        $table = Tables::where('qr_token', $token)
            ->orWhere('table_number', $token)
            ->orWhere('table_number', str_pad($token, 2, '0', STR_PAD_LEFT))
            ->firstOrFail();

        session(['customer_table_id' => $table->id]);
        cookie()->queue(cookie()->make('customer_table_id', (string) $table->id, 60 * 24 * 7));

        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.home')->with('message_success', 'Terhubung ke Meja ' . $table->table_number);
        }

        return redirect()->route('customer.login', ['table_id' => $table->id])
            ->with('message_info', 'Meja ' . $table->table_number . ' terdeteksi. Silakan login untuk memesan.');
    }

    public function setTable(Request $request)
    {
        $request->validate([
            'table_id' => ['required', 'exists:tables,id'],
        ]);

        $table = Tables::findOrFail($request->table_id);
        session(['customer_table_id' => $table->id]);
        cookie()->queue(cookie()->make('customer_table_id', (string) $table->id, 60 * 24 * 7));

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'table'   => $table,
                'message' => 'Berhasil terhubung ke Meja ' . $table->table_number,
            ]);
        }

        return back()->with('message_success', 'Terhubung ke Meja ' . $table->table_number);
    }

    public function cartIndex()
    {
        $cart = session('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('customer.cart.index', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id'  => ['required', 'integer', 'exists:menus,id'],
            'variant'     => ['nullable', 'string', 'max:50'],
            'sugar_level' => ['nullable', 'string', 'max:50'],
            'notes'       => ['nullable', 'string', 'max:255'],
        ]);

        $menu = Menus::findOrFail($request->product_id);

        if (! $menu->is_active || $menu->stock <= 0) {
            return back()->with('message_error', 'Menu sedang tidak tersedia.');
        }

        $variant    = $request->input('variant');
        $sugarLevel = $request->input('sugar_level');
        $notes      = $request->input('notes');

        $customSignature = ($variant ?? 'DEFAULT') . '|' . ($sugarLevel ?? 'DEFAULT') . '|' . trim($notes ?? '');
        $key = $menu->id . '_' . substr(md5($customSignature), 0, 8);

        $cart = session('cart', []);
        $currentQty = $cart[$key]['qty'] ?? 0;

        if ($currentQty + 1 > $menu->stock) {
            return back()->with('message_error', 'Stok tidak cukup untuk menambah item ini.');
        }

        if (isset($cart[$key])) {
            $cart[$key]['qty']++;
        } else {
            $cart[$key] = [
                'menu_id'     => $menu->id,
                'name'        => $menu->name,
                'variant'     => $variant,
                'sugar_level' => $sugarLevel,
                'notes'       => $notes,
                'price'       => $menu->price,
                'qty'         => 1,
                'image'       => $menu->image,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('customer.cart.index');
    }

    public function cartUpdate(Request $request)
    {
        $key  = $request->input('key');
        $qty  = max(0, (int) $request->input('qty'));
        $cart = session('cart', []);

        if (isset($cart[$key])) {
            $menu = Menus::find($cart[$key]['menu_id']);

            if ($menu && $qty > $menu->stock) {
                return back()->with('message_error', 'Stok menu tidak cukup untuk kuantitas yang diminta.');
            }

            if ($qty <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = $qty;
            }
        }

        session(['cart' => $cart]);

        return back();
    }

    public function checkoutIndex()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.cart.index')->with('message_error', 'Keranjang masih kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $selectedTableId = session('customer_table_id') ?? request()->cookie('customer_table_id');
        $tableOptions = Tables::orderBy('table_number')->pluck('table_number', 'id');

        return view('customer.checkout.index', compact('cart', 'total', 'selectedTableId', 'tableOptions'));
    }

    public function checkoutStore(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.cart.index')->with('message_error', 'Keranjang masih kosong.');
        }

        $request->validate([
            'table_id'          => ['required', 'exists:tables,id'],
            'metode_pembayaran' => ['required', 'string', 'max:50'],
            'catatan'           => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($cart as $item) {
            $menu = Menus::find($item['menu_id']);

            if (! $menu || $menu->stock <= 0 || $item['qty'] > $menu->stock) {
                return redirect()->route('customer.cart.index')->with('message_error', 'Stok untuk ' . ($item['name'] ?? 'menu') . ' tidak cukup.');
            }
        }

        $table = Tables::findOrFail($request->table_id);
        session(['customer_table_id' => $table->id]);
        cookie()->queue(cookie()->make('customer_table_id', (string) $table->id, 60 * 24 * 7));

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = DB::transaction(function () use ($cart, $request, $table, $total) {
            $orderData = [
                'pengguna_id'       => Auth::guard('customer')->id(),
                'table_id'          => $table->id,
                'status'            => 'menunggu_konfirmasi',
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => 'belum_bayar',
                'total'             => $total,
                'catatan'           => $request->input('catatan'),
            ];

            if (Schema::hasColumn('orders', 'user_id')) {
                $orderData['user_id'] = (string) Auth::guard('customer')->id();
            }

            $order = Orders::create($orderData);

            foreach ($cart as $item) {
                $notesParts = [];
                if (!empty($item['variant'])) {
                    $notesParts[] = $item['variant'];
                }
                if (!empty($item['sugar_level'])) {
                    $notesParts[] = 'Gula: ' . $item['sugar_level'];
                }
                if (!empty($item['notes'])) {
                    $notesParts[] = 'Catatan: ' . $item['notes'];
                }
                $itemNotes = !empty($notesParts) ? implode(' · ', $notesParts) : null;

                Order_items::create([
                    'order_id'  => $order->id,
                    'menu_id'   => $item['menu_id'],
                    'menu_name' => $item['name'],
                    'price'     => $item['price'],
                    'qty'       => $item['qty'],
                    'subtotal'  => $item['price'] * $item['qty'],
                    'notes'     => $itemNotes,
                ]);

                $menu = Menus::find($item['menu_id']);
                if ($menu) {
                    $menu->decrement('stock', $item['qty']);
                }
            }

            return $order;
        });

        session()->forget('cart');
        session(['customer_table_id' => $table->id]);

        return redirect()->route('customer.order.detail', $order->id)->with('message_success', 'Pesanan berhasil dibuat.');
    }

    public function callWaiter(Request $request)
    {
        $request->validate([
            'table_id' => ['nullable', 'exists:tables,id'],
            'type'     => ['required', 'string', 'in:panggil_pelayan,minta_bill,minta_air,bersih_meja,lainnya'],
            'notes'    => ['nullable', 'string', 'max:255'],
        ]);

        $tableId = $request->table_id ?? session('customer_table_id');
        if (!$tableId) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan scan QR meja terlebih dahulu atau pilih nomor meja.',
            ], 422);
        }

        $call = ServiceCall::create([
            'table_id'    => $tableId,
            'pengguna_id' => Auth::guard('customer')->id(),
            'type'        => $request->type,
            'notes'       => $request->notes,
            'status'      => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Panggilan berhasil dikirim! Pelayan kami segera menuju ke mejamu.',
            'data'    => $call,
        ]);
    }

    public function getCallWaiterStatus()
    {
        $tableId = session('customer_table_id');
        if (!$tableId) {
            return response()->json(['active' => false]);
        }

        $call = ServiceCall::where('table_id', $tableId)
            ->where('status', 'pending')
            ->latest()
            ->first();

        return response()->json([
            'active' => (bool) $call,
            'call'   => $call,
        ]);
    }
}