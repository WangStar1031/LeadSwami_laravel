<div class="sideBar">
	<div class="sideOptions">
		<div class="sideOption @php echo $active == 'profiles' ? 'selectedOption' : '' @endphp">
			<a href="/profiles">
				<p><img src="img/side_profile.png"></p>
				<p>Profiles</p>
			</a>
		</div>
		<div class="sideOption settingMenu @php echo $active != 'profiles' ? 'subMenuOption' : '' @endphp" onclick="sideSettingClicked()">
			<a href="javascript:void(0)">
				<p><span><i class="fa fa-gear"></i></span></p>
				<p>Setting</p>
			</a>
		</div>
		<div class="sideOption subMenu @php echo $active == 'profiles' ? 'HideItem' : '';@endphp @php echo $active == 'account' ? 'selectedOption' : '';@endphp">
			<a href="/dashboard">
				<p><span><i class="fa fa-address-card"></i></span></p>
				<!-- <img src="img/side_account.png"> -->
				<p>Account</p>
			</a>
		</div>
		<div class="sideOption subMenu @php echo $active == 'profiles' ? 'HideItem' : '';@endphp @php echo $active == 'payment' ? 'selectedOption' : '';@endphp">
			<a href="/payment">
				<p><span><i class="fa fa-credit-card"></i></span></p>
				<!-- <img src="img/side_payment.png"> -->
				<p>Payment</p>
			</a>
		</div>
		<div class="sideOption subMenu @php echo $active == 'profiles' ? 'HideItem' : '';@endphp @php echo $active == 'subscription' ? 'selectedOption' : '';@endphp">
			<a href="/subscription">
				<!-- <p><span><i class="fa fa-credit-card"></i></span></p> -->
				<p><img src="img/side_subscription.png"></p>
				<p>Subscription</p>
			</a>
		</div>
	</div>
</div>