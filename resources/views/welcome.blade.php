<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>React && Laraval</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        legend{
            text-align: center !important;
        }
        .row {
            flex-wrap: nowrap !important;
        }
        .body {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
        }
        .submit-form {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
        }
        .data-form {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-direction: column;
        }
        .user-fieldset{
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .user-fieldset div {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body>

    <!-- React root DOM -->
    <div id="user">
    </div>

    <!-- React JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- PHP -->
    <div class="data-form">
            @if ($cookie = Session::get('cookie'))
                <div class="alert alert-success alert-block">
                    <a href='/'><button type="button" class="close" data-dismiss="alert">×</button></a>
                    <strong>{{ $cookie }}</strong>
                </div>
            @endif
            <?php include(app_path().'/includes/cookies/cookies.php'); ?>
    </div>
    <div class="data-form">
        <span class="data-span">
        </span>
    </div>
</body>
</html>
