<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            padding: 30px;
            background-color: #1a1a1a;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ff4d4d;
        }

        img {
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }

        .btn-go-back {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #ff4d4d;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-go-back:hover,
        .btn-go-back:focus {
            background-color: #e60000;
            outline: 2px solid #fff;
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    <main role="main" aria-labelledby="payment-failed-heading">
        <section class="container" role="alertdialog" aria-describedby="payment-failed-description">
            <h1 id="payment-failed-heading">Payment Failed</h1>
            <img src="{{ asset('assets/images/paymentfailed.gif') }}" alt="An animation showing a failed payment status">
            <p id="payment-failed-description">
                There was an issue processing your payment. Please try again or contact support.
            </p>
            <a href="/" class="btn-go-back" role="button" aria-label="Go back to homepage">Go Back</a>
        </section>
    </main>
</body>

</html>
