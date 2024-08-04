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
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Voucher Update</h3>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row clearfix g-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div
                                class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Voucher Status</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input id="active" name="status" value="active" class="form-check-input"
                                        type="radio" {{($voucher->status == 'active' ? 'checked' : '')}}>
                                    <label for="active" class="form-check-label">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="inactive" name="status" value="inactive" class="form-check-input"
                                        type="radio" {{($voucher->status == 'inactive' ? 'checked' : '')}}>
                                    <label for="inactive" class="form-check-label">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div
                                class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Date Schedule</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">Start Date</label>
                                        <input value="{{$voucher->start_date->format('Y-m-d')}}" id="start_date" type="date" class="form-control w-100">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">End Date</label>
                                        <input value="{{$voucher->end_date->format('Y-m-d')}}" id="end_date" type="date" class="form-control w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div
                                class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Voucher Information</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6">
                                            <label class="form-label">Code</label>
                                            <input disabled value="{{strtoupper($voucher->code)}}" id="code" placeholder="Chuỗi 10 ký tự số và chữ cái" type="text" class="form-control">
                                            <p class="text-danger err err_code"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Condition (From)</label>
                                            <input id="condition" value="{{$voucher->condition}}" type="number" placeholder="0" class="form-control">
                                            <p class="text-danger err err_condition"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Limits</label>
                                            <input id="limit" value="{{$voucher->limit}}" type="number" placeholder="0" class="form-control">
                                            <p class="text-danger err err_limit"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Created at</label>
                                            <input readonly value="{{$voucher->created_at->format('m/d/Y')}}" type="text" class="form-control">
                                            <p class="text-danger err err_limit"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Updated at</label>
                                            <input readonly value="{{$voucher->updated_at->format('m/d/Y')}}" type="text" class="form-control">
                                            <p class="text-danger err err_limit"></p>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Types</label>
                                            <div class="form-check">
                                                <input value="free_ship" id="free_ship" class="form-check-input" type="radio" name="type" {{$voucher->type == 'free_ship' ? 'checked' : ''}}>
                                                <label for="free_ship" class="form-check-label">
                                                    Free Shipping
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input value="percentage" id="percentage" class="form-check-input" type="radio" name="type" {{$voucher->type == 'percentage' ? 'checked' : ''}}>
                                                <label for="percentage" class="form-check-label">
                                                    Percentage
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input value="fixed_amout" id="fixed_amout" class="form-check-input" type="radio" name="type" {{$voucher->type == 'fixed_amount' ? 'checked' : ''}}>
                                                <label for="fixed_amout" class="form-check-label">
                                                    Fixed Amount
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Value</label>
                                            <input value="{{$voucher->value}}" id="value" type="number" placeholder="0" class="form-control">
                                            <p class="text-danger err err_value"></p>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5"
                                        id="update_voucher">Update</button>
                                    <a href="{{route('admin.voucher.list')}}" class="btn btn-warning mt-4 text-uppercase px-5"
                                        >Cancel</a>
                                </form>
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
            $(document).ready(function() {
                $('#update_voucher').on('click', function(e) {
                    e.preventDefault();
                    $('.err').html('');
                    let data = {
                        idVoucher: {{$voucher->id}},
                        status: $('input[name="status"]:checked').val(),
                        type: $('input[name="type"]:checked').val(),
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                        limit: $('#limit').val().trim(),
                        value: $('#value').val().trim(),
                        condition: $('#condition').val().trim(),
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{route('api.admin.voucher.update')}}",
                        data: data,
                        dataType: "Json",
                        success: function (response) {
                            if(response.type == 'warning'){
                                toastr.warning(response.data);
                            }
                            if(response.type == 'success'){
                                toastr.success(response.data);
                            }
                            if(response.type == 'validate'){
                                for (const key in response.data) {
                                    $('.err_'+key).html(response.data[key]);
                                }
                            }
                            console.log(response);
                        },
                        error: () => {
                            toastr.error('Đã xảy ra lỗi! Vui lòng thử lại sau!');
                        }
                    });
                });
            });
        </script>
    @endsection
