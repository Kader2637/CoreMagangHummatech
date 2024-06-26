@extends(auth()->user()->hasRole('siswa-online') ? 'student_online.layouts.app' : 'student_offline.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Pesanan Saya</h4>
                    <nav aria-label="breadcrumb mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="{{ url('/login') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Pesanan Saya</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="https://pklhummatech.cakadi190.eu.org/assets-user/dist/images/breadcrumb/ChatBc.png"
                            alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3 mb-5 d-flex gap-3">
        <div class="status-wrapper">
            <select id="status" class="form-select">
                <option @if (!request()->get('status')) selected @endif value="">Semua Status</option>
                <option @if (request()->get('status') === 'Lunas') selected @endif value="Lunas">
                    Lunas</option>
            </select>
        </div>
        <div class="sort-wrapper">
            <select id="sort" class="form-select">
                <option>Terbaru</option>
                <option>Dari Lama</option>
            </select>
        </div>
    </div>

    <div class="row">
        @foreach ($transactions as $transaction)
            <div class="col-xl-4 col-xxl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="bg-primary text-white p-4 rounded">
                                <i class="fas fa-2x fa-book"></i>
                            </div>
                            <div>
                                <h5>{{ $transaction->product ? $transaction->product->name : $transaction->course->title }}
                                </h5>
                                <h3 class="text-primary fw-bolder mb-0">
                                    Rp {{ number_format( $transaction->product ? $transaction->product->price : $transaction->course->price, 0 ,',' ,'.') }}
                                </h3>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex gap-2 align-items-center w-100 py-3 justify-content-between">
                                <div class="mb-0 fw-bolder">Status</div>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-warning',
                                        'paid' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                        'expired' => 'bg-danger',
                                        'failed' => 'bg-danger',
                                        'refund' => 'bg-info',
                                        'unpaid' => 'bg-warning',
                                    ];
                                @endphp

                                <div class="mb-0">
                                    <span
                                        class="fw-bolder badge {{ $statusClasses[$transaction->status] ?? 'bg-secondary' }}">
                                        {{ $transaction->status }}
                                    </span>
                                </div>
                            </div>
                            {{-- @if (!$order->course) --}}
                            <div class="d-flex gap-2 align-items-center border-top w-100 py-3 justify-content-between">
                                {{-- @if ($order->transaction->status !== 'paid')
                                        <div class="mb-0 fw-bolder">Bayar Sebelum</div>
                                        <div class="text-center">
                                            {{ $order->transaction->expired_at->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                                        </div>
                                    @else --}}
                                <div class="mb-0 fw-bolder">Berakhir Pada</div>
                                <div class="text-center">
                                    Senin, 31 Agustus 2024
                                </div>
                                {{-- @endif --}}
                            </div>
                            {{-- @endif --}}
                            <div
                                class="d-flex gap-2 align-items-center w-100 p-3 pt-3 pb-0 border-top px-0 justify-content-between">
                                <div class="mb-0 fw-bolder">Jenis Produk</div>
                                <div class="mb-0">
                                    <h5 class="mb-0 fw-bolder">{{ $transaction->product ? 'Produk' : 'Materi' }}</h5>
                                </div>
                            </div>
                        </div>

                        <a href="{{ $transaction->product ? route('transaction-history.detail', $transaction->id) : route('transaction-history.course.detail', $transaction->id) }}"
                            class="btn btn-warning w-100 mt-3">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{--
    @if ($orders->hasPages())
        <div class="py-4">
            {{ $orders->links() }}
        </div>
    @endif --}}
@endsection

@section('script')
    <script>
        // Function to get query parameters from URL
        function getQueryParams() {
            return new URLSearchParams(window.location.search);
        }

        // Function to update URL
        function updateUrl() {
            const baseUrl = window.location.href.split('?')[0];
            const queryParams = getQueryParams();

            if (statusSelect.value !== '')
                queryParams.set('status', statusSelect.value);
            else
                queryParams.delete('status')

            if (sortSelect.value !== '')
                queryParams.set('sort', sortSelect.value);
            else
                queryParams.delete('sort')

            const newUrl = queryParams.size > 0 ? `${baseUrl}?${queryParams.toString()}` : baseUrl;

            // Update the URL
            window.location.href = newUrl;
        }

        // Selecting the elements
        const statusSelect = document.getElementById('status');
        const sortSelect = document.getElementById('sort');

        // Adding event listeners
        statusSelect.addEventListener('change', updateUrl);
        sortSelect.addEventListener('change', updateUrl);
    </script>
@endsection
