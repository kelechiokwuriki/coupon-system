<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coupon</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">


    </head>
    <body>
        <div id="app">
            <checkout-component></checkout-component>
        </div>

        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
