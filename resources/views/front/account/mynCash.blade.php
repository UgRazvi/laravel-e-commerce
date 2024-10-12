@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp

    <div class="card text-center p-3 pb-5">
        <div class="bg-white py-4">
            
            <div class="text-uppercase fw-bold text-success mb-2">
                Total Available MynCash
            </div>

            <div class="display-4 fw-bold text-dark mb-2">0</div>
            <div class="small">
                Your total MynCash is worth
                <span class="icon-icon icon-rupee500" style="font-size: 13px; font-weight: 500;"></span>
                0.00
                <span class="points-icon icon-icon icon-info"></span>
            </div>
            <div class="points-info small mt-2 text-center">
                You can pay up to 100% (may vary during sale & promotion events) of your order value through MynCash.
                Use
                them on the Payments page during checkout.
            </div>
        </div>
        <div class="small text-dark mt-3">
            You have <b>0</b> referral MynCash pending <span class="points-icon icon-icon icon-info"></span>
        </div>
    </div>

    <div class="card p-3 my-2 ">
        <span class="text-dark toggle-btn" data-list="eligibilityList" style="cursor: pointer;">
            <strong> Eligibility, Membership, Accrual </strong>
        </span>
        <div id="eligibilityList" class="dropdown-list p-2" style="display: none;"> <!-- Initially hidden -->
            <li class="my-2 px-4">
                These terms and conditions are operational only in India and open to participation of all the registered
                members, resident of India of Myntra, over and above the age of 18 years.
            </li>
            <li class="my-2 px-4">
                My Privilege program has been converted into MynCash Program. The same denomination is applicable for
                MynCash.
            </li>
        </div>
    </div>

    <div class="card p-3 my-2 ">
        <span class="text-dark toggle-btn" data-list="generalTermsList" style="cursor: pointer;">
            <strong> General terms and conditions </strong>
        </span>
        <div id="generalTermsList" class="dropdown-list p-2" style="display: none;"> <!-- Initially hidden -->
            <li class="my-2 px-4">
                Each member is responsible for remaining knowledgeable about the Myntra Program Terms and Conditions and the
                MynCash in his or her account.
            </li>
            <li class="my-2 px-4">
                Myntra will send correspondence to active members to advise them of matters of interest, including
                notification of Myntra Program changes and MynCash Updates.
            </li>
            <li class="my-2 px-4">
                Myntra will not be liable or responsible for correspondence lost or delayed in the mail/e-mail.
            </li>
            <li class="my-2 px-4">
                Myntra reserves the right to refuse, amend, vary or cancel membership of any Member without assigning any
                reason and without prior notification.
            </li>
            <li class="my-2 px-4">
                Any change in the name, address, or other information relating to the Member must be notified to Myntra via
                the Helpdesk/email by the Member, as soon as possible at support@myntra.com or call at +91-80-43541999 24
                Hours a Day / 7 Days a Week.
            </li>
            <li class="my-2 px-4">
                Myntra reserves the right to add, modify, delete or otherwise change the Terms and Conditions without any
                approval, prior notice or reference to the Member.
            </li>
            <li class="my-2 px-4">
                In the event of dispute in connection with Myntra Program and the interpretation of Terms and Conditions,
                Myntra's decision shall be final and binding.
            </li>
            <li class="my-2 px-4">
                This Policy and these terms shall be read in conjunction with the standard legal policies of Myntra,
                including its Privacy policy.
            </li>
        </div>
    </div>

    <style>
        .points-info {
            color: #7e818c;
        }

        .points-icon {
            font-size: 16px;
            color: rgb(82, 108, 208);
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.toggle-btn').click(function() {
                const listId = $(this).data('list'); // Get the ID of the list to toggle
                $(`#${listId}`).slideToggle(); // Toggle the display using slide effect
            });
        });
    </script>
@endsection
