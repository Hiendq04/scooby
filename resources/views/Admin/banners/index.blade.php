@extends('Layout.admin')
@section('styles')
    <style>
        th.sorting::before,
        th.sorting::after,
        th.sorting_asc::before,
        th.sorting_asc::after {
            content: none !important;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 25px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(18px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        @include('Admin.header')

        <!-- Body: Body -->
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Voucher</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-set-task w-sm-100"><i
                                        class="icofont-plus-circle me-2 fs-6"></i>Add Banner</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row clearfix g-3">
                    <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th>Is Active</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_voucher">
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                <td>{{ $banner->title }}</td>
                                                <td>{{ $banner->content }}</td>
                                                <td><img style="height: 100px;"
                                                        src="{{ $banner->image ? Storage::url($banner->image) : '' }}"
                                                        alt="Chưa được cập nhật hình ảnh"></td>
                                                <td><label class="switch">
                                                        <input onchange="changeStatus({{ $banner->id }})"
                                                            {{ $banner->status == 'active' ? 'checked' : '' }}
                                                            type="checkbox">
                                                        <span class="slider round"></span>
                                                    </label></td>
                                                <td>{{ $banner->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <a class="btn btn-warning"
                                                        href="{{ route('admin.banner.edit', $banner->id) }}">Sửa</a> |
                                                    <form class="d-inline" method="POST"
                                                        action="{{ route('admin.banner.destroy', $banner->id) }}"
                                                        onsubmit="confirmBtn(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p class="mt-3">
                                    {{ $banners->links('pagination::bootstrap-5') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>
        </div>

        <!-- Modal Custom Settings-->
        @include('Admin.setting')
    @endsection

    @section('scripts')
        <script>
            function confirmBtn(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: 'Bạn có chắc chắn muốn xóa bảng quảng cáo này?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            }

            function changeStatus(id){
                // let status = event.target.checked ? 'active' : 'inactive';

                let data = {
                    id: id,
                    status: event.target.checked ? 'active' : 'inactive',
                }

                $.ajax({
                    type: "POST",
                    url: "{{route('api.admin.banner.status')}}",
                    data: data,
                    dataType: "Json",
                    success: function (response) {
                        if(response.success){   
                            toastr.success('Cập nhật trạng thái thành công!');
                        }else{
                            toastr.error('Cập nhật thất bại!');
                        }
                    }
                });

            }
        </script>
    @endsection
