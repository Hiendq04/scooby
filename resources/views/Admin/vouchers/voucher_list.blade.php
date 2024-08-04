@extends('Layout.admin')
@section('styles')
    <style>
        th.sorting::before,
        th.sorting::after,
        th.sorting_asc::before,
        th.sorting_asc::after {
            content: none !important;
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
                                <a href="{{route('admin.voucher.add')}}" class="btn btn-primary btn-set-task w-sm-100"><i
                                        class="icofont-plus-circle me-2 fs-6"></i>Add Voucher</a>
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
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Limit</th>
                                            <th>Condition (From)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_voucher">

                                    </tbody>
                                </table>
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
            // project data table
            $(document).ready(function() {
                $('#myProjectTable')
                    .addClass('nowrap')
                    .dataTable({
                        responsive: true,
                        columnDefs: [{
                            targets: [-1, -3],
                            className: 'dt-body-right'
                        }]
                    });
                // $('.deleterow').on('click', function() {
                //     var tablename = $(this).closest('table').DataTable();
                //     tablename
                //         .row($(this)
                //             .parents('tr'))
                //         .remove()
                //         .draw();

                // });
            });
        </script>
        {{-- Get list --}}
        <script>
            var today = new Date();

            var day = today.getDate();
            var month = today.getMonth() + 1    ;
            var year = today.getFullYear();

            var date = day + '/' + month + '/' + year;

            let keyword = $('input[type="search"]').val();
            var urlGetVouchers = "{{ route('api.admin.voucher.list') }}";

            function getVouchers(url) {
                let data = {
                    keyword: keyword,
                    count: $('select[name="myProjectTable_length"]').val()
                }

                $.ajax({
                    type: "GET",
                    url: url,
                    data: data,
                    dataType: "Json",
                    success: function(response) {
                        if (response.from == null) {
                            $('.dataTables_empty').html('<span class="text-danger">No data found</span>')
                        } else {
                            const html = response.data.map(vou => {
                                return `<tr>
                                            <td><span class="fw-bold ms-1">${vou.code}</span></td>
                                            <td>${(vou.type == 'free_ship' ? 'Free ship' : (vou.type == 'percentage' ? 'Percentage' : 'Fixed amount'))}</td>
                                            <td>${(vou.type != 'percentage' ? '$' : '')}${vou.value}${(vou.type == 'percentage' ? '%' : '.00')}</td>
                                            <td>${vou.start_date}</td>
                                            <td>${vou.end_date}</td>
                                            <td><span class="badge bg-${(vou.status == 'inactive' ? 'danger' : 'success')}">${(vou.status == 'inactive' ? 'Inactive' : 'Active')}</span></td>
                                            <td>${vou.limit}</td>
                                            <td>$${vou.condition}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="/admin/voucher/edit/${vou.id}" class="btn btn-outline-secondary"><i
                                                            class="icofont-edit text-success"></i></a>
                                                    <button type="button" onclick="deleteVoucher(${vou.id})" class="btn btn-outline-secondary deleterow"><i
                                                            class="icofont-ui-delete text-danger"></i></button>
                                                </div>
                                            </td>
                                        </tr>`;
                            }).join('');
                            $('#table_voucher').html(html);
                                $('#myProjectTable_info').html(
                                    `Showing ${response.from} to ${response.to} of ${response.total} entries`
                                );
                                if (response.current_page == 1) {
                                    $('#myProjectTable_previous').removeAttr('onclick');
                                    $('#myProjectTable_previous').css('opacity', '0.5');
                                } else {
                                    $('#myProjectTable_previous').attr('onclick',
                                        `getVouchers('${response.prev_page_url}')`);
                                    $('#myProjectTable_previous').css('opacity', '1');

                                }
                                if (response.current_page == response.last_page) {
                                    $('#myProjectTable_next').removeAttr('onclick');
                                    $('#myProjectTable_next').css('opacity', '0.5');
                                } else {
                                    $('#myProjectTable_next').attr('onclick',
                                        `getVouchers('${response.next_page_url}')`)
                                    $('#myProjectTable_next').css('opacity', '1');
                                }
                                $('.paginate_button.active .page-link').remove();
                                $(`<li class="paginate_button page-item active"><span style="color: white"  aria-controls="myProjectTable" data-dt-idx="1" tabindex="0" class="page-link">${response.current_page}</span></li>`)
                                    .insertAfter('#myProjectTable_previous');
                        }
                    },
                    error: () => {
                        toastr.error('Đã có lỗi xảy ra! Vui lòng thử lại sau!');
                    }
                });

            }
            $(document).ready(function() {
                $('th').off('click');

                getVouchers(urlGetVouchers);

                $('input[type="search"]').on('keypress', function(event) {
                    if (event.which === 13 || event.keyCode === 13) {
                        keyword = $(this).val();
                        getVouchers(urlGetVouchers);
                    }
                });

                $('select[name="myProjectTable_length"]').on('change', function() {
                    getVouchers(urlGetVouchers);
                });

            });
        </script>
        {{-- delete --}}
        <script>
            function deleteVoucher(idVou){
                Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa mã giảm giá này?',
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
                        url: "{{ route('api.admin.voucher.delete') }}",
                        data: {
                            id: idVou,
                        },
                        dataType: "Json",
                        success: function(response) {
                            if (response.type == "success") {
                                getVouchers(urlGetVouchers);
                                Swal.fire(
                                    'Đã xóa!',
                                    response.data,
                                    'success'
                                )
                            }
                        },
                        error: function() {
                            toastr.error("Đã có lỗi xảy ra! Vui lòng thử lại sau!");
                        }
                    });
                }
            })
            }
        </script>
    @endsection
