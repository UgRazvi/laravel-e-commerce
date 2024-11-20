<!DOCTYPE html>
<html class="no-js" lang="en_AU">

@include('front.layouts.head')

<body data-instant-intensity="mousedown">

    @include('front.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('front.layouts.footer')

    <!-- Wishlist modal -->
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Wishlist modal
    </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    @include('front.layouts.scripts')

    @yield('customJS')

</body>

</html>
