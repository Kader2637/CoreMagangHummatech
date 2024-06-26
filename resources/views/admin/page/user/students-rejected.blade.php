@extends('admin.layouts.app')
@section('content')

<div class="col-sm-4 mt-2 mb-4">
    <h4 class="mx-3">Data Siswa Ditolak</h4>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3 d-flex justify-content-between">
                    <div class="col-sm-auto">
                        <div class="d-flex">
                            <h5 class="mx-2 pt-2">Show</h5>
                            <select name=""class="form-select" id="expiry-month-input">
                                <option value="1">10</option>
                            </select>
                            <h5 class="mx-2 pt-2">entries</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <form action="/students-rejected" class="d-flex gap-2 align-items-center">
                            <label for="search">Cari:</label>
                            <input type="text" name="name" value="{{request()->name}}" id="search" class="form-control">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle table table-nowrap table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Masa Magang</th>
                                <th scope="col">Sekolah</th>
                                <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($studentRejecteds as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->major }}</td>
                                    <td>{{ $student->class }}</td>
                                    <td>{{  \Carbon\Carbon::parse($student->start_date)->locale('id')->isoFormat('D MMMM Y') }} - {{ \Carbon\Carbon::parse($student->finish_date)->locale('id')->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $student->school }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary shadow-none btn-detail"
                                        data-name="{{ $student->name }}" data-phone="{{ $student->phone }}"
                                        data-address="{{ $student->address }}" data-birthdate="{{ $student->birth_date }}"
                                        data-birthplace="{{ $student->birth_place }}"
                                        data-startdate="{{ $student->start_date }}"
                                        data-finishdate="{{ $student->finish_date }}" data-school="{{ $student->school }}"
                                        data-avatar="{{ file_exists(public_path('storage/' . $student->avatar)) ? asset('storage/' . $student->avatar) : asset('user.webp') }}"
                                        data-selfstatement="{{ file_exists(public_path('storage/' . $student->self_statement)) ? asset('storage/' . $student->self_statement) : asset('no data.png') }}"
                                        data-cv="{{ file_exists(public_path('storage/' . $student->cv)) ? asset('storage/' . $student->cv) : asset('no data.png') }}"
                                        data-parentsstatement="{{ file_exists(public_path('storage/' . $student->parents_statement)) ? asset('storage/' . $student->parents_statement) : asset('no data.png') }}">Detail</button>
                                        <button class="btn btn-success shadow-none btn-accept"
                                            data-id="{{ $student->id }}"
                                        >Terima</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="d-flex justify-content-center mt-3">
                                            <img src="{{ asset('no data.png') }}" width="200px"
                                                alt="">
                                        </div>
                                        <h4 class="text-center mt-2 mb-4">
                                            Data Masih kosong
                                        </h4>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pt-2">
                    {{ $studentRejecteds->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Detail Siswa</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 overflow-hidden">
            <div data-simplebar="init" style="height: calc(100vh - 112px);" class="simplebar-scrollable-y">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask mt-4 overflow-y-scroll">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="" class="avatar-xl rounded-circle show-image" alt=""
                                style="object-fit: cover">
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <h4 class="show-name"></h4>
                        </div>
                        <div class="row mx-2">
                            <div class="col-6 d-flex align-items-center gap-1">
                                <i class="ri-map-pin-user-line fs-3 text-primary"></i>
                                <p class="m-0 show-address"></p>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-1">
                                <i class=" ri-smartphone-line fs-3 text-primary"></i>
                                <p class="m-0 show-phone"></p>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-1">
                                <i class="ri-gift-2-line fs-3 text-primary"></i>
                                <p class="m-0 show-birthday"></p>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-1">
                                <i class="ri-calendar-line fs-3 text-primary"></i>
                                <p class="m-0 show-start"></p>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-1">
                                <i class="ri-building-line fs-3 text-primary"></i>
                                <p class="m-0 show-school"></p>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-1">
                                <i class="ri-calendar-line fs-3 text-primary"></i>
                                <p class="m-0 show-finish"></p>
                            </div>
                        </div>
                        <div class="mt-3 mx-4">
                            <h4>CV</h4>
                            <img class="rounded show-cv" alt="200x200" width="330" src="gambar.jpg"
                                style="object-fit: cover; cursor: pointer;" onclick="zoomImage(this)">
                            <div class="mt-2 d-flex justify-content-end">
                                <a class="btn btn-primary download-cv" download="cv.jpg" href="gambar.jpg">Download</a>
                            </div>

                        </div>
                        <div class="mt-3 mx-4">
                            <h4>Pernyataan Orang tua</h4>
                            <img class="rounded show-parent-statement" alt="200x200" width="330" src=""
                                style="object-fit: cover;cursor: pointer;" onclick="zoomImage(this)">
                            <div class="mt-2 d-flex justify-content-end ">
                                <a class="btn btn-primary download-parent-statement" href=""
                                    download="">Download</a>
                            </div>
                        </div>
                        <div class="mt-3 mx-4">
                            <h4>Pernyataan Diri</h4>
                            <img class="rounded show-self-statement" alt="200x200" width="330" src=""
                                style="object-fit: cover;cursor: pointer;" onclick="zoomImage(this)">
                            <div class="mt-2 d-flex justify-content-end ">
                                <a class="btn btn-primary download-self-statement" href=""
                                    download="">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- Letter Number -->
   <div class="modal fade bs-example-modal-center" tabindex="-1" aria-labelledby="mySmallModalLabel"
   style="display: none;" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-body p-2 text-center">
               <div class="mt-3 mx-3">
                   <h4>Nomor surat</h4>
                   <form id="form-accepted" method="POST">
                       @csrf
                       @method('put')
                       <label for="">Masukan Nomer Surat</label>
                       <input type="number" class="form-control" name="letter_number" id="">
                       <div class="mt-4 mb-3 d-flex justify-content-center gap-2">
                           <button class="btn btn-success">Ya,terima</button>
                           <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $('.btn-accept').click(function() {
                let id = $(this).data('id');
                $('#form-accepted').attr('action', '/students-rejected/' + id);
                $('.bs-example-modal-center').modal('show');
            });

            $('.btn-detail').click(function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let avatar = $(this).data('avatar');
                let address = $(this).data('address');
                let phone = $(this).data('phone');
                let birth_date = $(this).data('birthdate');
                let birth_place = $(this).data('birthplace');
                let start_date = $(this).data('startdate');
                let finish_date = $(this).data('finishdate');
                let school = $(this).data('school');
                let cv = $(this).data('cv');
                let self_statement = $(this).data('selfstatement');
                let parents_statement = $(this).data('parentsstatement');

                $('.show-name').text(name);
                $('.show-image').attr('src', avatar);
                $('.show-address').text(address);
                $('.show-phone').text(phone);
                $('.show-birthday').text(birth_place + ',' + birth_date)
                $('.show-start').text(start_date);
                $('.show-school').text(school);
                $('.show-finish').text(finish_date);

                // console.log(cv);
                $('.show-cv').attr('src', cv);
                $('.download-cv').attr('href', cv);
                $('.download-cv').attr('download', cv);

                // console.log(parents_statement);
                $('.show-parent-statement').attr('src', parents_statement);
                $('.download-parent-statement').attr('href', parents_statement);
                $('.download-parent-statement').attr('download', parents_statement);

                // console.log(self_statement);
                $('.show-self-statement').attr('src', self_statement);
                $('.download-self-statement').attr('href', self_statement);
                $('.download-self-statement').attr('download', self_statement);

                $('#offcanvasRight').offcanvas('show');
            });
        </script>

    <script>
        function zoomImage(img) {
            // Membuat elemen overlay
            var overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = 0;
            overlay.style.left = 0;
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            overlay.style.zIndex = 9999;
            overlay.style.display = 'flex';
            overlay.style.alignItems = 'center';
            overlay.style.justifyContent = 'center';

            // Membuat elemen gambar yang diperbesar
            var zoomedImg = document.createElement('img');
            zoomedImg.src = img.src;
            zoomedImg.style.maxWidth = '90%';
            zoomedImg.style.maxHeight = '90%';

            // Menambahkan gambar ke dalam overlay
            overlay.appendChild(zoomedImg);

            // Menambahkan overlay ke dalam body
            document.body.appendChild(overlay);

            // Menghapus overlay saat diklik
            overlay.onclick = function() {
                document.body.removeChild(overlay);
            };
        }
    </script>
@endsection
