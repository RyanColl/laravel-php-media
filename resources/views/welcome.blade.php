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
        <div class="panel-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                    <?php
                        require_once(app_path().'/includes/upload.php')
                    ?>
                </div>
            @endif
            @if ($message = Session::get('failure'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong value=>{{ Session::get('failure') }}</strong>
                    <strong><a href="#file_constraints">constraints below</a></strong>
                    <!-- <strong>{{ Session::get('file') }}</strong> -->
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" name="file_submit" class="btn btn-success">Upload</button>
                    </div>

                </div>
            </form>

            </div>
            <?php include(app_path().'/includes/regex.php'); ?>
    </div>
    <div class="data-form">
        <span class="data-span">
        </span>
    </div>
</body>
</html>
