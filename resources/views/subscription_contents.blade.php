<div class="subContents">
	<h2>Plans</h2>
	<div class="subMain">
		<form class="planOption" method="post">
			{{ csrf_field() }}
			<p  style="display: none;">
				<span>Monthly</span>
				<span class="planRadio"></span>
				<span>
					<label class="label-switch switch-warning btnSwitch">
						<input type="checkbox" class="switch switch-bootstrap status" name="status" id="status" value="1" checked>
						<span class="lable"></span>
					</label>
					<strong>Yearly</strong>
					<span class="HighLight">(Best Value)</span>
				</span>
			</p>
			<div class="planPans row">
				<div class="col-lg-3 col-md-1"></div>
				<div class="col-lg-6 col-md-10">
					<div class="basicPan col-xs-6">
						<h3>Basic</h3>
						<p class="IsActive @php if($isActive == 1) echo 'NonVis';@endphp">is Active</p>
						<div class="Amount">Free</div>
						<p>Lorem ipsum dolor sit amet edipiscing elit</p>
						<p>sed do eiusmod elpors labore et dolore</p>
						<p>magna siad enim aliqua</p>
					</div>
					<div class="proPan col-xs-6">
						<h3>Professional</h3>
						<p class="IsActive @php if($isActive == 0) echo 'NonVis';@endphp">is Active</p>
						<div class="Amount">$29</div>
						<p>Lorem ipsum dolor sit amet edipiscing elit</p>
						<p>sed do eiusmod elpors labore et dolore</p>
						<p>magna siad enim aliqua</p>
						<input type="submit" class="btnPurchase" value="PURCHASE">
					</div>
				</div>
				<div class="col-lg-3 col-md-1"></div>
			</div>
		</form>
	</div>
</div>