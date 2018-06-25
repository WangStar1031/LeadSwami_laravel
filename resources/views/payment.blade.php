
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LeadSwami</title>

        <!-- icon -->
        <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
        	body{ margin: 0px; }
        </style>
    </head>
<body>
	@include('topbar',['email'=>$email])
	@include('sidebar', ['active' => 'payment', 'email'=>$email])
	@include('payment_contents',['email'=>$email, 'billData'=>$billData, 'billHistory'=>$billHistory])
</body>
</html>