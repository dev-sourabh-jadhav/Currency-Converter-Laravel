<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Currency Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <style>
        body {
            background-color: #f8f9fa;
        }

        .converter-card {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .select2-container .select2-selection--single {
            height: 40px;
            padding: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .form-group label {
            font-weight: bold;
        }

        .currency-icon {
            font-size: 18px;
            margin-right: 10px;
        }

        .result-box {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            background-color: #e9ecef;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card converter-card">
            <h2 class="text-center">💰 Currency Converter</h2>
            <form id="currencyForm">
                <div class="form-group">
                    <label for="amount">Enter Amount:</label>
                    <input type="number" class="form-control" id="amount" placeholder="Enter amount" required>
                </div>

                <div class="form-group">
                    <label for="fromCurrency">From Currency:</label>
                    <select class="form-control" id="fromCurrency" required>
                        <option value="" selected>Select Currency</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="toCurrency">To Currency:</label>
                    <select class="form-control" id="toCurrency" required>
                        <option value="" selected>Select Currency</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Convert</button>
            </form>

            <div id="result" class="result-box mt-3">
                Converted Amount will appear here.
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>



</body>

</html>
