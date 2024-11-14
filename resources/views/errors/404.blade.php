<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page  Not Found - 404</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 50px;
            margin-top: 100px;
        }
        h1 {
            font-size: 100px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 24px;
            color: #555;
        }
        p {
            font-size: 18px;
            color: #777;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oops! Page Not Found</h2>
        <p>Sorry, the page you are looking for might have been moved or doesn't exist.</p>
        <a href="{{ url('/') }}">Go back to Home</a>
    </div>
</body>
</html>
