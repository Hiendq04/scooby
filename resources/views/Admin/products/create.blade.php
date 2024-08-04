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

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Product Add</h3>
                                <button type="submit"
                                    class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">ADD</button>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                    <div class="row g-3 mb-3">
                        <div class="col-xl-4 col-lg-4">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Pricing Info</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Product Price</label>
                                                <input value="{{ old('price') }}" name="price" type="number"
                                                    class="form-control">
                                                @error('price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Product Price Sale</label>
                                                <input value="{{ old('price_sale') }}" name="price_sale" type="number"
                                                    class="form-control">
                                                @error('price_sale')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Quantity</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Product Price</label>
                                                <input value="{{ old('quantity') ?? 0 }}" name="quantity" type="number"
                                                    class="form-control">
                                                @error('quantity')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Visibility Status</h6>
                                    </div>
                                    <div class="card-body">
                                        @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="form-check">
                                            <input name="status" value="published" class="form-check-input" type="radio"
                                                name="couponsstatus" checked>
                                            <label class="form-check-label">
                                                Published
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="status" value="hidden" class="form-check-input" type="radio"
                                                name="couponsstatus">
                                            <label class="form-check-label">
                                                Hidden
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Categories</h6>
                                    </div>
                                    <div class="card-body">
                                        @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <label class="form-label">Categories Select</label>
                                        <select name="category_id" class="form-select" size="3"
                                            aria-label="size 3 select example">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Basic information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input value="{{ old('name') }}" name="name" type="text"
                                                class="form-control">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">SKU</label>
                                            <input value="{{ old('sku') }}" name="sku" type="text"
                                                class="form-control">
                                            @error('sku')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Product Description</label>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <textarea name="description" placeholder="Enter Product Description Here" id="editor">
                                                {{ old('description') }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
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
                                            <input type="file" name="image" id="input-file-to-destroy"
                                                class="dropify" data-allowed-formats="portrait square"
                                                data-max-file-size="2M" data-max-height="2000">
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
    <script src="{{ asset('cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugin/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugin/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/cropper/cropper-init.js') }}"></script>
    <script src="{{ asset('assets/bundles/dropify.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script>
        $(document).ready(function() {
            //Ch-editer
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
            //Datatable
            $('#myCartTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
            //Multiselect
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });
        });

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
