@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user(); // Get the authenticated user
        $userAddress = $user ? $user->customerAddresses()->exists() : false; // Check if the user has any saved addresses
    @endphp
    <div class="container">

        <div class="col-lg-12 col-md-12 col-sm-12 mb-4 @if (!$user || !$userAddress) d-none @endif" id="haveAddress">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0" id="deliverToText"><strong>Select Delivery Address</strong></h3>
                <div class="card mt-1 p-3">
                    <a href="#" class="text-PRIMARY addNewAddress" id="addNewAddress" data-bs-toggle="modal"
                        data-bs-target="#addAddressModal"> <STRONG>+ Add New Address
                        </STRONG> </a>
                </div>
            </div>

            @foreach (getCustomerAddresses() as $custAdd)
                @if ($custAdd->default_address == true)
                    <strong>Default Address</strong>
                @endif
                <div class="card border-1 p-3">
                    <input type="radio" name="default_address" id="default_address_{{ $custAdd->id }}"
                        value="{{ $custAdd->id }}" @if ($custAdd->default_address ?? 0) checked @endif>
                    <label for="userName">{{ $custAdd->name ?? 'User Name' }}</label>
                    <span>{{ $custAdd->mobile_no ?? 'Mobile No.' }}</span>
                    <span>{{ $custAdd->address ?? 'Address' }}</span>
                    <span>{{ $custAdd->locality_town ?? 'Locality, Town' }}</span>
                    <span>{{ $custAdd->pincode ?? 'Pincode' }}</span>
                    <span>{{ $custAdd->city ?? 'City' }}</span>
                    <span>{{ $custAdd->state ?? 'State' }}</span>
                    <span>{{ $custAdd->type ?? 'Address Type' }}</span>
                    <span>Pay on Delivery available</span>
                    <hr>
                    <div class="d-flex">
                        <div class="editButton col-6">
                            <button class="btn editAddress w-100 " data-cust="{{ $custAdd }}"
                                data-id="{{ $custAdd->id }}" data-name="{{ $custAdd->name }}"
                                data-mobile_no="{{ $custAdd->mobile_no }}" data-pincode="{{ $custAdd->pincode }}"
                                data-address="{{ $custAdd->address }}" data-locality_town="{{ $custAdd->locality_town }}"
                                data-city="{{ $custAdd->city }}" data-state="{{ $custAdd->state }}"
                                data-type="{{ $custAdd->type }}"
                                data-default_address="{{ $custAdd->default_address }}">Edit </button>
                        </div>

                        <form action="{{ route('address.destroy', $custAdd->id) }}" method="POST"
                            class="remove-address-form col-6">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100 ">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Modal for Adding New Address -->
            <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="addAddressLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAddressLabel">Add New Address</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('address.store') }}" method="POST" id="addAddressForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="add_name" class="form-label mb-2">CONTACT DETAILS</label>
                                    <input type="text" name="name" id="add_name" class="form-control mb-2"
                                        placeholder="Name*" required>
                                    <div class="invalid-feedback" id="error-add-name"></div>

                                    <input type="text" name="mobile_no" id="add_mobile_no" class="form-control mb-2"
                                        placeholder="Mobile No*" required>
                                    <div class="invalid-feedback" id="error-add-mobile_no"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="add_address" class="form-label mb-2">ADDRESS</label>
                                    <input type="text" name="pincode" id="add_pincode" class="form-control mb-2"
                                        placeholder="Pincode*" required>
                                    <div class="invalid-feedback" id="error-add-pincode"></div>

                                    <input type="text" name="address" id="add_address" class="form-control mb-2"
                                        placeholder="Address*" required>
                                    <div class="invalid-feedback" id="error-add-address"></div>

                                    <input type="text" name="locality_town" id="add_locality_town"
                                        class="form-control mb-2" placeholder="Locality/Town*" required>
                                    <div class="invalid-feedback" id="error-add-locality_town"></div>

                                    <input type="text" name="city" id="add_city" class="form-control mb-2"
                                        placeholder="City/District*" required>
                                    <div class="invalid-feedback" id="error-add-city"></div>

                                    <input type="text" name="state" id="add_state" class="form-control mb-2"
                                        placeholder="State*" required>
                                    <div class="invalid-feedback" id="error-add-state"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="type" class="form-label mb-2">SAVE ADDRESS AS</label>
                                    <div class="d-flex gap-2">
                                        <input type="radio" name="type" id="add_home" value="home" required>
                                        Home
                                        <input type="radio" name="type" id="add_work" value="work" required>
                                        Work
                                    </div>
                                </div>

                                <!-- Default Address Checkbox -->
                                <div class="form-group mb-3">
                                    <input type="hidden" name="default_address" value="0">
                                    <!-- Hidden default value (non-default) -->
                                    <input type="checkbox" name="default_address" id="add_default_address"
                                        value="1">
                                    <label for="add_default_address" class="form-label">Mark this as my default
                                        address</label>
                                </div>

                                <button type="submit" class="btn btn-danger w-100">Add Address</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Editing Address -->
            <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog"
                aria-labelledby="editAddressLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAddressLabel">Edit Address</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" id="editAddressForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="address_id" id="address_id">

                                <div class="form-group mb-3">
                                    <label for="edit_name" class="form-label mb-2">CONTACT DETAILS</label>
                                    <input type="text" name="name" id="edit_name" class="form-control mb-2"
                                        placeholder="Name*" value="">
                                    <div class="invalid-feedback" id="error-name"></div>

                                    <input type="text" name="mobile_no" id="edit_mobile_no" class="form-control mb-2"
                                        placeholder="Mobile No*" value="">
                                    <div class="invalid-feedback" id="error-mobile_no"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="edit_address" class="form-label mb-2">ADDRESS</label>
                                    <input type="text" name="pincode" id="edit_pincode" class="form-control mb-2"
                                        placeholder="Pincode*" value="">
                                    <div class="invalid-feedback" id="error-pincode"></div>

                                    <input type="text" name="address" id="edit_address" class="form-control mb-2"
                                        placeholder="Address*" value="">
                                    <div class="invalid-feedback" id="error-address"></div>

                                    <input type="text" name="locality_town" id="edit_locality_town"
                                        class="form-control mb-2" placeholder="Locality/Town*" value="">
                                    <div class="invalid-feedback" id="error-locality_town"></div>

                                    <input type="text" name="city" id="edit_city" class="form-control mb-2"
                                        placeholder="City/District*" value="">
                                    <div class="invalid-feedback" id="error-city"></div>

                                    <input type="text" name="state" id="edit_state" class="form-control mb-2"
                                        placeholder="State*" value="">
                                    <div class="invalid-feedback" id="error-state"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="type" class="form-label mb-2">SAVE ADDRESS AS</label>
                                    <div class="d-flex gap-2">
                                        <input type="radio" name="type" id="edit_home" value="home">
                                        Home
                                        <input type="radio" name="type" id="edit_work" value="work">
                                        Work
                                    </div>
                                </div>

                                <!-- Default Address Checkbox -->
                                <div class="form-group mb-3">
                                    <input type="hidden" name="default_address" value="0">
                                    <!-- Hidden default value (non-default) -->
                                    <input type="checkbox" name="default_address" id="edit_default_address"
                                        value="1">
                                    <label for="edit_default_address" class="form-label">Mark this as my
                                        default address</label>
                                </div>

                                <button type="submit" class="btn btn-danger w-100">Update Address</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // JS : 01 - Showing Modal To Edit Address
        $(document).ready(function() {
            $('.editAddress').on('click', function() {
                // Get address data from the button's data attributes

                // const cust = $(this).data('cust');
                // console.log('cust', cust, 'cust AddID', cust.id);
                const addressId = $(this).data('id');
                const name = $(this).data('name');
                const mobileNo = $(this).data('mobile_no');
                const pincode = $(this).data('pincode');
                const address = $(this).data('address');
                const localityTown = $(this).data('locality_town');
                const city = $(this).data('city');
                const state = $(this).data('state');
                const type = $(this).data('type');
                const defaultAddress = $(this).data('default_address'); // Get the default address status

                // Set the data into the modal fields
                // $('#address_id').val(cust.id);
                $('#address_id').val(addressId);
                $('#edit_name').val(name);
                $('#edit_mobile_no').val(mobileNo);
                $('#edit_pincode').val(pincode);
                $('#edit_address').val(address);
                $('#edit_locality_town').val(localityTown);
                $('#edit_city').val(city);
                $('#edit_state').val(state);

                // Set the radio button for the address type
                if (type === 'home') {
                    $('#edit_home').prop('checked', true);
                } else {
                    $('#edit_work').prop('checked', true);
                }

                // Set the checkbox for default address
                if (defaultAddress == 1) {
                    $('#edit_default_address').prop('checked', true);
                } else {
                    $('#edit_default_address').prop('checked', false);
                }


                // Show the modal
                $('#editAddressModal').modal('show');

                // Update the form action with the correct route
                $('#editAddressForm').attr('action', `/account/address/${addressId}`);
            });
        });
    </script>
@endsection
