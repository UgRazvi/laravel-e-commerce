<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/notify.js') }}"></script>
<script src="{{ asset('front-assets/js/notify.min.js') }}"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    window.onscroll = function() {
        myFunction()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addToCart(id) {
        $.ajax({
            url: '{{ route('front.addToCart') }}', // Route for adding item to cart
            type: 'post',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response) { // Use 'response' for handling the server response
                if (response.status == false) {
                    window.location.href = "{{ route('account.login') }}";
                } else {
                    window.location.href = "{{ route('front.cart') }}";
                }
            },
            error: function(xhr, status, error) { // Error handling for AJAX request failure
                console.error(
                    '\n Error:', error,
                    "\n Status : ", status,
                    "\n XHR : ", xhr,
                );
                alert("An error occurred while adding the product to the cart.", error);
            }
        });
    }

    function addToWishList(id) {
        // alert(id);
        $.ajax({
            url: '{{ route('front.addToWishList') }}',
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response) {
                // alert("Great.");
               
                if (response.status == false) {
                    alert("Sorry Unauthorized Access.");
                    window.location.href =
                        "{{ route('account.login') }}";
                } else {
                    // alert("Great 2.");
                    $("#wishlistModal .modal-body").html(response.message);
                    $("#wishlistModal").modal('show');
                    // window.location.href = "{{ route('front.wishlist') }}";
                }
            },
            error: function(xhr, status, error) {
                console.error(
                    '\n Error:', error,
                    "\n Status : ", status,
                    "\n XHR : ", xhr,
                );
                alert('Sorry An error occurred while updating the WishList.');
            }
        });

    }
</script>
