
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
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
        	body{ margin: 0px; background-color: #f0f0f0; }
        	.topArea{ width: 150px; margin: auto; margin-top: 20px; margin-bottom: 5px; border-radius: 10px; height: 12px; background-color: #f0f0f0f0; border: 1px solid #ddd;}
        	.contents{ text-align: center; width: 500px; margin: auto; margin-top: 30px; border-radius: 10px; background-color: white; color: gray;box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.16);}
        	.Imgs  img{ width: 100px; border-radius: 100%;}
        	.avatarImg{ float: left; }
        	.zapierImg{ float: right; }
        	.title h3{ margin: 30px; }
        	.bellowContents{text-align: left; font-size: 1.2em; }
        	.bellowContents p{ margin-top: 20px; }
        	.SignForm{ background-color: #555; color: white; padding-bottom: 20px;}
        	.infoEdit input{ color: black; width: 100%; }
        	.infoEdit p{ text-align: left; margin-left: 15px; margin-top: 10px;}
        	.bottomContents{ padding: 15px 0px 10px 0px; font-weight: bold; color: gray;}
        	input[type='submit']{ float: left; text-align: left; border: none; color: gray; padding: 8px 12px 8px 12px; font-weight: bold; font-size: 1.2em; margin-top: 12px; margin-right: 10px; border-radius: 5px;}
        	.btnAllow{ background-color: #0682ca; color: white!important;}
        </style>
    </head>
	<body>
		<div class="contents row">
			<div class="Header">
				<div class="topArea">
					
				</div>
			</div>
			<div class="Imgs col-xs-12">
				<div class="col-xs-6">
					<img src="@php echo $avatar == '' ? '/img/avatar.png' : $avatar;@endphp" class="avatarImg">
				</div>
				<div class="col-xs-6">
					<img src="/img/zapier.png" class="zapierImg">
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
			<form class="col-xs-12 SignForm">
				<h3>Sign in to Leadswamiand allow access:</h3>
				<div class="col-xs-12 infoEdit">
					<div class="col-xs-6">
						<input type="text" name="email" value="@php echo $email;@endphp">
					</div>
					<div class="col-xs-6">
						<input type="password" name="password">
					</div>
					<br>
					<p>Join Leadswami</p>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-12">
						<input type="submit" name="btnAllow" value="Allow access" class="btnAllow">
						<input type="submit" name="btnCancel" value="Cancel">
					</div>
				</div>
			</form>
			<div class="col-xs-12 bottomContents">
				<p>Terms of Service | Privacy Policy</p>
			</div>
		</div>
	</body>
</html> 