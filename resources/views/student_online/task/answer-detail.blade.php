@extends('student_online.layouts.app')

@section('style')
    <style>
        .manual-dropzone label {
            width: 100%;
            border: 2px dashed var(--bs-gray-300);
            border-radius: var(--bs-border-radius);
            padding: 2rem 1rem;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: all .2s;
        }

        .manual-dropzone label:hover,
        .manual-dropzone label:focus,
        .manual-dropzone label.dragenter {
            border: 2px dashed var(--bs-primary);
            background-color: rgba(var(--bs-primary-rgb), .05);
        }

        .manual-dropzone label p {
            margin-bottom: 0;
        }

        .manual-dropzone label .file-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .5rem;
        }

        .manual-dropzone label .file-placeholder h5 {
            margin-bottom: 0;
        }

        .manual-dropzone label .file-placeholder .icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .manual-dropzone label input {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .manual-dropzone .file-listing {
            z-index: 2;
            position: relative;
        }
    </style>
@endsection

@section('content')
    @if($errors->all())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ol>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
    @endif

    <div class="row g-2 mb-4">
        <div class="col-sm-4">
            <h4 class="mx-1">Detail Tugas <a
                    href="{{ route('siswa-online.course.detail', $task->subCourse->course->id) }}">{{ $task->subCourse->title }}</a>
            </h4>
        </div>
        <div class="col-sm-auto ms-auto">
            <div class="text-end d-flex gap-2 align-items-center justify-content-end">
                @if ($task->status === 'pending')
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#submit"
                        class="btn btn-success">Kirimkan Tugas</a>
                @endif
                <a href="{{ route('siswa-online.course.detail', $task->subCourse->course->id) }}"
                    class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
    <div class="row col-12">
        <div class="mb-4">
            <h5 id="title">
                <svg width="32" height="32" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.5837 2.1665C21.4126 2.16646 22.2103 2.48319 22.8134 3.05189C23.4166 3.6206 23.7796 4.39829 23.8282 5.22584L23.8337 5.4165V20.5832C23.8337 21.4121 23.517 22.2098 22.9483 22.813C22.3796 23.4161 21.6019 23.7791 20.7743 23.8278L20.5837 23.8332H5.41699C4.58801 23.8332 3.79035 23.5165 3.18721 22.9478C2.58407 22.3791 2.22104 21.6014 2.17241 20.7738L2.16699 20.5832V5.4165C2.16695 4.58753 2.48368 3.78986 3.05238 3.18672C3.62109 2.58358 4.39877 2.22055 5.22633 2.17192L5.41699 2.1665H20.5837ZM13.0003 11.9165H11.917L11.7902 11.9241C11.5269 11.9554 11.2843 12.0822 11.1082 12.2805C10.9321 12.4787 10.8349 12.7347 10.8349 12.9998C10.8349 13.265 10.9321 13.5209 11.1082 13.7192C11.2843 13.9175 11.5269 14.0443 11.7902 14.0756L11.917 14.0832V17.3332L11.9246 17.4599C11.9531 17.7017 12.0622 17.9269 12.2344 18.0991C12.4066 18.2712 12.6318 18.3804 12.8736 18.4089L13.0003 18.4165H14.0837L14.2104 18.4089C14.4522 18.3804 14.6774 18.2712 14.8496 18.0991C15.0217 17.9269 15.1309 17.7017 15.1594 17.4599L15.167 17.3332L15.1594 17.2064C15.1335 16.9854 15.0402 16.7777 14.8921 16.6116C14.744 16.4455 14.5484 16.329 14.3317 16.278L14.2104 16.2563L14.0837 16.2498V12.9998L14.0761 12.8731C14.0476 12.6313 13.9384 12.4061 13.7662 12.2339C13.5941 12.0618 13.3689 11.9526 13.1271 11.9241L13.0003 11.9165ZM13.0112 8.6665L12.8736 8.67409C12.6103 8.70541 12.3676 8.83221 12.1915 9.03047C12.0154 9.22873 11.9182 9.48468 11.9182 9.74984C11.9182 10.015 12.0154 10.2709 12.1915 10.4692C12.3676 10.6675 12.6103 10.7943 12.8736 10.8256L13.0003 10.8332L13.1379 10.8256C13.4012 10.7943 13.6439 10.6675 13.82 10.4692C13.996 10.2709 14.0933 10.015 14.0933 9.74984C14.0933 9.48468 13.996 9.22873 13.82 9.03047C13.6439 8.83221 13.4012 8.70541 13.1379 8.67409L13.0112 8.6665Z"
                        fill="#5D87FF" />
                </svg>
                <span class="ms-2">Soal</span>
            </h5>
            <p class="ms-1">{!! nl2br($task->description) !!}</p>
        </div>
        <div class="mb-2">
            <h5>
                <svg width="32" height="32" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.5837 2.1665C21.4126 2.16646 22.2103 2.48319 22.8134 3.05189C23.4166 3.6206 23.7796 4.39829 23.8282 5.22584L23.8337 5.4165V20.5832C23.8337 21.4121 23.517 22.2098 22.9483 22.813C22.3796 23.4161 21.6019 23.7791 20.7743 23.8278L20.5837 23.8332H5.41699C4.58801 23.8332 3.79035 23.5165 3.18721 22.9478C2.58407 22.3791 2.22104 21.6014 2.17241 20.7738L2.16699 20.5832V5.4165C2.16695 4.58753 2.48368 3.78986 3.05238 3.18672C3.62109 2.58358 4.39877 2.22055 5.22633 2.17192L5.41699 2.1665H20.5837ZM13.0003 11.9165H11.917L11.7902 11.9241C11.5269 11.9554 11.2843 12.0822 11.1082 12.2805C10.9321 12.4787 10.8349 12.7347 10.8349 12.9998C10.8349 13.265 10.9321 13.5209 11.1082 13.7192C11.2843 13.9175 11.5269 14.0443 11.7902 14.0756L11.917 14.0832V17.3332L11.9246 17.4599C11.9531 17.7017 12.0622 17.9269 12.2344 18.0991C12.4066 18.2712 12.6318 18.3804 12.8736 18.4089L13.0003 18.4165H14.0837L14.2104 18.4089C14.4522 18.3804 14.6774 18.2712 14.8496 18.0991C15.0217 17.9269 15.1309 17.7017 15.1594 17.4599L15.167 17.3332L15.1594 17.2064C15.1335 16.9854 15.0402 16.7777 14.8921 16.6116C14.744 16.4455 14.5484 16.329 14.3317 16.278L14.2104 16.2563L14.0837 16.2498V12.9998L14.0761 12.8731C14.0476 12.6313 13.9384 12.4061 13.7662 12.2339C13.5941 12.0618 13.3689 11.9526 13.1271 11.9241L13.0003 11.9165ZM13.0112 8.6665L12.8736 8.67409C12.6103 8.70541 12.3676 8.83221 12.1915 9.03047C12.0154 9.22873 11.9182 9.48468 11.9182 9.74984C11.9182 10.015 12.0154 10.2709 12.1915 10.4692C12.3676 10.6675 12.6103 10.7943 12.8736 10.8256L13.0003 10.8332L13.1379 10.8256C13.4012 10.7943 13.6439 10.6675 13.82 10.4692C13.996 10.2709 14.0933 10.015 14.0933 9.74984C14.0933 9.48468 13.996 9.22873 13.82 9.03047C13.6439 8.83221 13.4012 8.70541 13.1379 8.67409L13.0112 8.6665Z"
                        fill="#5D87FF" />
                </svg>
                <span class="ms-2">Jawaban Yang Di Kumpulkan</span>
            </h5>

            <div class="table-responsive">
                <table data-labelledby="title" class="table table-striped w-100" id="answer-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Diunggah Pada</th>
                            <th scope="col">File</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Status Kurasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $index => $submission)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $submission->created_at->locale('id')->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('siswa-online.tasksubmit.download', ['task' => $task->id, 'taskSubmission' => $submission->id]) }}" class="d-flex gap-2 align-items-center">
                                        <i class="fas fa-download"></i>
                                        Unduh Berkas
                                    </a>
                                </td>
                                <td>{{ $submission->rating ?? 0 }} / 10</td>
                                <td>
                                    <span class="badge bg-{{ $submission->getStatus()->color() }}">{{ $submission->getStatus()->label() }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $submissions->links() }}
        </div>
    </div>
