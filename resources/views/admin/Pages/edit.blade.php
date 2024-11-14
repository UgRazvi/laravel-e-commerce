@extends('admin.layouts.app')
@section('dyn-content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Page</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('pages.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <form action="{{ route('pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Specify that this is a PUT request for editing -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                         <!-- Page Name -->
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $page->name) }}">
                            </div>
                        </div> 
                         <!-- Page Slug -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ old('name', $page->slug) }}">
                            </div>
                        </div>
                         <!-- Page Content -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="summernote" cols="30" rows="10">
                                    {{ old('name', $page->content) }}
                                </textarea>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $page->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $page->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>

    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
@section('customJs')
    <script>
        $(document).ready(function() {
            // When the name input changes
            $('#name').on('input', function() {
                var name = $(this).val();             // Get the value of the name input
                var slug = generateSlug(name);        // Generate the slug based on the name
                $('#slug').val(slug);                 // Set the generated slug in the slug input
            });
            
            // Function to generate the slug
            function generateSlug(str) {
                return str
                    .toString()                      // Convert to string
                    .toLowerCase()                   // Convert to lowercase
                    .trim()                          // Remove leading/trailing spaces
                    .replace(/\s+/g, '-')            // Replace spaces with hyphens
                    .replace(/[^\w\-]+/g, '')        // Remove non-alphanumeric characters
                    .replace(/\-\-+/g, '-')          // Replace multiple hyphens with a single hyphen
                    .replace(/^-+/, '')              // Remove hyphen from the beginning
                    .replace(/-+$/, '');             // Remove hyphen from the end
            }
        });
    </script>
@endsection