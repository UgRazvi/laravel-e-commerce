<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            font-family: 'Arial', sans-serif;
        }

        .thank-you-container {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            animation: fadeIn 1s ease-in-out;
        }

        .thank-you-header img {
            width: 150px;
            animation: slideIn 1.5s ease;
        }

        .thank-you-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .thank-you-content p {
            font-size: 1.2rem;
            color: #555;
        }

        .transaction-details {
            margin-top: 30px;
        }

        .transaction-details p {
            font-size: 1rem;
            color: #333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="container thank-you-container text-center">
        <div class="thank-you-header">
            <!-- Add a thank-you image -->
            <img src="data:image/jpeg;base64,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"
                alt="Thank You Clipart">
            <h1>Thank You!</h1>
        </div>
        <div class="thank-you-content">
            <p>Your payment was successful. We appreciate your business.</p>

            @if (Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            <!-- Transaction Details -->
            <div class="transaction-details">
                <p>Your Transaction ID: <strong>{{ $txnId }}</strong></p>
               
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