@endsection

@section('script')
    <div class="modal fade" id="submit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa-online.tasksubmit.submit') }}" method="post" id="submitData" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="task_id" value="{{ $task->id }}" />
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}" />

                        <div class="manual-dropzone">
                            <label for="file" class="form-label">
                                <div class="file-placeholder">
                                    <i class="fas fa-upload icon"></i>
                                    <h5>Unggah Berkasmu</h5>
                                    <p class="text-muted">File yang diunggah harus berekstensi .pdf, .zip atau .docx</p>
                                </div>
                                <div class="file-listing d-none"></div>
                                <input type="file" accept="application/pdf, application/zip, application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control" id="file" name="file" />
                            </label>

                            <div class="error-msg text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm('submitData')">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            $('#form-update').attr('action', '/material/' + id);
            $('#modal-edit').modal('show');
        });

        function preview(event) {
            var input = event.target;
            var previewImages = document.getElementsByClassName('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    Array.from(previewImages).forEach(function(previewImage) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.btn-detail').click(function() {
            var detail = $('#detail-content');
            detail.empty();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var date = $(this).data('date');
            var school = $(this).data('school');
            var description = $(this).data('description');
            var image = $(this).data('image');
            detail.append('<div class="mb-2">');
            detail.append('<h6 class="f-w-600">Nama</h6>');
            detail.append('<p class="text-muted">' + name + '</p>')
            detail.append('</div>');
            detail.append('<div class="mb-2">');
            detail.append('<h6 class="f-w-600">Tanggal</h6>');
            detail.append('<p class="text-muted">' + date + '</p>')
            detail.append('</div>');
            detail.append('<div class="mb-2">');
            detail.append('<h6 class="f-w-600">Sekolah</h6>');
            detail.append('<p class="text-muted">' + school + '</p>')
            detail.append('</div>');
            detail.append('<div class="mb-2">');
            detail.append('<h6 class="f-w-600">Kegiatan</h6>');
            detail.append('<p>' + description + '</p>')
            detail.append('</div>');
            detail.append('<div class="mb-2">');
            detail.append('<h6 class="f-w-600">Bukti</h6>');
            detail.append('<img src="' + image + '" width="100%"></img>')
            detail.append('</div>');
            $('#detail').modal('show');
        });

        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/division/' + id);
            $('#modal-delete').modal('show');
        });
    </script>

    <script>
        function submitForm(id) {
            document.getElementById(id).submit();
        };
    </script>

    <script>
        // Generate function to convert kb to human readable MB size
        function formatSizeUnits(bytes) {
            if (bytes >= 1073741824) {
                bytes = (bytes / 1073741824).toFixed(2) + " GB";
            } else if (bytes >= 1048576) {
                bytes = (bytes / 1048576).toFixed(2) + " MB";
            } else if (bytes >= 1024) {
                bytes = (bytes / 1024).toFixed(2) + " KB";
            } else if (bytes > 1) {
                bytes = bytes + " bytes";
            } else if (bytes == 1) {
                bytes = bytes + " byte";
            } else {
                bytes = "0 bytes";
            }
            return bytes;
        }

        $('.manual-dropzone input')
            .on('dragenter', () => {
                $('.manual-dropzone label').addClass('dragenter');
                $('.manual-dropzone input').css('z-index', 2);
                $('.manual-dropzone .file-listing').css('z-index', 1);
            })
            .on('dragend drop dragexit dragleave', () => {
                $('.manual-dropzone input').css('z-index', 1);
                $('.manual-dropzone .file-listing').css('z-index', 2);
                $('.manual-dropzone label').removeClass('dragenter');
            })
            .on('change', (event) => {
                let fileData = $(event.target).prop('files')[0];

                console.log(fileData.type);

                // Prevent if is not .zip, .pdf or .docx files
                var validTypes = [
                    'application/zip',
                    'application/x-zip-compressed',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ], typeIcon = {
                    'application/zip': 'fa-file-archive',
                    'application/x-zip-compressed': 'fa-file-archive',
                    'application/pdf': 'fa-file-pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'fa-file-word'
                };
                if (!validTypes.includes(fileData.type)) {
                    $('.file-listing').addClass('d-none');
                    $('.file-placeholder').removeClass('d-none');
                    $('.error-msg').text("File yang diunggah harus berekstensi .pdf, .zip atau .docx");

                    // Reset the input file
                    $(event.target).val(null);
                } else {
                    $('.file-placeholder').addClass('d-none');
                    $('.error-msg').text("");

                    // Add new file data to
                    if (fileData) {
                        let fileName = fileData.name;
                        $('.file-listing').removeClass('d-none').html(`
                    <div class="file-list">
                        <i class="fas ${typeIcon[fileData.type]} fa-2x mb-2"></i>
                        <p class="mb-0 text-truncate fw-bolder">${fileName}</p>
                        <p class="text-muted mb-0">${formatSizeUnits(fileData.size)}</p>
                    </div>
                `);
                    } else {
                        $('.file-listing').addClass('d-none');
                        $('.file-placeholder').removeClass('d-none');
                    }
                }
            });
    </script>
@endsection
