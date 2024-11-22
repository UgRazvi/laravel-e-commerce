@extends('admin.layouts.app')

@section('dyn-content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <h1 class="mb-4 text-center">Create New Theme</h1>

            <form action="{{ route('themes.store') }}" method="POST" enctype="multipart/form-data" id="theme-form">
                @csrf

                <!-- Key Field -->
                <div class="form-group mb-4">
                    <label for="key" class="form-label">Key</label>
                    <input type="text" name="key" id="key" class="form-control form-control-lg" required placeholder="Enter the theme key">
                </div>

                <!-- Type Field -->
                <div class="form-group mb-4">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control form-control-lg" required>
                        <option value="color">Color</option>
                        <option value="logo">Logo (Image)</option>
                        <option value="text">Text</option>
                    </select>
                </div>

                <!-- Value Field -->
                <div class="form-group mb-4" id="value-container">
                    <label for="value" class="form-label">Value</label>
                    <input type="text" name="value" id="value" class="form-control form-control-lg" required placeholder="Enter the value">
                </div>

                <!-- Logo Upload Field (Hidden by Default) -->
                {{-- <div class="form-group mb-4" id="logo-upload" style="display:none;">
                    <label for="logo" class="form-label">Logo (Image)</label>
                    <div id="logo-dropzone" class="dropzone"></div> <!-- Dropzone element -->
                    <input type="hidden" name="logo" id="logo" />
                </div> --}}
                <div id="image" class="mb-4 dropzone dz-clickable">

                    <input type="hidden" name="image_id" value="image_id" id="image_id">
                    <div class="dz-message needsclick">
                        <br>Drop files here or click to upload.<br><br>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-lg w-100">Create Theme</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('customJs')


<script>
    // Dynamically change the form input based on the selected 'type'
    document.getElementById('type').addEventListener('change', function() {
        let type = this.value;
        let valueInput = document.getElementById('value-container');
        let logoUpload = document.getElementById('image');
        let valueField = document.getElementById('value');

        // Show the appropriate input based on the selected type
        if (type === 'logo') {
            valueInput.style.display = 'none';
            logoUpload.style.display = 'block';
            valueField.removeAttribute('required');  // Remove 'required' from value input
        } else {
            valueInput.style.display = 'block';
            logoUpload.style.display = 'none';
            valueField.setAttribute('required', 'true');  // Add 'required' to value input
        }
    });

    // Trigger the type change event to set the correct input visibility on page load
    document.getElementById('type').dispatchEvent(new Event('change'));


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
