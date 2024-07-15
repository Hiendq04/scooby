@extends('Layout.admin')
@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        @include('Admin.header')

        <!-- Body: Body -->
        <div class="body d-flex py-3">
            <div class="container-xxl">

                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Categories Edit</h3>
                            <button id="update_category" type="submit"
                                class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Update</button>
                        </div>
                    </div>
                </div> <!-- Row end  -->

                <div class="row g-3 mb-3">
                    <div class="col-lg-4">
                        <div class="sticky-lg-top">
                            <div class="card mb-3">
                                <div
                                    class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">Status</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input id="active" value="active" class="form-check-input" type="radio"
                                            name="status" {{ $category->status == 'active' ? 'checked' : '' }}>
                                        <label for="active" class="form-check-label">
                                            <span class="badge bg-success">Active</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input id="inactive" value="inactive" class="form-check-input" type="radio"
                                            name="status" {{ $category->status == 'inactive' ? 'checked' : '' }}>
                                        <label for="inactive" class="form-check-label">
                                            <span class="badge bg-danger">Inactive</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header py-3 bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">Categories Thumbnail Upload</h6>
                                    <small>With event and default file try to remove the image</small>
                                </div>
                                <div class="card-body">
                                    <input id="thumbnail" type="file" data-default-file="{{ $category->thumbnail }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Basic information</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <label class="form-label">Name</label>
                                            <input value="{{ $category->name }}" id="name" type="text"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Page Description</label>
                                            <textarea id="description" type="text" class="form-control">{{ $category->description }}</textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- Row end  -->

            </div>
        </div>
        <div class="modal docs-cropped" id="getCroppedCanvasModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cropped</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white border lift" data-bs-dismiss="modal">Close</button>
                        <a class="btn btn-primary" id="download" href="javascript:void(0);"
                            download="cropped.html">Download</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Custom Settings-->
        @include('Admin.setting')
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/cdn/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/plugin/cropper/cropper.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/cropper/cropper-init.js') }}"></script>
        <script src="{{ asset('assets/bundles/dropify.bundle.js') }}"></script>
        <script>
            $(function() {
                $('.dropify').dropify();

                var drEvent = $('#thumbnail').dropify();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#update_category').on('click', function() {
                    $(this).html(loading);
                    const image = $('#thumbnail')[0].files[0];
                    const name = $('#name').val().trim();
                    const description = $('#description').val().trim();

                    function updateCat(link) {
                        let newData = {
                            id: {{ $category->id }},
                            status: $('input[name="status"]:checked').val(),
                            name: name,
                            description: description,
                            thumbnail: link
                        };

                        $.ajax({
                            type: "POST",
                            url: "{{ route('api.admin.category.update') }}",
                            data: newData,
                            dataType: "Json",
                            success: function(response) {
                                if (response.type == 'warning') {
                                    toastr.warning(response.data);
                                }
                                if (response.type == 'success') {
                                    toastr.success(response.data);
                                }
                            },
                            error: function() {
                                toastr.error(
                                    "Đã có lỗi xảy ra! Vui lòng thử lại sau!"
                                );
                            },
                            complete: () => {
                                $('#update_category').html('Update');
                            }
                        });
                    }
                    if (image) {
                        toastr.info("Vui lòng chờ trong giây lát!");
                        const reader = new FileReader();
                        reader.readAsDataURL(image);
                        reader.onload = function() {
                            const data = reader.result.split(',')[1];
                            const postData = {
                                name: image.name,
                                file: image.type,
                                data: data,
                            };
                            fetch("https://script.google.com/macros/s/AKfycbxUzOXusjqbC1L0aLbTUL74yPBwZoPcbTL_bSADUOhIsA0UEatoE5eNyUE9BeVXomcV/exec", {
                                    method: "POST",
                                    body: JSON.stringify(postData),
                                })
                                .then(response => response.json())
                                .then(data => {
                                    updateCat(data.link);
                                })
                                .catch(error => {
                                    toastr.error("Đã có lỗi xảy ra! Vui lòng thử lại sau!")
                                });
                        };
                    }else{
                        updateCat("");
                    }
                });
            });
        </script>
    @endsection
