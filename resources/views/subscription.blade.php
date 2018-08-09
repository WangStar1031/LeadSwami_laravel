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
	@include('sidebar', ['active' => 'subscription', 'email'=>$email])
	@include('subscription_contents',['email'=>$email, 'isActive'=>$isActive, 'cardNumber'=>$cardNumber, 'errMsg'=>$errMsg])
</body>
<script type="text/javascript">
    
var stripeCode = '{{ env('STRIPE_KEY') }}';

</script>
    <script src="js/jquery.min.js"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script src='js/jquery.inputmask.bundle.js'></script>
    <script src="js/all.js"></script>
</html>