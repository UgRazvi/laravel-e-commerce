@extends('admin.layouts.app')

@section('dyn-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupon</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('coupon.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        {{-- Section : X-03 --}}
        <div class="container-fluid">
            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST" id="couponForm" name="couponForm">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code">Coupon Code</label>
                                    <input type="text" name="code" id="code" value="{{ $coupon->code }}"
                                        class="form-control" placeholder="Coupon Code">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Coupon Name</label>
                                    <input type="text" name="name" id="name" value="{{ $coupon->name }}"
                                        class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $coupon->description }}</textarea>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_usage">Maximum Usage Limit</label>
                                    <input type="number" name="max_usage" id="max_usage" value="{{ $coupon->max_usage }}"
                                        class="form-control" placeholder="Maximum Usage Limit">
                                    <p></p>
                                </div>

                                <div class="mb-3">
                                    <label for="max_usage_user">Maximum Usage Limit Per User</label>
                                    <input type="number" name="max_usage_user" id="max_usage_user"
                                        value="{{ $coupon->max_usage_user }}" class="form-control"
                                        placeholder="Maximum Usage Limit Per User">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="text" name="discount_amount" id="discount_amount"
                                        value="{{ $coupon->discount_amount }}" class="form-control"
                                        placeholder="Discount Amount">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_amount">Minimum Amount</label>
                                    <input type="text" name="min_amount" id="min_amount"
                                        value="{{ $coupon->min_amount }}" class="form-control" placeholder="Minimum Amount">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Coupon Starts At</label>
                                    <input type="text" name="starts_at" id="starts_at" value="{{ $coupon->starts_at }}"
                                        class="form-control" placeholder="Coupon Starts At">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expires_at">Coupon Expires At</label>
                                    <input type="text" name="expires_at" id="expires_at"
                                        value="{{ $coupon->expires_at }}" class="form-control"
                                        placeholder="Coupon Expires At">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Coupon Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option {{ $coupon->type == 'fixed' ? 'selected' : '' }} value="fixed">Fixed
                                        </option>
                                        <option {{ $coupon->type == 'percent' ? 'selected' : '' }} value="percent">Percent
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories">Categories</label>
                                    <select name="categories[]" id="categories" class="form-control select2" multiple>
                                        @if (!empty($categories))
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, $coupon->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">Block</option>
                                        {{-- <option value="0">Block</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Upadte</button>
                    <a href="{{ route('coupon.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>

        </div>
        {{-- Section : X-03 --}}
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection


@section('customJs')
    <script>
        $(document).ready(function() {
            $('#starts_at').datetimepicker({
                format: 'Y-m-d H:i:s',
            });
            $('#expires_at').datetimepicker({
                format: 'Y-m-d H:i:s',
            });
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });

        // console.log("Script Is Working"); // For Debugging Purpose.

        // $("#couponForm").submit(function(event) {
        //     // console.log("Coupon Form Is Working"); // For Debugging Purpose.
        //     event.preventDefault();
        //     var element = $(this);
        //     $("button[type=submit]").prop['disabled', true];
        //     $.ajax({
        //         url: '{{ route('coupon.update', $coupon->id) }}', // Change - Usman  ", $coupon->id"
        //         type: 'PUT',
        //         data: element.serialize(),
        //         dataType: 'json',
        //         success: function(response) {
        //             // console.log("Coupon Form Success Response Is Working"); // For Debugging Purpose.
        //             $("button[type=submit]").prop['disabled', false];
        //             if (response["status"] == true) {
        //                 console.log(
        //                     "Category Form Success Response True Is Working"); // For Debugging Purpose.
        //                 window.location.href = "{{ route('categories.index') }}";
        //                 $("#name").removeClass('is-invalid').siblings('p').removeClass(
        //                     'invalid-feedback').html("");
        //                 $("$name").removeClass('is-invalid').siblings('p').removeClass(
        //                     'invalid-feedback').html("");
        //             } else {
        //                 if (response['notFound' == true]) {
        //                     //  If We Don't have Data In Our DataBase, We've To Redirect To Index Page.
        //                     window.location.href = '{{ route('categories.index') }}';
        //                     console.log("Unable To Delete, Category Not Found.");
        //                 }
        //                 console.log(
        //                     "Category Form Success Response False Is Working"
        //                 ); // For Debugging Purpose.
        //                 var errors = response['errors'];
        //                 if (errors['name']) {
        //                     // console.log("Name Error Is Working"); // For Debugging Purpose.
        //                     $('#name').addClass('is-invalid').siblingss('p').addClass(
        //                             'invalid-feedback')
        //                         .html(errors['name']);
        //                 } else {
        //                     $('#name').removeClass('is-invalid').siblingss('p').removeClass(
        //                         'invalid-feedback').html("");
        //                 }
        //                 if (errors['slug']) {
        //                     // console.log("Slug Error Is Working"); // For Debugging Purpose.
        //                     $('#slug').addClass('is-invalid').siblingss('p').addClass(
        //                             'invalid-feedback')
        //                         .html(errors['slug']);
        //                 } else {
        //                     $('#slug').removeClass('is-invalid').siblingss('p').removeClass(
        //                         'invalid-feedback').html("");
        //                 }
        //             }

        //         },
        //         error: function(jqXHR, exception) {
        //             // console.log("CSRF Token Error Is Working"); // For Debugging Purpose.
        //             // console.log("Something Went Wrong");
        //         }
        //     });
        // });
    </script>
@endsection
