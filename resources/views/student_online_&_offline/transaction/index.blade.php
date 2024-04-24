@extends('student_online.layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Riwayat Transaksi</h4>
                <nav aria-label="breadcrumb mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted " href="/siswa-offline">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Riwayat Transaksi</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="{{ asset('assets-user/dist/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-none border table-responsive">
    <table class="table" aria-labelledby="title">
        <thead>
            <tr>
                <th scope="col">ID Transaksi</th>
                <th scope="col">Tanggal Terbit</th>
                <th scope="col">Tenggat Waktu</th>
                <th scope="col">Nominal</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
            <tr>
                <th>
                    <a href="{{ route('transaction-history.detail', $transaction->transaction_id) }}">#{{ $transaction->transaction_id }}</a>
                </th>
                <td>{{ $transaction->issued_at->locale('id_ID')->isoFormat('dddd, D MMMM Y HH:mm \W\I\B') }}</td>
                <td>{{ $transaction->expired_at->locale('id_ID')->isoFormat('dddd, D MMMM Y HH:mm \W\I\B') }}</td>
                <td>@currency($transaction->amount)</td>
                <td>
                    @php
                        $status = strtoupper($transaction->status);
                        $refs = match ($status) {
                            'PENDING' => \App\Enum\TransactionStatusEnum::PENDING,
                            'PAID' => \App\Enum\TransactionStatusEnum::PAID,
                            'CANCELLED' => \App\Enum\TransactionStatusEnum::CANCELLED,
                            'EXPIRED' => \App\Enum\TransactionStatusEnum::EXPIRED,
                            'FAILED' => \App\Enum\TransactionStatusEnum::FAILED,
                            'REFUND' => \App\Enum\TransactionStatusEnum::REFUND,
                            'UNPAID' => \App\Enum\TransactionStatusEnum::UNPAID,
                            default => \App\Enum\TransactionStatusEnum::DEFAULT
                        };
                    @endphp
                    <span class="badge bg-{{ $refs->color() }}">{{ $refs->label() }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="text-center">
                        <img src="{{ asset('assets-user/dist/images/products/empty-shopping-bag.gif') }}" alt="No Data" height="150px" width="auto" />
                        <h3>Tidak Ada Data</h3>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-4">
        {!! $transactions->links() !!}
    </div>
</div>
@endsection
