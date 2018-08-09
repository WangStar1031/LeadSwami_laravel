<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="topBar">
	<a href="/dashboard">
		<img src="img/favicon.png">
		<span class="topTitle"><strong>Lead</strong> swami</span>
	</a>
	<div class="topUserInfo">
		<div class="dropdown">
			<div class="dropdown-toggle" type="button" data-toggle="dropdown">
				<span class="topUserName">
					@php
						echo App\Http\Controllers\UserInfoController::getUserName($email);
					@endphp
				</span>
				<span class="topUserAvatar">
					<img src="@php echo (App\Http\Controllers\UserInfoController::getUserAvatar($email) == '' ? 'img/avatar.png' : App\Http\Controllers\UserInfoController::getUserAvatar($email));@endphp">
				</span>
			</div>
			<ul class="dropdown-menu">
				<li><a href="logout">Logout</a></li>
			</ul>
		</div>
	</div>
	<div style="clear: both;"></div>
</div>
