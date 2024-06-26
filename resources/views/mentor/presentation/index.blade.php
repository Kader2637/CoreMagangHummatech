@extends('mentor.layouts.app')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Presentasi</h4>
                    <nav aria-label="breadcrumb mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="/siswa-offline">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Presentasi</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets-user/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid note-has-grid">
        <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">

            <li class="nav-item">
                <a data-bs-toggle="tab" href="#monday" role="tab"
                    class="nav-link note-link d-flex align-items-center justify-content-center active px-3 px-md-3 me-0 me-md-2 text-body-color"
                    id="monday-tab">
                    <span class="d-none d-md-block font-weight-medium">Jadwal presentasi Hari ini</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="monday" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#settingLimitModalMonday">Setting Limit</button>
                        </div>
                    </div>
                    {{-- modal monday  --}}
                    <!--Limit Modal -->
                    <div class="modal fade" id="settingLimitModalMonday" tabindex="-1"
                        aria-labelledby="settingLimitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="settingLimitModalLabel">Setting Limit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('limitpresentation.store') }}">
                                        @csrf
                                        <input type="hidden" name="day" value="monday">
                                        <input type="hidden" name="mentor_id" value="{{ auth()->user()->mentor->id }}">
                                        <div class="mb-3">
                                            <label for="limitInput" class="form-label">Limit Presentasi</label>
                                            <input type="number" class="form-control" id="limitInput" name="limits"
                                                placeholder="Masukkan limit" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- end modal  --}}
                    <form action="{{ route('presentation.store') }}" method="POST" class="row g-3">
                        @csrf
                        @if ($limits)
                        <input type="hidden" name="mentor_id" value="{{ auth()->user()->mentor->id }}">
                        @for ($i = 0; $i < $limits->limits; $i++)
                            <div class="col-md-2 mb-4 pt-3">
                                <h5>Jadwal Ke {{ $i + 1 }}</h5>
                            </div>
                            <div class="col-md-5">
                                <label for="start-time-{{ $i }}" class="form-label">Waktu
                                    Mulai:</label>
                                <input type="time" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start-time-{{ $i }}" name="start_date[]"
                                    value="{{ old('start_date.' . $i, $presentations[$i]->start_date ?? '') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="end-time-{{ $i }}" class="form-label">Waktu
                                    Selesai:</label>
                                <input type="time" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end-time-{{ $i }}" name="end_date[]"
                                    value="{{ old('end_date.' . $i, $presentations[$i]->end_date ?? '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="schedule_to[]" value="Jadwal Ke {{ $i + 1 }}">
                        @endfor
                        @else
                        <div class="mb-2 mt-5 text-center" style="margin: 0 auto;">
                            <img src="{{ asset('empty-asset.png') }}" alt="" width="150px" srcset="">
                            <p class="fs-5 text-dark">
                                Data masih kosong
                            </p>
                        </div>
                        @endif
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary float-end">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
