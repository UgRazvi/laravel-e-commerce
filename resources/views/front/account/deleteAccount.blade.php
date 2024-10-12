@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp


    <div class="container">

        <div class="card">

            <div class="head-portion mx-5 px-5 pt-5">
                <h5 class=""><strong>Delete Account</strong></h5>
                <hr>
            </div>

            <div class="container">

                <div class="delete-image text-center" id="deleteAccountTermsImage">
                    <img src="{{ asset('front-assets/images/Delete-Page-Image.jpg') }}" alt="Delete Page Image" class="w-50">
                </div>

                <div class="container my-4" id="deleteAccountTerms">
                    <span class=" mx-2 h5">Is this goodbye? Are you sure you don't want to reconsider?</span>

                    <ul class="pl-3 custom-bullet">
                        <li class="mb-3 mt-3">
                            <strong>You'll lose your order history, saved details, Myntra Credit, MynCash, SuperCoins, and
                                all other coupons and benefits.</strong><br>
                            Any account-related benefits will be forfeited once the account is deleted and will no longer be
                            available to you. You cannot recover the same. However, you can always create a new account. By
                            deleting your account, you acknowledge you have read our Privacy Policy.
                        </li>

                        <li class="mb-3">
                            <strong>Any pending orders, exchanges, returns, or refunds will no longer be accessible via your
                                account.</strong><br>
                            Myntra will try to complete the open transactions in the next 30 days on a best-effort basis.
                            However, we cannot ensure tracking & traceability of transactions once the account is deleted.
                        </li>

                        <li class="mb-3">
                            <strong>Myntra may not extend New User coupon if an account is created with the same mobile
                                number or email id.</strong>
                        </li>

                        <li class="mb-3">
                            <strong>Myntra may refuse or delay deletion in case there are any pending grievances related to
                                orders, shipments, cancellations, or any other services offered by Myntra.</strong>
                        </li>

                        <li class="mb-3">
                            <strong>Myntra may retain certain data for legitimate reasons such as security, fraud
                                prevention, future abuse, regulatory compliance including exercise of legal rights or
                                compliance with legal orders under applicable laws.</strong>
                        </li>
                    </ul>

                    <div class="input-group mb-3">
                        <input type="checkbox" name="agree-terms" id="agree-terms">
                        <label for="agree-terms" class="mx-2">I agree to all the terms and conditions*</label>
                    </div>

                    <div class="row alignn-items-center justify-content-between">

                        <a href="#" id="delete-account-anyway" class="col-5 text-center" style="width: 48%">
                            <button class=" btn btn-outline-danger w-100" id="delete-account">
                                <span> DELETE ANYWAY </span>
                            </button>
                        </a>

                        <a href="{{ route('account.profile') }}" class="col-5 text-center" style="width: 48%">
                            <button class="btn btn-danger w-100" id="keep-account">
                                <span> KEEP ACCOUNT </span>
                            </button>

                        </a>
                    </div>

                    <p id="warning-message" class="text-danger" style="display:none;">Please agree to the terms before
                        deleting your account.</p>

                </div>

                <div class="container my-4" id="deleteAccountSuggestion">
                    <form method="post" action="{{ route('account.deleteAccountSuggestion') }}" id="deleteAccountForm"
                        class="deleteAccountForm">
                        @csrf
                        <strong>Why are you leaving us?</strong>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="prod_exp" id="prod_exp" value="yes">
                            <label class="form-check-label" for="prod_exp">I find the products very expensive</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="bad_return" id="bad_return"
                                value="yes">
                            <label class="form-check-label" for="bad_return">Returns experience is not good</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="less_variety" id="less_variety"
                                value="yes">
                            <label class="form-check-label" for="less_variety">Not enough variety in the catalogue</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="excessive_communication"
                                id="excessive_communication" value="yes">
                            <label class="form-check-label" for="excessive_communication">I'm getting too many
                                communications from Myntra</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="other" id="other" value="yes">
                            <label class="form-check-label" for="other">Others</label>
                        </div>

                        <label for="suggestion_box" class="form-label">How can we improve?</label>
                        <textarea name="suggestions" id="suggestion_box" class="form-control" cols="30" rows="5" maxlength="200"
                            placeholder="Add your suggestions here"></textarea>
                        <label for="word_count" id="word_count" class="form-label text-end">0/200</label>

                        <button type="submit" class="btn btn-danger w-100">DELETE ACCOUNT</button>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <style>
        .custom-bullet li::before {
            content: "\25A0";
            color: black;
            margin-right: 10px;
        }

        .form-label {
            margin-top: 10px;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('#suggestion_box').on('input', function() {
                let text = $(this).val();
                let letterCount = text.replace(/\s/g, '').length;
                if (letterCount > 200) {
                    $(this).val(text.slice(0, 200));
                    letterCount = 200;
                }
                $('#word_count').text(letterCount + '/200');
            });

            $("#deleteAccountSuggestion").hide();

            $("#delete-account").click(function() {
                if ($("#agree-terms").is(":checked")) {
                    $("#warning-message").hide();
                    $("#deleteAccountTerms").hide();
                    $("#deleteAccountTermsImage").hide();
                    $("#deleteAccountSuggestion").show();
                } else {
                    $("#warning-message").show();
                }
            });

            $("#delete-account-anyway").click(function(event) {
                if (!$("#agree-terms").is(":checked")) {
                    event.preventDefault();
                    $("#warning-message").show();
                }
            });
        });
    </script>
@endsection
