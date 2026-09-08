@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row align-items-end mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <p class="kt-eyebrow mb-1">Data Management</p>
                <h3 class="mb-0">{{ $title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card kt-table-card">
            <div class="card-body">
                <div class="row align-items-center mb-3 g-2">
                    <div class="col-12 col-md-9">
                        <form action="{{ route('orders.index') }}" method="get">
                            <div class="form-group has-icon-left position-relative kt-search-input">
                                <input type="text" class="form-control rounded-pill" value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                <div class="form-control-icon"><i class="fa fa-search"></i></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3 text-md-end">
						{!! button('orders.create', $title) !!}
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table table-hover align-middle kt-table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <td>User Id</td>
								<td>Table Id</td>
								<td>Status</td>
								<td>Metode Pembayaran</td>
								<td>Status Pembayaran</td>
								<td>Total</td>
								
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = $data->firstItem(); @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $item->user_id ?? $item->pengguna_id ?? '-' }}</span>
                                        @if($item->pengguna)
                                            <small class="text-muted d-block">{{ $item->pengguna->name }}</small>
                                        @endif
                                    </td>
									<td>{{ $item->tabel->table_number ?? $item->table_id ?? '-' }}</td>
									<td>
                                        @php
                                            $statusMap = [
                                                'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
                                                'diproses' => 'Diproses',
                                                'siap_disajikan' => 'Siap Disajikan',
                                                'selesai' => 'Selesai',
                                                'dibatalkan' => 'Dibatalkan',
                                            ];
                                            $nextStatus = match($item->status) {
                                                'menunggu_konfirmasi' => 'diproses',
                                                'diproses' => 'siap_disajikan',
                                                'siap_disajikan' => 'selesai',
                                                default => null,
                                            };
                                        @endphp
                                        <span class="badge {{ $item->status === 'selesai' ? 'bg-light-success text-success' : 'bg-light-secondary text-secondary' }}">{{ $statusMap[$item->status] ?? ucfirst(str_replace('_', ' ', $item->status)) }}</span>
                                    </td>
									<td>{{ ucfirst($item->metode_pembayaran ?? '-') }}</td>
									<td>
                                        @php
                                            $isLunas = in_array($item->status_pembayaran, ['sudah_bayar', 'lunas']) || $item->status === 'selesai';
                                        @endphp
                                        <span class="badge {{ $isLunas ? 'bg-light-success text-success' : 'bg-light-warning text-warning' }} fw-bold">
                                            {{ $isLunas ? 'sudah_bayar' : ($item->status_pembayaran ?? 'belum_bayar') }}
                                        </span>
                                    </td>
									<td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
												
                                    <td>
                                        @if($nextStatus)
                                            <form action="{{ route('orders.update-status', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $nextStatus }}">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    {{ $item->status === 'menunggu_konfirmasi' ? 'Konfirmasi' : ($item->status === 'diproses' ? 'Siap Disajikan' : 'Selesai') }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                        <div class="mt-2">
                                            {!! button('orders.show','', $item->id) !!}
                                            {!! button('orders.edit', $title, $item->id) !!}
                                            {!! button('orders.destroy', $title, $item->id) !!}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center"><i>No data.</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
				{{ $data->links() }}
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection
