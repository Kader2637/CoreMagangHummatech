@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-sm-4">
                    <div class="bg-dark-subtle">
                        <ul class="nav nav-pills custom-nav nav-justified"role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all"
                                    type="button" role="tab" aria-controls="all" aria-controls="all"
                                    aria-selected="true" data-position="0">
                                    Semua
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="free-tab" data-bs-toggle="pill" data-bs-target="#free"
                                    type="button" role="tab" aria-controls="free" aria-selected="false"
                                    data-position="1" tabindex="-1">
                                    Berlangganan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="paid-tab" data-bs-toggle="pill" data-bs-target="#paid"
                                    type="button" role="tab" aria-controls="paid" aria-selected="false"
                                    data-position="2" tabindex="-1">
                                    Berbayar
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-auto col-xl-4 ms-auto d-flex gap-2 justify-content-end">
                    <form class="app-search w-75" action="/administrator/course">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Cari..." autocomplete="off" id="search-options" value="{{ request()->title }}" name="title">
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                        </div>
                    </form>
                    <div class="list-grid-nav hstack gap-1">
                        <button class="btn btn-secondary  shadow-none" data-bs-toggle="modal" data-bs-target="#add">
                            Tambah
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="tab-content">
        <div id="all" class="tab-pane fade show active">
            <div class="row ">
                @forelse ($courses as $course)
                    <div class="col-xl-3">
                        <div class="card ribbon-box border shadow-none mb-lg-0">
                            <div class="card-body">
                                <span
                                    class="ribbon-three {{ $course->price == null ? 'ribbon-three-success' : 'ribbon-three-secondary' }}  material-shadow"><span>{{ $course->status == 'subcribe' ? 'Berlangganan' : Transaction::currencyFormatter($course->price  ) }}</span></span>
                                <img class="card-img-top img-responsive w-100"
                                    src="{{ asset('storage/' . $course->image) }}" style="object-fit: cover;" width="20em"
                                    height="170em" alt="Card image cap" />
                                <div class="d-flex justify-content-end px-3 mb-4" style="margin-top: -45px">
                                    <div class="px-2 py-1 rounded-2 rounded" style="background: #fff; font-size: 15px;">
                                        {{ $course->division->name }}</div>
                                </div>
                                <a href="/administrator/course/detail" style="font-size: 18px" class="text-dark">
                                    {{ $course->title }}
                                </a>
                                <p class="text-muted my-2">{{ Str::limit($course->description, 100) }}</p>
                                <div class="d-flex pt-3 gap-2">
                                    <a href="/administrator/course/detail/{{ $course->id }}"
                                        class="btn btn-secondary flex-fill d-flex align-items-center justify-content-center">
                                        Lihat Detail
                                    </a>
                                    <button class="py-1 btn btn-soft-warning btn-edit" type="button"
                                        data-id="{{ $course->id }}" data-title="{{ $course->title }}"
                                        data-description="{{ $course->description }}"
                                        data-division="{{ $course->division_id }}" data-status="{{ $course->status }}" data-price="{{ $course->price }}" data-image="{{ $course->image }}">
                                        <i class="ri-pencil-line fs-3"></i>
                                    </button>
                                    <button class="py-1 btn btn-soft-danger btn-delete" type="button" data-id="{{ $course->id }}">
                                        <i class=" ri-delete-bin-5-line fs-3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex justify-content-center mb-2 mt-5">
                        <img src="{{ asset('no data.png') }}" alt="" width="300px" srcset="">
                    </div>
                    <p class="fs-5 text-dark text-center">
                        Data Masih Kosong
                    </p>
                @endforelse
            </div>
        </div>

        <div id="free" class="tab-pane fade">
            <div class="row ">
                @forelse ($courses as $course)
                    @if ($course->status === 'subcribe')
                        <div class="col-xl-3">
                            <div class="card ribbon-box border shadow-none mb-lg-0">
                                <div class="card-body">
                                    <span
                                        class="ribbon-three {{ $course->price == null ? 'ribbon-three-success' : 'ribbon-three-secondary' }}  material-shadow"><span>{{ $course->status == 'subcribe' ? 'Berlangganan' : 'Rp.' . number_format($course->price, 0, ',', '.') }}</span></span>
                                    <img class="card-img-top img-responsive w-100"
                                        src="{{ asset('storage/' . $course->image) }}" style="object-fit: cover;"
                                        width="20em" height="170em" alt="Card image cap" />
                                    <div class="d-flex justify-content-end px-3 mb-4" style="margin-top: -45px">
                                        <div class="px-2 py-1 rounded-2 rounded"
                                            style="background: #fff; font-size: 15px;">{{ $course->division->name }}</div>
                                    </div>
                                    <a href="/administrator/course/detail" style="font-size: 18px" class="text-dark">
                                        {{ $course->title }}
                                    </a>
                                    <p class="text-muted my-2">{{ Str::limit($course->description, 100) }}</p>
                                    <div class="d-flex pt-3 gap-2">
                                        <a href="/administrator/course/detail/{{ $course->id }}"
                                            class="btn btn-secondary flex-fill">
                                            Lihat detail
                                        </a>
                                        <button class="py-1 btn btn-soft-warning btn-edit" data-id="{{ $course->id }}"
                                            data-title="{{ $course->title }}"
                                            data-description="{{ $course->description }}"
                                            data-division="{{ $course->division_id }}"
                                            data-status="{{ $course->status }}"
                                            data-image="{{ $course->image }}">
                                            <i class="ri-pencil-line fs-3"></i>
                                        </button>
                                        <button class="py-1 btn btn-soft-danger btn-delete" type="button" data-id="{{ $course->id }}">
                                            <i class=" ri-delete-bin-5-line fs-3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <div class="d-flex justify-content-center mb-2 mt-5">
                        <img src="{{ asset('no data.png') }}" alt="" width="300px" srcset="">
                    </div>
                    <p class="fs-5 text-dark text-center">
                        Data Masih Kosong
                    </p>
                @endforelse
            </div>
        </div>

        <div id="paid" class="tab-pane fade">
            <div class="row">
                @php
                    $foundPaidCourse = false;
                @endphp

                @forelse ($courses as $course)
                    @if ($course->status === 'paid')
                        @php
                            $foundPaidCourse = true;
                        @endphp
                        <div class="col-xl-3">
                            <div class="card ribbon-box border shadow-none mb-lg-0">
                                <div class="card-body">
                                    <span
                                        class="ribbon-three {{ $course->price == null ? 'ribbon-three-success' : 'ribbon-three-secondary' }}  material-shadow"><span>{{ $course->price == null ? 'Gratis' : 'Rp.' . number_format($course->price, 0, ',', '.') }}</span></span>
                                    <img class="card-img-top img-responsive w-100"
                                        src="{{ asset('storage/' . $course->image) }}" style="object-fit: cover;"
                                        width="20em" height="170em" alt="Card image cap" />
                                    <div class="d-flex justify-content-end px-3 mb-4" style="margin-top: -45px">
                                        <div class="px-2 py-1 rounded-2 rounded"
                                            style="background: #fff; font-size: 15px;">
                                            {{ $course->division->name }}</div>
                                    </div>
                                    <a href="/administrator/course/detail" style="font-size: 18px" class="text-dark">
                                        {{ $course->title }}
                                    </a>
                                    <p class="text-muted my-2">{{ Str::limit($course->description, 100) }}</p>
                                    <div class="d-flex pt-3 gap-2">
                                        <a href="/administrator/course/detail/{{ $course->id }}"
                                            class="btn btn-secondary flex-fill">
                                            Lihat detail
                                        </a>
                                        <button class="py-1 btn btn-soft-warning btn-edit" type="button"
                                            data-id="{{ $course->id }}" data-title="{{ $course->title }}"
                                            data-description="{{ $course->description }}"
                                            data-division="{{ $course->division_id }}"
                                            data-status="{{ $course->status }}"
                                            data-image="{{ $course->image }}">
                                            <i class="ri-pencil-line fs-3"></i>
                                        </button>
                                        <button class="py-1 btn btn-soft-danger btn-delete" type="button" data-id="{{ $course->id }}">
                                            <i class=" ri-delete-bin-5-line fs-3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    @if (!$foundPaidCourse)
                        <div class="d-flex justify-content-center mb-2 mt-5">
                            <img src="{{ asset('no data.png') }}" alt="" width="300px" srcset="">
                        </div>
                        <p class="fs-5 text-dark text-center">
                            Data
                    @endif
                @endforelse
            </div>
        </div>
    </div>
    {{-- {{ $courses->links() }} --}}


    <!-- Add Modal -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title">Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Judul materi">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control" placeholder="Masukkan deskripsi"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="divisi" class="col-form-label">Divisi</label>
                            <select
                                class="tambah js-example-basic-single form-control @error('divisi') is-invalid @enderror"
                                aria-label=".form-select example" name="division_id">
                                <option value="">Pilih divisi</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Jenis Materi</label>
                            <div class="d-flex gap-2 type-button align-items-center">
                                @foreach (\App\Enum\StatusCourseEnum::cases() as $status)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="studentSelect" type="radio" name="status"
                                            id="{{ $status->value }}" value="{{ $status->value }}">
                                        <label class="form-check-label"
                                            for="{{ $status->value }}">{{ $status->label() }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 price" id="price" style="display: none;">
                            <label for="priceInput">Harga</label>
                            <input type="number" name="price" id="price" placeholder="Masukan harga"
                                class="form-control">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image">Foto materi</label>
                            <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" />
                            <div id="imagePreview" class="mt-2"></div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-soft-dark" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-update" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" placeholder="Judul materi" id="title-edit">
                        </div>
                        <div class="mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control" id="description-edit"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="divisi" class="col-form-label">Divisi</label>
                            <select
                                class="tambah js-example-basic-single1 form-control @error('divisi') is-invalid @enderror"
                                aria-label=".form-select example" id="division-edit" name="division_id">
                                <option value="">Pilih divisi</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <div>
                                @foreach (\App\Enum\StatusCourseEnum::cases() as $status)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input status-edit" id="studentSelect1" type="radio"
                                            name="status" id="{{ $status->value }}" value="{{ $status->value }}">
                                        <label class="form-check-label"
                                            for="{{ $status->value }}">{{ $status->label() }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 price" id="price-edit" style="display: none;">
                            <label for="priceInput">Harga</label>
                            <input type="number" name="price" id="price-edit-input" placeholder="Masukan harga"
                                class="form-control">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image">Foto materi</label>
                            <input type="file" name="image" id="" class="form-control">
                            <div id="imagePreview-edit" class="mt-2">
                                <img src="" id="image-edit" class="img-thumbnail" alt="">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-soft-dark" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.delete-modal-component')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".js-example-basic-single").select2({
                dropdownParent: $("#add")
            });
        });
        $(document).ready(function() {
            $(".js-example-basic-single1").select2({
                dropdownParent: $("#modal-edit")
            });
        });
    </script>

    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    imagePreview.innerHTML = '';
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = '';
            }
        });
    </script>
    <script>
        var studentSelect = document.getElementById('studentSelect');

        studentSelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];

            this.removeChild(selectedOption);
        });

        $(document).ready(function() {
            $('input[type=radio][name=status]').change(function() {
                if (this.value === 'paid') {
                    $('#price').show();
                } else {
                    $('#price').hide();
                }
            });
        });
        $(document).ready(function() {
            $('input[type=radio][name=status]').change(function() {
                if (this.value === 'paid') {
                    $('#price-edit').show();
                } else {
                    $('#price-edit').hide();
                }
            });
        });
    </script>

    <script>
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var division = $(this).data('division');
            var status = $(this).data('status');
            var price = $(this).data('price');
            var image = $(this).data('image');

            $('#form-update').attr('action', '/administrator/course/' + id);
            $('#title-edit').val(title);
            $('#division-edit').val(division);
            $('#description-edit').val(description);
            $('#division-edit').val(division).trigger('change');
            $('.status-edit').each(function() {
                if ($(this).val() === status) {
                    $(this).prop('checked', true);
                }
            });
            $('#image-edit').attr('src', '/storage/' + image);

            if(status === 'paid' || price > 0) {
                $('#price-edit').show();
                $('#price-edit-input').val(price);
            } else {
                $('#price-edit').hide();
            }


            $('#modal-edit').modal('show');
        });

        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/administrator/course/delete/' + id);
            $('#modal-delete').modal('show');
        });

    </script>
@endsection
