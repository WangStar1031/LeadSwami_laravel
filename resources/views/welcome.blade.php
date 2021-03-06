<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LeadSwami</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- icon -->
        <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="WelcomeContents">
        <div class="flex-center position-ref full-height">
            <div class="content LeftContent">
                <div class="m-b-md centerContent">
                    <img src="{{asset('img/favicon.png')}}">
                    <p style="font-size: 1.2em;"><strong>Lead</strong> swami</p>
                    <div class="space"></div>
                    <a href="
                    @php
                    echo App\Http\Controllers\WelcomeController::getLoginUrl();
                    @endphp
                    " class="BtnLogin" onclick="BtnLoginClicked()"><strong>in</strong> LOGIN WITH LINKEDIN</a>
                </div>
            </div>
            <div class="content rightContent">
                <div class="m-b-md centerContent">
                    <img src="{{asset('img/home_right.png')}}">
                </div>
            </div>
            </div>
        </div>
        <div class="loader" style="display: none;">Loading...</div>
    </body>
<script src="js/all.js"></script>
</html>
