
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
        </style>
    </head>
	<body>
		<div class="authZapier">
			<div class="contents row">
				<div class="Header col-xs-12">
					<div class="topArea">
					</div>
				</div>
				<div class="Imgs col-xs-12">
					<div class="row">
						<div class="col-xs-6">
							<img src="@php echo $avatar == '' ? '/img/avatar.png' : $avatar;@endphp" class="avatarImg">
						</div>
						<div class="col-xs-6">
							<img src="/img/zapier.png" class="zapierImg">
						</div>
					</div>
				</div>
				<div class="col-xs-12 title">
					<h3>Zapier would like to access some of your Leadswami info:</h3>
				</div>
				<div class="col-xs-12 bellowContents">
					<ul>
						<li>First Name, Last Name and Email</li>
						<li>Profiles</li>
						<li>Profile scrapping notification</li>
					</ul>
					<p>Zapier's terms apply. You can change this anytime from your settings.</p>
				</div>
				<form class="col-xs-12 SignForm" action="/api/oauthZapier/submit" method="post">
					{{ csrf_field() }}
					<h3>Sign in to Leadswamiand allow access:</h3>
					<div class="col-xs-12 infoEdit">
						<div class="row">
							<div class="col-xs-6">
								<input type="text" name="email" value="@php echo $email;@endphp">
							</div>
							<div class="col-xs-6">
								<input type="password" name="password">
							</div>
							<br>
							<p>Join Leadswami</p>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-12">
								<input type="submit" name="btnAllow" value="Allow access" class="btnAllow">
								<a href="@php echo $redirect_uri.'?error=access_denied&errordescription=the user denied your request';@endphp" class="btnCancel">Cancel</a>
								<!-- <input type="submit" name="btnCancel" value="Cancel"> -->
							</div>
						</div>
					</div>
					<input type="hidden" name="client_id" value="@php echo $client_id;@endphp">
					<input type="hidden" name="redirect_uri" value="@php echo $redirect_uri;@endphp">
					<input type="hidden" name="state" value="@php echo $state;@endphp">
				</form>
				<div class="col-xs-12 bottomContents">
					<p>Terms of Service | Privacy Policy</p>
				</div>
			</div>
		</div>
	</body>
</html> 