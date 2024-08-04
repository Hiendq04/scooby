@extends('Layout.admin')
@section('styles')
    <style>
        th.sorting::before,
        th.sorting::after,
        th.sorting_asc::before,
        th.sorting_asc::after {
            content: none !important;
        }

        .hoverable {
            position: relative;
        }

        .hoverable:hover::after {
            content: attr(data-title);
            position: absolute;
            top: 100%;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            z-index: 1;
            white-space: nowrap;
            max-width: 900px;
            display: block;
            word-break: break-all!important;
            overflow: auto;
        }
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
                            <h3 class="fw-bold mb-0">Categories List</h3>
                            <a href="{{ route('admin.category.add') }}"
                                class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i
                                    class="icofont-plus-circle me-2 fs-6"></i> Add Categories</a>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="category_list">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Custom Settings-->
        @include('Admin.setting')
    @endsection

    @section('scripts')
        <script>
            let keyword = $('input[type="search"]').val();
            var urlGetCategories = "{{ route('api.admin.category.list') }}";

            function getCategories(url) {
                let data = {
                    keyword: keyword,
                    count: $('select[name="myDataTable_length"]').val()
                }

                $.ajax({
                    type: "GET",
                    url: url,
                    data: data,
                    dataType: "Json",
                    success: function(response) {
                        if (response.from == null) {
                            $('.myDataTable_wrapper').html('<span class="text-danger">No data found</span>')
                        } else {
                            const html = response.data.map(cat => {
                                return `<tr>
                                            <td><strong>#${cat.id}</strong></td>
                                            <td class="hoverable" data-title="${cat.description}">${cat.name}</td>
                                            <td>${cat.date}</td>
                                            <td>${(cat.status == 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>')}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="/admin/category/edit/${cat.id}" class="btn btn-outline-secondary"><i
                                                            class="icofont-edit text-success"></i></a>
                                                    <button onclick="deleteCategory(${cat.id})" type="button" class="btn btn-outline-secondary deleterow"><i
                                                            class="icofont-ui-delete text-danger"></i></button>
                                                </div>
                                            </td>
                                        </tr>`;
                            }).join('');
                            $('#category_list').html(html);
                            $('#myDataTable_info').html(
                                `Showing ${response.from} to ${response.to} of ${response.total} entries`
                            );
                            if (response.current_page == 1) {
                                $('#myDataTable_previous').removeAttr('onclick');
                                $('#myDataTable_previous').css('opacity', '0.5');
                            } else {
                                $('#myDataTable_previous').attr('onclick',
                                    `getCategories('${response.prev_page_url}')`);
                                $('#myDataTable_previous').css('opacity', '1');

                            }
                            if (response.current_page == response.last_page) {
                                $('#myDataTable_next').removeAttr('onclick');
                                $('#myDataTable_next').css('opacity', '0.5');
                            } else {
                                $('#myDataTable_next').attr('onclick',
                                    `getCategories('${response.next_page_url}')`)
                                $('#myDataTable_next').css('opacity', '1');
                            }
                            $('.paginate_button.active .page-link').remove();
                            $(`<li class="paginate_button page-item active"><span style="color: white"  aria-controls="myDataTable" data-dt-idx="1" tabindex="0" class="page-link">${response.current_page}</span></li>`)
                                .insertAfter('#myDataTable_previous');
                        }
                    }
                });

            }
            $(document).ready(function() {
                $('th').off('click');

                getCategories(urlGetCategories);

                $('input[type="search"]').on('keypress', function(event) {
                    if (event.which === 13 || event.keyCode === 13) {
                        keyword = $(this).val();
                        getCategories(urlGetCategories);
                    }
                });

                $('select[name="myDataTable_length"]').on('change', function() {
                    getCategories(urlGetCategories);
                });

            });
        </script>
        <script>
            function deleteCategory(idCategory) {
                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: 'Bạn có chắc chắn muốn xóa danh mục này?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '##6c757d',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('api.admin.category.delete') }}",
                            data: {
                                id: idCategory
                            },
                            dataType: "Json",
                            success: function(response) {
                                getCategories(urlGetCategories);
                                Swal.fire(
                                    'Đã xóa!',
                                    response.data,
                                    'success'
                                )
                            },
                            error: () => {
                                toastr.error('Đã xảy ra lỗi! Vui lòng thử lại sau!');
                            }
                        });
                    }
                })
            }
        </script>
    @endsection
