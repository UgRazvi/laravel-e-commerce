<!DOCTYPE html>
<html>

<head>
    <title>PayU Payment</title>
</head>

<body>
    <form action="{{ env('PAYU_URL') }}" method="POST" name="payuPaymentForm">
        {{-- @dd(env('PAYU_URL'), $data); --}}
        @csrf
        @foreach ($data as $key => $value)
            <input type="text" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="submit" value="Pay Now">
    </form>
    <script>
        document.forms['payuPaymentForm'].submit();
    </script>
</body>

</html>
