@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('orders.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card kt-detail-card">
            <div class="card-header">
                Detail Data {{ $title }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row kt-detail-grid">
                            <div class='col-lg-2'><p>User Id</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $orders->user_id }}</p></div>
									<div class='col-lg-2'><p>Table Id</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $orders->table_id }}</p></div>
									<div class='col-lg-2'><p>Status</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $orders->status }}</p></div>
									<div class='col-lg-2'><p>Metode Pembayaran</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $orders->metode_pembayaran }}</p></div>
									<div class='col-lg-2'><p>Status Pembayaran</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $orders->status_pembayaran }}</p></div>
									<div class='col-lg-2'><p>Total</p></div><div class='col-lg-10'><p class='fw-bold'>Rp {{ number_format($orders->total, 0, ',', '.') }}</p></div>
									<div class='col-lg-2'><p>Catatan Pesanan</p></div><div class='col-lg-10'><p class='fw-bold text-muted'>{{ $orders->catatan ?? '-' }}</p></div>
									
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card kt-table-card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Order Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive col-12">
                    <table class="table table-hover align-middle kt-table" id="tableOrderItems">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Menu</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders->orderItems as $item)
                                <tr>
                                    <td>{{ $item->order_id }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $item->menu_name ?? ($item->menu->name ?? '-') }}</span>
                                        @if(!empty($item->notes))
                                            <div class="text-muted small fst-italic">{{ $item->notes }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="fw-bold">Rp {{ number_format($item->subtotal ?: ($item->price * $item->qty), 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3"><i>Tidak ada item pada pesanan ini.</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($orders->orderItems && $orders->orderItems->count() > 0)
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end fw-bold">Total:</th>
                                    <th class="fw-bold text-primary">Rp {{ number_format($orders->total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection
