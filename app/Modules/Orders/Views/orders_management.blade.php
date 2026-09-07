@extends('layouts.app')

@section('page-css')
<style>
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .status-menunggu_konfirmasi {
        background-color: #fef3c7;
        color: #92400e;
    }
    .status-diproses {
        background-color: #dbeafe;
        color: #0c4a6e;
    }
    .status-siap_disajikan {
        background-color: #c7d2fe;
        color: #312e81;
    }
    .status-selesai {
        background-color: #dcfce7;
        color: #166534;
    }
    .status-dibatalkan {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .order-card {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        background: white;
    }
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    .order-info-item {
        display: flex;
        flex-direction: column;
    }
    .order-info-label {
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    .order-info-value {
        color: #1f2937;
    }
    .order-items {
        background: #f9fafb;
        padding: 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e5e7eb;
    }
    .order-item:last-child {
        border-bottom: none;
    }
    .order-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .status-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .status-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .status-btn-primary {
        background-color: #3b82f6;
        color: white;
    }
    .status-btn-primary:hover {
        background-color: #2563eb;
    }
    .status-btn-secondary {
        background-color: #e5e7eb;
        color: #374151;
    }
    .status-btn-secondary:hover {
        background-color: #d1d5db;
    }
</style>
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row align-items-end mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <p class="kt-eyebrow mb-1">Pesanan Customer</p>
                <h3 class="mb-0">Manajemen Status Pesanan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Management</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        @include('include.flash')

        @if(isset($serviceCalls) && $serviceCalls->count() > 0)
            <div class="card mb-4" style="border: 2px solid #e07a5f; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(224, 122, 95, 0.15);">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: #fdf5ee; border-bottom: 1px solid #fed7aa;">
                    <h5 class="card-title mb-0" style="color: #9a3412;">
                        🛎️ Panggilan Meja Menunggu
                        <span class="badge bg-danger ms-2" style="font-size: 0.85rem;">{{ $serviceCalls->count() }} Permintaan</span>
                    </h5>
                    <small class="text-muted">Perlu respon staf / pelayan segera</small>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($serviceCalls as $call)
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge bg-dark" style="font-size: 0.9rem;">Meja {{ $call->tabel->table_number ?? $call->table_id }}</span>
                                        <strong style="color: #c2410c; font-size: 0.95rem;">{{ $call->type_label }}</strong>
                                        <small class="text-muted">({{ $call->created_at->diffForHumans() }})</small>
                                    </div>
                                    <div class="text-muted small">
                                        Pelanggan: <strong>{{ $call->pengguna->name ?? 'Tamu' }}</strong>
                                        @if(!empty($call->notes))
                                            &bull; Catatan: <span class="fst-italic text-dark fw-semibold">"{{ $call->notes }}"</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('orders.resolve-service-call', $call->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success fw-bold px-3 py-2" onclick="return confirm('Tandai panggilan meja ini selesai dilayani?')">
                                            ✓ Layani & Selesai
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Pesanan</h5>
            </div>
            <div class="card-body">
                @forelse($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <h5 class="mb-1">Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h5>
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                            <div>
                                <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>

                        <div class="order-info">
                            <div class="order-info-item">
                                <span class="order-info-label">Pelanggan</span>
                                <span class="order-info-value">{{ $order->pengguna->name ?? '-' }}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="order-info-label">Meja</span>
                                <span class="order-info-value">Meja {{ $order->tabel->table_number ?? '-' }}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="order-info-label">Metode Pembayaran</span>
                                <span class="order-info-value">{{ ucfirst($order->metode_pembayaran ?? '-') }}</span>
                            </div>
                            <div class="order-info-item">
                                <span class="order-info-label">Total</span>
                                <span class="order-info-value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="order-items">
                            <strong>Menu yang dipesan:</strong>
                            @forelse($order->orderItems as $item)
                                <div class="order-item">
                                    <div>
                                        <span>{{ $item->menu_name }} x{{ $item->qty }}</span>
                                        @if(!empty($item->notes))
                                            <div style="font-size: 0.8rem; color: #b45309; font-style: italic; margin-top: 2px;">
                                                🔍 {{ $item->notes }}
                                            </div>
                                        @endif
                                    </div>
                                    <span>Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                                </div>
                            @empty
                                <p class="mb-0">Tidak ada item</p>
                            @endforelse

                            @if(!empty($order->catatan))
                                <div style="margin-top: 8px; padding-top: 8px; border-top: 1px dashed #cbd5e1; font-size: 0.85rem; color: #475569;">
                                    <strong>Catatan Pesanan:</strong> "{{ $order->catatan }}"
                                </div>
                            @endif
                        </div>

                        <div class="order-actions">
                            @if($order->status === 'menunggu_konfirmasi')
                                <form action="{{ route('orders.update-status', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="diproses">
                                    <button type="submit" class="status-btn status-btn-primary" onclick="return confirm('Terima pesanan ini?')">
                                        ✓ Terima Pesanan
                                    </button>
                                </form>
                            @elseif($order->status === 'diproses')
                                <form action="{{ route('orders.update-status', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="siap_disajikan">
                                    <button type="submit" class="status-btn status-btn-primary">
                                        ✓ Siap Disajikan
                                    </button>
                                </form>
                            @elseif($order->status === 'siap_disajikan')
                                <form action="{{ route('orders.update-status', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="status-btn status-btn-primary">
                                        ✓ Selesai
                                    </button>
                                </form>
                            @endif

                            @if($order->status !== 'selesai' && $order->status !== 'dibatalkan')
                                <form action="{{ route('orders.update-status', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="dibatalkan">
                                    <button type="submit" class="status-btn status-btn-secondary" onclick="return confirm('Batalkan pesanan ini?')">
                                        ✗ Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info" role="alert">
                        <strong>Tidak ada pesanan!</strong> Semua pesanan sudah diproses.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection
