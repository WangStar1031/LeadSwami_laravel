<?php
    // include "linkedin.php";
    // $linkedin = new LinkedIn(array(
    //     'apiKey' => '817ghsoujbnznd',
    //     'apiSecret' => 'QgrxQm1Dsup3D5J9',
    //     'callbackUrl' => 'http://mytest.com:8000/dashboard',
    // ));
    // $url = $linkedin->getLoginUrl();
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LeadSwami</title>

        <!-- Fonts
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <!-- icon -->
        <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                width: 350px;
                height: 600px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .BtnLogin{
                padding: 10px;
                border-radius: 5px;
                background-color: #147ab6;
                text-decoration: none;
                color: white;
            }
            .LeftContent{
                padding-top: 0px;
            }
            .rightContent{
                background: linear-gradient(#f98949, #fbe080);
            }
            .LeftContent, .rightContent{
                width: 50%; height: 100%;
            }
            .centerContent{
                top: 50%;
                position: absolute;
                transform: translateY(-50%);
                margin: auto;
                width: 50%;
            }
            .space{
                height: 30px;
            }
        </style>
    </head>
    <body>
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
                    " class="BtnLogin"><strong>in</strong> LOGIN WITH LINKEDIN</a>
                </div>
            </div>
            <div class="content rightContent">
                <div class="m-b-md centerContent">
                    <img src="{{asset('img/home_right.png')}}">
                </div>
            </div>
            </div>
        </div>
    </body>
</html>
