@include('front.layouts.head')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>
</head>
<body>
    <form action="{{ $action }}" method="post" name="payuForm">
        @csrf <!-- Ensure CSRF protection -->
        <input type="hidden" name="key" value="{{ $MERCHANT_KEY }}" />
        <input type="hidden" name="hash" value="{{ $hash }}" />
        <input type="hidden" name="txnid" value="{{ $txnid }}" />
        <input type="" name="amount" value="{{ $amount }}" />
        <input type="" name="firstname" id="firstname" value="{{ $name }}" />
        <input type="" name="email" id="email" value="{{ $email }}" />
        <input type="hidden" name="productinfo" value="Webappfix">
        <input type="hidden" name="surl" value="{{ $successURL }}" />
        <input type="hidden" name="furl" value="{{ $failURL }}" />
        <input type="hidden" name="service_provider" value="payu_paisa" />
        <button type="submit">Pay</button>
    </form>
    {{-- <script>
        document.forms['payuForm'].submit();
    </script> --}}
</body>

</html>
