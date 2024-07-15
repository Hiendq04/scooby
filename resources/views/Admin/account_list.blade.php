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
                            <h3 class="fw-bold mb-0">Accounts Information</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal"
                                    data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add
                                    Account</button>
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
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Register Date</th>
                                            <th>Mail</th>
                                            <th>Total Order</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="account_list">

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

        <!-- Add Account-->
        <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="expaddLabel">Add Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="deadline-form">
                            <form id="add_account">
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-6">
                                        <label for="first_name" class="form-label">First Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name">
                                        <p class="text-danger error error_first_name"></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="last_name" class="form-label">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name">
                                        <p class="text-danger error error_last_name"></p>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-12">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email">
                                        <p class="text-danger error error_email"></p>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="password" autocomplete="off">
                                        <p class="text-danger error error_password"></p>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input type="File" class="form-control" id="avatar">
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-6">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" id="role">
                                            <option value="admin">Admin</option>
                                            <option value="client" selected>Client</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" id="status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button id="submit_add_account" type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Accounts-->
        <div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Accounts</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="deadline-form">
                            <form id="formEdit">

                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="updateAccount" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    {{-- List Accounts --}}
    <script>
        const routeTemplate = @json(route('admin.account.info', ['id' => 'ID_PLACEHOLDER']));

        let keyword = $('input[type="search"]').val();
        var urlGetAccounts = "{{ route('api.admin.account.list') }}";

        function getAccounts(url) {
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
                        const html = response.data.map(acc => {
                            let link = routeTemplate.replace('ID_PLACEHOLDER', acc.id);
                            return `<tr>
                                        <td><strong>#${acc.id}</strong></td>
                                        <td>
                                            <a href="${link}">
                                                <img class="avatar rounded"
                                                    src="{{ asset('assets/images/xs/avatar1.svg') }}" alt="">
                                                <span class="fw-bold ms-1">${acc.name}</span>
                                            </a>
                                        </td>
                                        <td>
                                            ${acc.register_date}
                                        </td>
                                        <td>${acc.email}</td>
                                        <td>${acc.total_order}</td>
                                        <td>${(acc.role == 'admin' ? '<span class="badge rounded-pill text-bg-primary">Admin</span>' : (acc.role == 'client' ? 'Client' : ''))}</td>
                                        <td>${acc.status == 'active' ? '<span class="badge rounded-pill text-bg-success">Active</span>' : '<span class="badge rounded-pill text-bg-danger">Inactive</span>'}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-toggle="modal" data-bs-target="#expedit" onclick="editAccount(${acc.id})"><i
                                                        class="icofont-edit text-success"></i></button>
                                                <button type="button" onclick="deleteAccount(${acc.id})" class="btn btn-outline-secondary deleterow"><i
                                                        class="icofont-ui-delete text-danger"></i></button>
                                            </div>
                                        </td>
                                    </tr>`;
                        }).join('');
                        $('#account_list').html(html);
                        $('#myProjectTable_info').html(
                            `Showing ${response.from} to ${response.to} of ${response.total} entries`
                        );
                        if (response.current_page == 1) {
                            $('#myProjectTable_previous').removeAttr('onclick');
                            $('#myProjectTable_previous').css('opacity', '0.5');
                        } else {
                            $('#myProjectTable_previous').attr('onclick',
                                `getAccounts('${response.prev_page_url}')`);
                            $('#myProjectTable_previous').css('opacity', '1');

                        }
                        if (response.current_page == response.last_page) {
                            $('#myProjectTable_next').removeAttr('onclick');
                            $('#myProjectTable_next').css('opacity', '0.5');
                        } else {
                            $('#myProjectTable_next').attr('onclick',
                                `getAccounts('${response.next_page_url}')`)
                            $('#myProjectTable_next').css('opacity', '1');
                        }
                        $('.paginate_button.active .page-link').remove();
                        $(`<li class="paginate_button page-item active"><span style="color: white"  aria-controls="myProjectTable" data-dt-idx="1" tabindex="0" class="page-link">${response.current_page}</span></li>`)
                            .insertAfter('#myProjectTable_previous');
                    }
                }
            });

        }
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
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();
            });
            $('th').off('click');

            getAccounts(urlGetAccounts);

            $('input[type="search"]').on('keypress', function(event) {
                if (event.which === 13 || event.keyCode === 13) {
                    keyword = $(this).val();
                    getAccounts(urlGetAccounts);
                }
            });

            $('select[name="myProjectTable_length"]').on('change', function() {
                getAccounts(urlGetAccounts);
            });

        });
    </script>
    {{-- Add Account --}}
    <script>
        $(document).ready(function() {
            let linkAvt = "";

            function handleAddAccount(linkAvt) {
                let newAccount = {
                    first_name: $('#first_name').val().trim(),
                    last_name: $('#last_name').val().trim(),
                    email: $('#email').val().trim(),
                    password: $('#password').val().trim(),
                    avatar: linkAvt,
                    role: $('#role').val().trim(),
                    status: $('#status').val().trim(),
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('api.admin.account.add') }}",
                    data: newAccount,
                    dataType: "Json",
                    success: function(response) {
                        if (response.type == "validate") {
                            for (const key in response.data) {
                                $('.error_' + key).text(response.data[key][0])
                            }
                        }
                        if (response.type == "success") {
                            getAccounts(urlGetAccounts);
                            toastr.success(response.data);
                            $('#first_name').val('');
                            $('#last_name').val('');
                            $('#email').val('');
                            $('#password').val('');
                            $('#avatar').val('');
                            $('#role').val('client');
                            $('#status').val('active');
                        }
                        if(response.type == 'error'){
                            toastr.warning(response.data);
                        }
                    },
                    error: function() {
                        toastr.error("Đã xảy ra lỗi! Vui lòng thử lại sau!");
                    },
                    complete: function() {
                        $("#submit_add_account").text('Add');
                    }
                });
            }

            $("#submit_add_account").on('click', function() {
                $(this).html(loading);
                $('.error').text('');
                const avtFile = $('#avatar')[0].files[0];
                if (avtFile) {
                    const reader = new FileReader();
                    reader.readAsDataURL(avtFile);
                    reader.onload = function() {
                        const data = reader.result.split(",")[1];
                        const postData = {
                            name: avtFile.name,
                            file: avtFile.type,
                            data: data
                        }
                        postFile(postData).then(() => {
                            handleAddAccount(linkAvt);
                        });
                    };
                } else {
                    handleAddAccount(linkAvt);
                }
            });

            async function postFile(postData) {
                toastr.info("Vui lòng chờ trong giây lát!")
                const response = await fetch(
                    "https://script.google.com/macros/s/AKfycbxUzOXusjqbC1L0aLbTUL74yPBwZoPcbTL_bSADUOhIsA0UEatoE5eNyUE9BeVXomcV/exec", {
                        method: "POST",
                        body: JSON.stringify(postData),
                    }
                );
                const data = await response.json();
                linkAvt = data.link;
            }
        });
    </script>
    {{-- Delete Account --}}
    <script>
        function deleteAccount(idAccount) {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa tài khoản này?',
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
                        url: "{{ route('api.admin.account.delete') }}",
                        data: {
                            id: idAccount,
                            idUser: {{ $idUser }}
                        },
                        dataType: "Json",
                        success: function(response) {
                            if (response.type == "success") {
                                getAccounts(urlGetAccounts);
                                Swal.fire(
                                    'Đã xóa!',
                                    response.data,
                                    'success'
                                )
                            }
                            if (response.type == "error") {
                                toastr.warning(response.data)
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
    {{-- Edit Account --}}
    <script>
        function editAccount(idAccount) {
            $.ajax({
                type: "POST",
                url: "{{ route('api.admin.account.edit') }}",
                data: {
                    idAccount: idAccount
                },
                dataType: "Json",
                success: function(response) {
                    $('#formEdit').html(`
                        <input disabled value="${response.id}" type="text" class="form-control d-none" id="idAccount">
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="edit_first_name" class="form-label">First Name <span
                                        class="text-danger">*</span></label>
                                <input value="${response.first_name}" type="text" class="form-control" id="edit_first_name">
                                <p class="text-danger error error_edit_first_name"></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="edit_last_name" class="form-label">Last Name <span
                                        class="text-danger">*</span></label>
                                <input value="${response.last_name}" type="text" class="form-control" id="edit_last_name">
                                <p class="text-danger error error_edit_last_name"></p>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <label for="edit_email" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <input value="${response.email}" type="text" class="form-control" id="edit_email">
                                <p class="text-danger error error_edit_email"></p>
                            </div>
                            <div class="col-sm-12">
                                <label for="edit_password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="edit_password" autocomplete="off">
                                <p class="text-danger error error_edit_password"></p>
                            </div>
                            <div class="col-sm-12">
                                <label for="edit_avatar" class="form-label">Avatar</label>
                                <input type="File" class="form-control" id="edit_avatar">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="edit_role" class="form-label">Role</label>
                                <select class="form-control" id="edit_role">
                                    <option value="admin" ${response.role === 'admin' ? 'selected' : ''}>Admin</option>
                                    <option value="client" ${response.role === 'client' ? 'selected' : ''}>Client</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-control" id="edit_status">
                                    <option value="active" ${response.status === 'active' ? 'selected' : ''}>Active</option>
                                    <option value="inactive" ${response.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                                </select>
                            </div>
                        </div>`);
                },
                error: function(){
                    toastr.error('Đã có lỗi xảy ra! Vui lòng thử lại sau!');
                }
            });
        }

        $(document).ready(function() {
            let linkAvt = "";

            function handleUpdateAccount(linkAvt) {
                let data = {
                    idAccount: $('#idAccount').val().trim(),
                    idUser: {{$idUser}},
                    first_name: $('#edit_first_name').val().trim(),
                    last_name: $('#edit_last_name').val().trim(),
                    email: $('#edit_email').val().trim(),
                    password: $('#edit_password').val().trim(),
                    avatar: linkAvt,
                    role: $('#edit_role').val().trim(),
                    status: $('#edit_status').val().trim(),
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('api.admin.account.update') }}",
                    data: data,
                    dataType: "Json",
                    success: function(response) {
                        if (response.type == "validate") {
                            for (const key in response.data) {
                                $('.error_edit_' + key).text(response.data[key][0])
                            }
                        }
                        if (response.type == "success") {
                            getAccounts(urlGetAccounts);
                            toastr.success(response.data);
                        }
                        if (response.type == "error") {
                            toastr.error(response.data);
                        }
                        if (response.type == "warning") {
                            toastr.warning(response.data);
                        }
                    },
                    error: function() {
                        toastr.error("Đã xảy ra lỗi! Vui lòng thử lại sau!");
                    },
                    complete: function() {
                        $("#updateAccount").text('Save');
                    }
                });
            }

            $("#updateAccount").on('click', function() {
                $(this).html(loading);
                $('.error').text('');
                const avtFile = $('#edit_avatar')[0].files[0];
                if (avtFile) {
                    const reader = new FileReader();
                    reader.readAsDataURL(avtFile);
                    reader.onload = function() {
                        const data = reader.result.split(",")[1];
                        const postData = {
                            name: avtFile.name,
                            file: avtFile.type,
                            data: data
                        }
                        postFile(postData).then(() => {
                            handleUpdateAccount(linkAvt);
                        });
                    };
                } else {
                    handleUpdateAccount(linkAvt);
                }
            });

            async function postFile(postData) {
                toastr.info("Vui lòng chờ trong giây lát!")
                const response = await fetch(
                    "https://script.google.com/macros/s/AKfycbxUzOXusjqbC1L0aLbTUL74yPBwZoPcbTL_bSADUOhIsA0UEatoE5eNyUE9BeVXomcV/exec", {
                        method: "POST",
                        body: JSON.stringify(postData),
                    }
                );
                const data = await response.json();
                linkAvt = data.link;
            }

        });
    </script>
@endsection
