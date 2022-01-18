<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>React && Laraval</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <!-- React root DOM -->
    <div id="user">
    </div>

    <!-- React JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- PHP -->
    <div class="data-form">
        <?php 
            include(app_path().'/includes/data.php');
            
        ?>
    </div>
    <div class="data-form">
        <span class="data-span">
            <?php 
                
                
            
            ?>
        </span>
    </div>
</body>
</html>