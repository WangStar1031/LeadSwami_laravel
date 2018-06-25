<div class="sideBar">
	<div class="sideOptions">
		<div class="sideOption @php echo $active == 'account' ? 'selectedOption' : '' @endphp">
			<a href="/dashboard">
				<img src="img/side_account.png">
				<p>Account</p>
			</a>
		</div>
		<div class="sideOption @php echo $active == 'payment' ? 'selectedOption' : '' @endphp">
			<a href="/payment">
				<img src="img/side_payment.png">
				<p>Payment</p>
			</a>
		</div>
		<div class="sideOption @php echo $active == 'subscription' ? 'selectedOption' : '' @endphp">
			<a href="/subscription">
				<img src="img/side_subscription.png">
				<p>Subscription</p>
			</a>
		</div>
		<div class="sideOption @php echo $active == 'profiles' ? 'selectedOption' : '' @endphp">
			<a href="/profiles">
				<img src="img/side_profile.png">
				<p>Profiles</p>
			</a>
		</div>
	</div>
</div>