<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password Email</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">


    {{-- @dd($formData); --}}
    <p> {!!$formData['user']->name!!} </p>

    <h1>We received your request to change/update your password</h1>
    <p>Please click the link below to change the password</p>
    <a href="{{route('front.resetPassword', $formData['token'])}}">Click Here to Reset Password</a>
    {{-- @dd($formData['token']); --}}

    {{-- <p>Name: {{ $mailData['name'] }}</p>
    <p>Email: {{ $mailData['email'] }}</p>
    <p>Subject: {{ $mailData['subject'] }}</p>
    <p>Message:</p>
    <p>{{ $mailData['message'] }}</p> --}}

    <p>Thanks</p>

</body>

</html>