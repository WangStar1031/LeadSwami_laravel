<style type="text/css">
	.sideBar{
		height: calc(100% - 80px);
		width: 100px;
		background-color: #2c2e3e;
		color: white;
		position: fixed;
		top: 80px;
		z-index: 100;
	}
	.sideOptions{
		position: relative;
		text-align: center;
	}
	.sideOptions a{
		text-decoration: none;
		color: white;
		height: 40px;
	}
	.sideOptions img{
		margin-right: 10px;
	}
	.sideOption p{
		margin: 0px;
	}
	.sideOption{
		padding: 10px;
	}
	.selectedOption{
		background-color: #5f9eff;
	}
</style>
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