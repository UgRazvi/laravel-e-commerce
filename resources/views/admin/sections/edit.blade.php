@extends('admin.layouts.app')

@section('dyn-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Section</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('sections.index') }}" class="btn btn-primary">Back</a>
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
            <form action="{{ route('sections.update', $section->id) }}" method="POST" id="sectionForm"
                name="sectionForm">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $section->name }}" name="name" id="name"
                                        class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" value="{{ $section->slug }}" readonly name="slug"
                                        id="slug" class="form-control" placeholder="Slug">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" name="image_id" value="" id="image_id">
                                    <label for="image">Image</label>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($section->image))
                                    <div class="show-img-if-present">
                                        <img src="{{ asset('uploads/Sections/' . $section->image) }}" alt="Your Image">
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    {{-- @php --}}
                                    {{-- echo "$section->status"; // Testing Purpose  --}}
                                    {{-- @endphp --}}
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $section->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        {{-- Using Ternary Operator (if-true) ? 'suucess' : 'fail' --}}
                                        <option {{ $section->status == 0 ? 'selected' : '' }} value="0">Block</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status">Show On Home</label>
                                    {{-- @php --}}
                                    {{-- echo "$section->status"; // Testing Purpose  --}}
                                    {{-- @endphp --}}
                                    <select name="showhome" id="showhome" class="form-control">
                                        <option {{ $section->showhome == 'Yes' ? 'selected' : '' }} value="Yes">Yes
                                        </option>
                                        {{-- Using Ternary Operator (if-true) ? 'suucess' : 'fail' --}}
                                        <option {{ $section->showhome == 'No' ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Upadte</button>
                    <a href="{{ route('sections.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
        // console.log("Script Is Working"); // For Debugging Purpose.

        $("#sectionForm").submit(function(event) {
            // console.log("Category Form Is Working"); // For Debugging Purpose.
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop['disabled', true];
            $.ajax({
                url: '{{ route('sections.update', $section->id) }}', // Change - Usman  ", $section->id"
                type: 'PUT',
                data: element.serialize(),
                dataType: 'json',
                success: function(response) {
                    // console.log("Category Form Success Response Is Working"); // For Debugging Purpose.
                    $("button[type=submit]").prop['disabled', false];
                    if (response["status"] == true) {
                        console.log(
                            "Section Form Success Response True Is Working"); // For Debugging Purpose.
                        window.location.href = "{{ route('sections.index') }}";
                        $("#name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("$name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    } else {
                        if (response['notFound' == true]) {
                            //  If We Don't have Data In Our DataBase, We've To Redirect To Index Page.
                            window.location.href = '{{ route('sections.index') }}';
                            console.log("Unable To Delete, Section Not Found.");
                        }
                        console.log(
                            "Section Form Success Response False Is Working"
                        ); // For Debugging Purpose.
                        var errors = response['errors'];
                        if (errors['name']) {
                            // console.log("Name Error Is Working"); // For Debugging Purpose.
                            $('#name').addClass('is-invalid').siblingss('p').addClass('invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid').siblingss('p').removeClass(
                                'invalid-feedback').html("");
                        }
                        if (errors['slug']) {
                            // console.log("Slug Error Is Working"); // For Debugging Purpose.
                            $('#slug').addClass('is-invalid').siblingss('p').addClass('invalid-feedback')
                                .html(errors['slug']);
                        } else {
                            $('#slug').removeClass('is-invalid').siblingss('p').removeClass(
                                'invalid-feedback').html("");
                        }
                    }

                },
                error: function(jqXHR, exception) {
                    // console.log("CSRF Token Error Is Working"); // For Debugging Purpose.
                    // console.log("Something Went Wrong");
                }
            });
        });

        $("#name").change(function() {
            var element = $(this);
            // console.log("Name Change Is Working"); // For Debugging Purpose.
            $("button[type=submit]").prop['disabled', true];
            $.ajax({
                url: '{{ route('get.slug') }}',
                type: 'get',
                data: {
                    title: element.val()
                },
                dataType: 'json',
                success: function(response) {
                    // console.log("Name Change Response Is Working"); // For Debugging Purpose.
                    $("button[type=submit]").prop['disabled', false];
                    if (response['status']) {
                        // console.log("Name Change Response If Is Working"); // For Debugging Purpose.
                        $("#slug").val(response['slug']);
                    }
                }
            });
        });

        // Dropzone
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                console.log(response)
            }
        });
    </script>
@endsection
