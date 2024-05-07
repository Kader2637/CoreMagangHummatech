@extends('mentor.layouts.app')
@section('style')
    <style>
        @media (max-width: 767px) {
            #offcanvasRight {
                width: 100%;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #offcanvasRight {
                width: 50%;
            }
        }

        @media (min-width: 992px) {
            #offcanvasRight {
                width: 25%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-4 col-xl-2 col-sm-4">
            <form class="position-relative">
                <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Cari tim...">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
        </div>
        <div class="ms-auto text-end" style="margin-top: -38px">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add-team">
                Buat Tim
            </button>
        </div>
    </div>

    <div class="row  mt-5">
        @forelse ($teams as $team)
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-img-top">
                @if ($team->hummataskTeam != null && $team->hummataskTeam->image != null)
                    <img class="img-responsive w-100"
                        src="{{ asset('storage/' . $team->hummataskTeam->image) }}"
                        style="height: 100px; object-fit: cover; border-radius: 10px 10px 0px 0px" />
                @else
                    <img class="img-responsive w-100" src="{{ asset('bg-primary.png') }}"
                        style="height: 100px; object-fit: cover; border-radius: 10px 10px 0px 0px" />
                @endif
                <button type="button" class="bg-info rounded-1 text-white py-1 px-2 border-0 mt-2 btn-delete"
                    style="position: absolute; margin-left: -45px">
                    <i class="ti ti-trash fs-6"></i>
                </button>
            </div>
            <div class="d-flex justify-content-between px-3" style="margin-top: -20px">
                <div class="d-flex align-items-center">
                    <a href="#">
                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                            class="rounded-circle me-n4 card-hover border border-white" width="40"
                            height="40">
                    </a>
                    @foreach (App\Models\StudentTeam::where('hummatask_team_id', $team->id)->get() as $student)
                        <a href="#">
                            <img src="{{ asset('storage/' . $student->student->avatar) }}"
                                class="rounded-circle me-n4 card-hover border border-white" width="40"
                                height="40">
                        </a>
                    @endforeach
                </div>
                <div class="px-2 py-1 rounded-2 rounded text-capitalize"
                    style="background: #fff; font-size: 12px;">
                    {{ $team->categoryProject->name }}</div>
            </div>
            <div class="card-body px-3 mt-n3">
                <h4 class="text-capitalize">
                    {{ $team->project_id == null ? $team->name : $team->title }}</h4>
                @if ($team->project_id != null)
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, quisquam!</p>
                @else
                    <p class="text-muted">Tim ini belum mengerjakan sebuah project</p>
                @endif
                <a href="/mentor/team/detail" class="btn btn-primary col-12">Lihat detail</a>
            </div>
        </div>
    </div>
@empty
    <div class="mb-2 mt-5 text-center" style="margin: 0 auto;">
        <img src="{{ asset('empty-asset.png') }}" alt="" width="200px" srcset="">
        <p class="fs-5 text-dark">
            Belum Ada Team
        </p>
    </div>
@endforelse
    </div>

    <div class="modal fade" id="add-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-3" id="staticBackdropLabel">Buat Tim Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <div class="mx-3">
                                <label for="" class="mt-1 mb-1">Nama Tim</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama tim"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <label for="" class="mt-2 mb-1">Kategori projek</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height: 36px"
                                    name="category_project_id">
                                    <option>Pilih kategori projek</option>
                                    @forelse ($categoryProjects as $categoryProject)
                                        <option value="{{ $categoryProject->id }}">{{ $categoryProject->name }}</option>
                                    @empty
                                        <option>Belum ada kategori projek</option>
                                    @endforelse
                                </select>
                                @error('category_project_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <label for="" class="mt-2 mb-1">Ketua tim</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height: 36px"
                                    name="leader">
                                    <option>Pilih ketua tim</option>
                                    @forelse ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->student->name }}</option>
                                    @empty
                                        <option>Tidak ada siswa</option>
                                    @endforelse
                                </select>
                                @error('leader')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3 mt-2 col-md-12">
                                    <label for="bm-title">Anggota tim</label>
                                    <select class="select2 form-control custom-select" style="width: 100%; height: 36px"
                                        name="student_id[]">
                                        <option>Pilih anggota tim</option>
                                        @forelse ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->student->name }}</option>
                                        @empty
                                            <option>Tidak ada siswa</option>
                                        @endforelse
                                    </select>
                                    @error('student_id.*')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <div id="member"></div>

                                    <button type="button" class="btn add-button-trigger btn-primary mt-3">Tambah
                                        anggota</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.components.delete-modal-component')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/mentor/challenge/delete/' + id);
            $('#modal-delete').modal('show');
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        const deleteElement = (id) => $('#' + id).remove();

        (() => {
            $('.add-button-trigger').click((e) => {
                let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
                let target = $(e.target).parent().find('#member');
                target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                  <select class="select2 form-control custom-select" style="width: 100%; height: 36px" name="student_id[]">
                    <option>Pilih anggota tim</option>
                    @forelse ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->student->name }}</option>
                    @empty
                        <option>Tidak ada siswa</option>
                    @endforelse
                  </select>
                <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i class="fas fa-trash"></i></button>
                </div>`);
            });

            $('.btn-close').click((e) => {
                let target = $(e.target).parent('.modal').find('.delete-trigger');
                target.each((i, el) => $(el).click());
            });
        })();
    </script>
@endsection