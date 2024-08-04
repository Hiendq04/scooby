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

                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Banner Update</h3>
                                <button type="submit"
                                    class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">UPDATE</button>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Basic information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6">
                                            <label class="form-label">Title</label>
                                            <input value="{{ $banner->title }}" name="title" type="text"
                                                class="form-control">
                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" aria-label="Default select example">
                                                <option {{ $banner->status == 'active' ? 'selected' : '' }}
                                                    class="text-bg-success" value="active">Active</option>
                                                <option {{ $banner->status == 'inactive' ? 'selected' : '' }}
                                                    class="text-bg-danger" value="inactive">Inactive</option>
                                            </select>
                                            @error('status')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Content</label>
                                            <textarea style="max-height: 100px" name="content" type="text" class="form-control">{{ $banner->content }}</textarea>
                                            @error('content')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Images</h6>
                                </div>
                                <div class="card-body">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <label class="form-label">Product Images Upload</label>
                                            <small class="d-block text-muted mb-2">Only portrait or square images, 2M max
                                                and 2000px max-height.</small>
                                            <input type="file" name="image" id="input-file-to-destroy" class="dropify"
                                                data-allowed-formats="portrait square" data-max-file-size="2M"
                                                data-max-height="2000">
                                            @if ($banner->image)
                                                <div style="width: 100%;height: 200px;"
                                                    class="d-flex justify-center align-content-center">
                                                    <img class="m-auto" style="height: 100%;"
                                                        src="{{ Storage::url($banner->image) }}" alt="Ảnh">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                </form>

            </div>
        </div>

        <!-- Modal Custom Settings-->
        @include('Admin.setting')

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugin/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugin/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/cropper/cropper-init.js') }}"></script>
    <script src="{{ asset('assets/bundles/dropify.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script>
        $(function() {
            $('.dropify').dropify();

            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-dÃ©posez un fichier ici ou cliquez',
                    replace: 'Glissez-dÃ©posez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'DÃ©solÃ©, le fichier trop volumineux'
                }
            });
        });
    </script>
@endsection
